<div class="fade-in">
    <!-- En-tête -->
    <div class="card-header">
        <h1 class="card-title">
            <i class="fas fa-envelope"></i>
            Nous contacter
        </h1>
        <p style="color: var(--text-light); margin: 0;">Une question ? Un devis ? Nous sommes là pour vous aider !</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;">
        <!-- Formulaire de contact -->
        <div class="card">
            <h2 style="margin-bottom: 1.5rem; color: var(--text-color);">
                <i class="fas fa-paper-plane"></i>
                Envoyez-nous un message
            </h2>

            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/contact" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i>
                        Nom complet *
                    </label>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required placeholder="Votre nom et prénom">
                    <?php if (isset($errors['name'])): ?>
                        <p class="error-validation">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($errors['name'][0]) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Adresse email *
                    </label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required placeholder="votre@email.com">
                    <?php if (isset($errors['email'])): ?>
                        <p class="error-validation">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($errors['email'][0]) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="phone">
                        <i class="fas fa-phone"></i>
                        Téléphone
                    </label>
                    <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>" placeholder="06 12 34 56 78">
                    <?php if (isset($errors['phone'])): ?>
                        <p class="error-validation">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($errors['phone'][0]) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="subject">
                        <i class="fas fa-tag"></i>
                        Sujet *
                    </label>
                    <select name="subject" id="subject" required>
                        <option value="">Choisissez un sujet</option>
                        <option value="Demande de devis" <?= (($old['subject'] ?? '') === 'Demande de devis') ? 'selected' : '' ?>>Demande de devis</option>
                        <option value="Information véhicule" <?= (($old['subject'] ?? '') === 'Information véhicule') ? 'selected' : '' ?>>Information sur un véhicule</option>
                        <option value="Prise de rendez-vous" <?= (($old['subject'] ?? '') === 'Prise de rendez-vous') ? 'selected' : '' ?>>Prise de rendez-vous</option>
                        <option value="Réparation/Entretien" <?= (($old['subject'] ?? '') === 'Réparation/Entretien') ? 'selected' : '' ?>>Réparation/Entretien</option>
                        <option value="Contrôle technique" <?= (($old['subject'] ?? '') === 'Contrôle technique') ? 'selected' : '' ?>>Contrôle technique</option>
                        <option value="Réclamation" <?= (($old['subject'] ?? '') === 'Réclamation') ? 'selected' : '' ?>>Réclamation</option>
                        <option value="Autre" <?= (($old['subject'] ?? '') === 'Autre') ? 'selected' : '' ?>>Autre</option>
                    </select>
                    <?php if (isset($errors['subject'])): ?>
                        <p class="error-validation">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($errors['subject'][0]) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="message">
                        <i class="fas fa-comment"></i>
                        Votre message *
                    </label>
                    <textarea name="message" id="message" rows="6" required placeholder="Décrivez votre demande en détail..."><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                    <?php if (isset($errors['message'])): ?>
                        <p class="error-validation">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($errors['message'][0]) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer le message
                </button>
            </form>
        </div>

        <!-- Informations de contact -->
        <div class="card" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); color: white;">
            <h2 style="color: white; margin-bottom: 2rem;">
                <i class="fas fa-map-marker-alt"></i>
                Nos coordonnées
            </h2>

            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 50%; flex-shrink: 0;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="color: white; margin: 0;">Adresse</h4>
                        <p style="margin: 0; opacity: 0.9;">123 Avenue des Garages<br>31000 Toulouse, France</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 50%; flex-shrink: 0;">
                        <i class="fas fa-phone" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="color: white; margin: 0;">Téléphone</h4>
                        <p style="margin: 0; opacity: 0.9;">
                            <a href="tel:0612345678" style="color: white; text-decoration: none;">06 12 34 56 78</a>
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 50%; flex-shrink: 0;">
                        <i class="fas fa-envelope" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="color: white; margin: 0;">Email</h4>
                        <p style="margin: 0; opacity: 0.9;">
                            <a href="mailto:contact@garage-parrot.fr" style="color: white; text-decoration: none;">contact@garage-parrot.fr</a>
                        </p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 50%; flex-shrink: 0;">
                        <i class="fas fa-clock" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h4 style="color: white; margin: 0;">Horaires d'ouverture</h4>
                        <p style="margin: 0; opacity: 0.9;">
                            Lundi - Vendredi : 8h00 - 18h00<br>
                            Samedi : 8h00 - 12h00<br>
                            Dimanche : Fermé
                        </p>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.2);">
                <h3 style="color: white; margin-bottom: 1rem;">
                    <i class="fas fa-info-circle"></i>
                    Temps de réponse
                </h3>
                <p style="opacity: 0.9; margin: 0;">
                    Nous nous engageons à vous répondre dans les <strong>24 heures</strong> suivant votre demande.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .fade-in > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}
</style>