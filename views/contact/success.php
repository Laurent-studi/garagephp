<div class="fade-in">
    <div class="card text-center" style="max-width: 600px; margin: 2rem auto;">
        <!-- Icône de succès -->
        <div style="margin-bottom: 2rem;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 100px; height: 100px; background: linear-gradient(135deg, var(--success-color), #059669); border-radius: 50%; margin-bottom: 1rem;">
                <i class="fas fa-check" style="font-size: 3rem; color: white;"></i>
            </div>
        </div>

        <!-- Message de succès -->
        <h1 style="color: var(--success-color); margin-bottom: 1rem;">
            Message envoyé avec succès !
        </h1>
        
        <p style="color: var(--text-light); font-size: 1.1rem; margin-bottom: 2rem;">
            Merci <strong><?= htmlspecialchars($contact->getName()) ?></strong> pour votre message concernant "<em><?= htmlspecialchars($contact->getSubject()) ?></em>".
        </p>

        <!-- Informations -->
        <div class="card" style="background: var(--secondary-color); margin-bottom: 2rem; text-align: left;">
            <h3 style="margin-bottom: 1rem; color: var(--text-color);">
                <i class="fas fa-info-circle"></i>
                Ce qui va se passer maintenant
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-envelope" style="color: var(--primary-color); font-size: 1.2rem;"></i>
                    <span>Votre demande a été enregistrée et transmise à notre équipe</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-clock" style="color: var(--warning-color); font-size: 1.2rem;"></i>
                    <span>Nous vous répondrons dans les <strong>24 heures</strong></span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-user-tie" style="color: var(--accent-color); font-size: 1.2rem;"></i>
                    <span>Un conseiller traitera personnellement votre demande</span>
                </div>
            </div>
        </div>

        <!-- Récapitulatif -->
        <div class="card" style="background: white; border: 2px solid var(--border-color); margin-bottom: 2rem; text-align: left;">
            <h3 style="margin-bottom: 1rem; color: var(--text-color);">
                <i class="fas fa-clipboard-list"></i>
                Récapitulatif de votre demande
            </h3>
            
            <div style="display: grid; grid-template-columns: auto 1fr; gap: 0.5rem 1rem; align-items: start;">
                <strong>Email :</strong>
                <span><?= htmlspecialchars($contact->getEmail()) ?></span>
                
                <?php if (!empty($contact->getPhone())): ?>
                <strong>Téléphone :</strong>
                <span><?= htmlspecialchars($contact->getPhone()) ?></span>
                <?php endif; ?>
                
                <strong>Sujet :</strong>
                <span><?= htmlspecialchars($contact->getSubject()) ?></span>
                
                <strong>Message :</strong>
                <span style="white-space: pre-line;"><?= htmlspecialchars($contact->getMessage()) ?></span>
            </div>
        </div>

        <!-- Actions -->
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Retour à l'accueil
            </a>
            <a href="/vehicles" class="btn btn-success">
                <i class="fas fa-car"></i>
                Voir nos véhicules
            </a>
            <a href="/contact" class="btn" style="background: var(--text-light); color: white;">
                <i class="fas fa-plus"></i>
                Nouveau message
            </a>
        </div>

        <!-- Contact d'urgence -->
        <div style="margin-top: 3rem; padding: 1.5rem; background: linear-gradient(135deg, var(--warning-color), #d97706); color: white; border-radius: 12px;">
            <h3 style="color: white; margin-bottom: 1rem;">
                <i class="fas fa-exclamation-triangle"></i>
                Demande urgente ?
            </h3>
            <p style="margin-bottom: 1rem; opacity: 0.9;">
                Pour toute urgence (panne, accident, remorquage), contactez-nous directement :
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:0612345678" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-phone"></i>
                    06 12 34 56 78
                </a>
                <a href="mailto:urgence@garage-parrot.fr" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-envelope"></i>
                    Email urgence
                </a>
            </div>
        </div>
    </div>
</div>