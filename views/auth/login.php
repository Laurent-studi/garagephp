<div class="auth-form fade-in">
    <div class="text-center mb-3">
        <i class="fas fa-car" style="font-size: 3rem; background: linear-gradient(45deg, #1e40af, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
        <h2><i class="fas fa-lock"></i> Espace Professionnel</h2>
        <p style="color: var(--text-light); margin-bottom: 2rem;">Connectez-vous pour accéder au tableau de bord</p>
    </div>

    <?php if (isset($error)): ?>
        <div class="error-message">
            <i class="fas fa-exclamation-triangle"></i>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
        
        <div class="form-group">
            <label for="email">
                <i class="fas fa-envelope"></i>
                Adresse email
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
            <label for="password">
                <i class="fas fa-key"></i>
                Mot de passe
            </label>
            <input type="password" name="password" id="password" required placeholder="••••••••">
            <?php if (isset($errors['password'])): ?>
                <p class="error-validation">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= htmlspecialchars($errors['password'][0]) ?>
                </p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">
            <i class="fas fa-sign-in-alt"></i>
            Se connecter
        </button>
    </form>

    <div class="text-center mt-3">
        <p style="color: var(--text-light); font-size: 0.9rem;">
            <i class="fas fa-info-circle"></i>
            Besoin d'aide ? Contactez l'administrateur
        </p>
    </div>
</div>