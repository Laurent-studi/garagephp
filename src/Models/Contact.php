<?php

namespace App\Models;

use InvalidArgumentException;
use PDO;

/**
 * Modèle Contact : représente une demande de contact dans la base de données
 * Gère les demandes de contact des clients/visiteurs
 */
class Contact extends BaseModel
{
    protected string $table = 'contacts';

    private ?int $id = null;
    private string $name;
    private string $email;
    private string $phone;
    private string $subject;
    private string $message;
    private string $status;
    private ?string $created_at = null;

    // --- GETTERS ---
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPhone(): string { return $this->phone; }
    public function getSubject(): string { return $this->subject; }
    public function getMessage(): string { return $this->message; }
    public function getStatus(): string { return $this->status; }
    public function getCreatedAt(): ?string { return $this->created_at; }

    // --- SETTERS avec validation ---
    public function setName(string $name): self
    {
        if (empty(trim($name)) || strlen(trim($name)) < 2 || strlen(trim($name)) > 100) {
            throw new InvalidArgumentException("Nom invalide (2-100 caractères requis).");
        }
        $this->name = trim($name);
        return $this;
    }

    public function setEmail(string $email): self
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Adresse email invalide.");
        }
        $this->email = trim(strtolower($email));
        return $this;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = trim($phone);
        return $this;
    }

    public function setSubject(string $subject): self
    {
        if (empty(trim($subject)) || strlen(trim($subject)) < 5 || strlen(trim($subject)) > 200) {
            throw new InvalidArgumentException("Sujet invalide (5-200 caractères requis).");
        }
        $this->subject = trim($subject);
        return $this;
    }

    public function setMessage(string $message): self
    {
        if (empty(trim($message)) || strlen(trim($message)) < 10 || strlen(trim($message)) > 2000) {
            throw new InvalidArgumentException("Message invalide (10-2000 caractères requis).");
        }
        $this->message = trim($message);
        return $this;
    }

    public function setStatus(string $status): self
    {
        $validStatuses = ['nouveau', 'en_cours', 'traité', 'fermé'];
        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException("Statut invalide. Valeurs autorisées : " . implode(', ', $validStatuses));
        }
        $this->status = $status;
        return $this;
    }

    /**
     * Sauvegarde le contact en base de données
     */
    public function save(): bool
    {
        if ($this->id === null) {
            // Création
            $sql = "INSERT INTO {$this->table} (name, email, phone, subject, message, status, created_at) 
                    VALUES (:name, :email, :phone, :subject, :message, :status, NOW())";
            
            $stmt = $this->db->prepare($sql);
            $params = [
                ':name' => $this->name,
                ':email' => $this->email,
                ':phone' => $this->phone,
                ':subject' => $this->subject,
                ':message' => $this->message,
                ':status' => $this->status ?? 'nouveau'
            ];
        } else {
            // Mise à jour
            $sql = "UPDATE {$this->table} 
                    SET name = :name, email = :email, phone = :phone, 
                        subject = :subject, message = :message, status = :status 
                    WHERE id = :id";
            
            $stmt = $this->db->prepare($sql);
            $params = [
                ':name' => $this->name,
                ':email' => $this->email,
                ':phone' => $this->phone,
                ':subject' => $this->subject,
                ':message' => $this->message,
                ':status' => $this->status,
                ':id' => $this->id
            ];
        }

        $result = $stmt->execute($params);

        if ($this->id === null && $result) {
            $this->id = (int)$this->db->lastInsertId();
        }

        return $result;
    }

    /**
     * Récupère tous les contacts, triés par date de création (plus récents en premier)
     */
    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve un contact par son ID
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    /**
     * Met à jour le statut d'un contact
     */
    public function updateStatus(int $id, string $status): bool
    {
        $validStatuses = ['nouveau', 'en_cours', 'traité', 'fermé'];
        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException("Statut invalide.");
        }

        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    /**
     * Récupère les contacts par statut
     */
    public function findByStatus(string $status): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE status = :status ORDER BY created_at DESC");
        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Statistiques des contacts
     */
    public function getStats(): array
    {
        $stmt = $this->db->query("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'nouveau' THEN 1 ELSE 0 END) as nouveau,
                SUM(CASE WHEN status = 'en_cours' THEN 1 ELSE 0 END) as en_cours,
                SUM(CASE WHEN status = 'traité' THEN 1 ELSE 0 END) as traite,
                SUM(CASE WHEN status = 'fermé' THEN 1 ELSE 0 END) as ferme
            FROM {$this->table}
        ");
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Hydrate l'objet avec les données de la base
     */
    private function hydrate(array $data): self
    {
        $this->id = (int)$data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->subject = $data['subject'];
        $this->message = $data['message'];
        $this->status = $data['status'];
        $this->created_at = $data['created_at'];
        return $this;
    }
}