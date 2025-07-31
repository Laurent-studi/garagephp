<div class="fade-in">
    <div class="card-header">
        <h1 class="card-title">
            <i class="fas fa-tachometer-alt"></i>
            Tableau de bord - Gestion des véhicules
        </h1>
        <div class="table-actions">
            <a href="/cars/create" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Ajouter un véhicule
            </a>
        </div>
    </div>

    <!-- Stats rapides -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total véhicules</h3>
            <div class="stat-number"><?= count($cars) ?></div>
        </div>
        <div class="stat-card">
            <h3>Disponibles</h3>
            <div class="stat-number"><?= count(array_filter($cars, fn($car) => ($car['status'] ?? 'disponible') === 'disponible')) ?></div>
        </div>
        <div class="stat-card">
            <h3>Vendus</h3>
            <div class="stat-number"><?= count(array_filter($cars, fn($car) => ($car['status'] ?? '') === 'vendu')) ?></div>
        </div>
        <div class="stat-card">
            <h3>Valeur totale</h3>
            <div class="stat-number"><?= number_format(array_sum(array_column($cars, 'price')), 0, ',', ' ') ?> €</div>
        </div>
    </div>

    <?php if (empty($cars)): ?>
        <div class="card text-center">
            <i class="fas fa-car" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h3>Aucun véhicule enregistré</h3>
            <p style="color: var(--text-light); margin-bottom: 2rem;">Commencez par ajouter votre premier véhicule au catalogue</p>
            <a href="/cars/create" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter le premier véhicule
            </a>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-industry"></i> Marque</th>
                        <th><i class="fas fa-car"></i> Modèle</th>
                        <th><i class="fas fa-calendar"></i> Année</th>
                        <th><i class="fas fa-palette"></i> Couleur</th>
                        <th><i class="fas fa-id-card"></i> Immatriculation</th>
                        <th><i class="fas fa-euro-sign"></i> Prix</th>
                        <th><i class="fas fa-info-circle"></i> Statut</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><strong>#<?= htmlspecialchars($car['id'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($car['brand']) ?></td>
                        <td><?= htmlspecialchars($car['model']) ?></td>
                        <td><?= htmlspecialchars($car['year']) ?></td>
                        <td>
                            <span style="display: inline-block; width: 20px; height: 20px; background: <?= htmlspecialchars($car['color'] ?? '#ccc') ?>; border-radius: 50%; border: 2px solid var(--border-color); margin-right: 0.5rem; vertical-align: middle;"></span>
                            <?= htmlspecialchars($car['color'] ?? 'N/A') ?>
                        </td>
                        <td>
                            <code style="background: var(--secondary-color); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.9rem;">
                                <?= htmlspecialchars($car['plate_number'] ?? 'N/A') ?>
                            </code>
                        </td>
                        <td>
                            <strong style="color: var(--success-color); font-size: 1.1rem;">
                                <?= number_format($car['price'], 2, ',', ' ') ?> €
                            </strong>
                        </td>
                        <td>
                            <?php 
                            $status = $car['status'] ?? 'disponible';
                            $statusClass = $status === 'disponible' ? 'success' : 'warning';
                            $statusIcon = $status === 'disponible' ? 'check-circle' : 'clock';
                            ?>
                            <span class="badge badge-<?= $statusClass ?>" style="background: var(--<?= $statusClass ?>-color); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem;">
                                <i class="fas fa-<?= $statusIcon ?>"></i>
                                <?= ucfirst($status) ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="/cars/<?= $car['id'] ?? '' ?>" class="btn btn-sm btn-primary" title="Voir les détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/cars/<?= $car['id'] ?? '' ?>/edit" class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/cars/<?= $car['id'] ?? '' ?>/delete" method="post" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>