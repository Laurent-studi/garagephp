<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Security\TokenManager;
use App\Utils\Logger;

/**
 * Contrôleur de gestion des contacts
 * Gère l'affichage du formulaire et le traitement des demandes de contact
 */
class ContactController extends BaseController
{
    private Contact $contactModel;
    private TokenManager $tokenManager;
    private Logger $logger;

    public function __construct()
    {
        parent::__construct();
        $this->contactModel = new Contact();
        $this->tokenManager = new TokenManager();
        $this->logger = new Logger();
    }

    /**
     * Affiche le formulaire de contact
     */
    public function show(): void
    {
        $this->render('contact/form', [
            'title' => 'Nous contacter',
            'csrf_token' => $this->tokenManager->generateCsrfToken()
        ]);
    }

    /**
     * Traite la soumission du formulaire de contact
     */
    public function store(): void
    {
        // Vérifier que la méthode est POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->response->redirect('/contact');
            return;
        }

        $data = $this->getPostData();

        // Validation du token CSRF
        if (!$this->tokenManager->validateCsrfToken($data['csrf_token'] ?? '')) {
            $this->response->error('Token de sécurité invalide.', 403);
            return;
        }

        // Validation des données
        $errors = $this->validator->validate($data, [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'phone' => 'max:20',
            'subject' => 'required|min:5|max:200',
            'message' => 'required|min:10|max:2000'
        ]);

        if (!empty($errors)) {
            $this->render('contact/form', [
                'title' => 'Nous contacter',
                'errors' => $errors,
                'old' => $data,
                'csrf_token' => $this->tokenManager->generateCsrfToken()
            ]);
            return;
        }

        try {
            // Créer un nouveau contact
            $contact = new Contact();
            $contact->setName($data['name'])
                   ->setEmail($data['email'])
                   ->setPhone($data['phone'] ?? '')
                   ->setSubject($data['subject'])
                   ->setMessage($data['message'])
                   ->setStatus('nouveau');

            if ($contact->save()) {
                // Log de la demande de contact
                $this->logger->log('INFO', "Nouvelle demande de contact de {$data['email']}");
                
                // Redirection vers la page de succès
                $this->render('contact/success', [
                    'title' => 'Message envoyé',
                    'contact' => $contact
                ]);
            } else {
                throw new \Exception("Erreur lors de l'enregistrement de votre demande.");
            }

        } catch (\Exception $e) {
            $this->logger->log('ERROR', 'Erreur contact: ' . $e->getMessage());
            
            $this->render('contact/form', [
                'title' => 'Nous contacter',
                'error' => "Une erreur est survenue. Veuillez réessayer ou nous contacter directement par téléphone.",
                'old' => $data,
                'csrf_token' => $this->tokenManager->generateCsrfToken()
            ]);
        }
    }

    /**
     * Liste des demandes de contact (accès admin)
     */
    public function index(): void
    {
        $this->requireAuth();
        
        $contacts = $this->contactModel->all();
        $this->render('contact/admin', [
            'title' => 'Gestion des contacts',
            'contacts' => $contacts
        ]);
    }

    /**
     * Marquer un contact comme traité
     */
    public function markAsProcessed(int $id): void
    {
        $this->requireAuth();
        
        try {
            $contact = $this->contactModel->find($id);
            if (!$contact) {
                $this->response->error("Contact non trouvé", 404);
                return;
            }

            $this->contactModel->updateStatus($id, 'traité');
            $this->response->redirect('/admin/contacts');
            
        } catch (\Exception $e) {
            $this->logger->log('ERROR', 'Erreur mise à jour contact: ' . $e->getMessage());
            $this->response->error("Erreur lors de la mise à jour", 500);
        }
    }
}