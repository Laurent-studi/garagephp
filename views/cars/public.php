<div class="fade-in">
    <!-- Header Section -->
    <div class="card-header">
        <h1 class="card-title">
            <i class="fas fa-car"></i>
            Nos véhicules d'occasion
        </h1>
        <p style="color: var(--text-light); margin: 0;">Découvrez notre sélection de véhicules révisés et garantis</p>
    </div>

    <!-- Stats publiques -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Véhicules disponibles</h3>
            <div class="stat-number"><?= count(array_filter($cars, fn($car) => ($car['status'] ?? 'disponible') === 'disponible')) ?></div>
        </div>
        <div class="stat-card">
            <h3>Prix moyen</h3>
            <div class="stat-number">
                <?php 
                $availableCars = array_filter($cars, fn($car) => ($car['status'] ?? 'disponible') === 'disponible');
                $avgPrice = !empty($availableCars) ? array_sum(array_column($availableCars, 'price')) / count($availableCars) : 0;
                echo number_format($avgPrice, 0, ',', ' ');
                ?> €
            </div>
        </div>
        <div class="stat-card">
            <h3>Année la plus récente</h3>
            <div class="stat-number">
                <?php 
                $maxYear = !empty($cars) ? max(array_column($cars, 'year')) : date('Y');
                echo $maxYear;
                ?>
            </div>
        </div>
    </div>

    <?php if (empty($cars)): ?>
        <div class="card text-center">
            <i class="fas fa-car" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h3>Notre catalogue se met à jour</h3>
            <p style="color: var(--text-light); margin-bottom: 2rem;">De nouveaux véhicules arrivent régulièrement. Revenez bientôt !</p>
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Retour à l'accueil
            </a>
        </div>
    <?php else: ?>
        <!-- Grille de véhicules -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem;">
            <?php foreach ($cars as $car): ?>
                <?php if (($car['status'] ?? 'disponible') === 'disponible'): ?>
                <div class="card" style="border-radius: 16px; overflow: hidden; transition: all 0.3s ease; border: 2px solid var(--border-color);">
                    <!-- Image placeholder -->
                    <div style="height: 200px; background: linear-gradient(135deg, var(--secondary-color), #e2e8f0); display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--border-color);">
                        <i class="fas fa-car" style="font-size: 4rem; color: var(--text-light);"></i>
                    </div>
                    
                    <!-- Contenu -->
                    <div style="padding: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                            <div>
                                <h3 style="margin: 0; color: var(--text-color); font-size: 1.25rem; font-weight: 700;">
                                    <?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['model']) ?>
                                </h3>
                                <p style="margin: 0.25rem 0 0 0; color: var(--text-light); font-size: 0.9rem;">
                                    <i class="fas fa-calendar"></i> <?= htmlspecialchars($car['year']) ?>
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <div style="background: var(--success-color); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-weight: 600; font-size: 1.1rem;">
                                    <?= number_format($car['price'], 0, ',', ' ') ?> €
                                </div>
                            </div>
                        </div>

                        <!-- Détails -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-palette" style="color: var(--primary-color);"></i>
                                <span><?= htmlspecialchars($car['color'] ?? 'N/A') ?></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-id-card" style="color: var(--accent-color);"></i>
                                <code style="background: var(--secondary-color); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">
                                    <?= htmlspecialchars($car['plate_number'] ?? 'N/A') ?>
                                </code>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                            <a href="tel:0612345678" class="btn btn-primary btn-sm" style="flex: 1; justify-content: center;">
                                <i class="fas fa-phone"></i>
                                Nous contacter
                            </a>
                            <a href="mailto:contact@garage-parrot.fr?subject=Demande d'information - <?= urlencode($car['brand'] . ' ' . $car['model']) ?>" class="btn btn-success btn-sm" style="flex: 1; justify-content: center;">
                                <i class="fas fa-envelope"></i>
                                Email
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Call to action -->
        <div class="card text-center" style="margin-top: 3rem; background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)); color: white;">
            <h3 style="color: white; margin-bottom: 1rem;">
                <i class="fas fa-handshake"></i>
                Un véhicule vous intéresse ?
            </h3>
            <p style="opacity: 0.9; margin-bottom: 2rem;">
                Contactez-nous pour plus d'informations, essai gratuit et financement personnalisé
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:0612345678" class="btn btn-success">
                    <i class="fas fa-phone"></i>
                    06 12 34 56 78
                </a>
                <a href="mailto:contact@garage-parrot.fr" class="btn" style="background: rgba(255,255,255,0.2); color: white;">
                    <i class="fas fa-envelope"></i>
                    contact@garage-parrot.fr
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>