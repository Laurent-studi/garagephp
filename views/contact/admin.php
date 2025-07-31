<div class="fade-in">
    <div class="card-header">
        <h1 class="card-title">
            <i class="fas fa-envelope"></i>
            Gestion des contacts
        </h1>
        <p style="color: var(--text-light); margin: 0;">Suivi des demandes de contact des clients</p>
    </div>

    <!-- Stats rapides -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total demandes</h3>
            <div class="stat-number"><?= count($contacts) ?></div>
        </div>
        <div class="stat-card">
            <h3>Nouveaux</h3>
            <div class="stat-number"><?= count(array_filter($contacts, fn($c) => $c['status'] === 'nouveau')) ?></div>
        </div>
        <div class="stat-card">
            <h3>En cours</h3>
            <div class="stat-number"><?= count(array_filter($contacts, fn($c) => $c['status'] === 'en_cours')) ?></div>
        </div>
        <div class="stat-card">
            <h3>Traités</h3>
            <div class="stat-number"><?= count(array_filter($contacts, fn($c) => $c['status'] === 'traité')) ?></div>
        </div>
    </div>

    <?php if (empty($contacts)): ?>
        <div class="card text-center">
            <i class="fas fa-envelope" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h3>Aucune demande de contact</h3>
            <p style="color: var(--text-light); margin-bottom: 2rem;">Les demandes de contact apparaîtront ici</p>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-user"></i> Nom</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-phone"></i> Téléphone</th>
                        <th><i class="fas fa-tag"></i> Sujet</th>
                        <th><i class="fas fa-calendar"></i> Date</th>
                        <th><i class="fas fa-info-circle"></i> Statut</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><strong>#<?= htmlspecialchars($contact['id']) ?></strong></td>
                        <td><?= htmlspecialchars($contact['name']) ?></td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($contact['email']) ?>" style="color: var(--primary-color); text-decoration: none;">
                                <?= htmlspecialchars($contact['email']) ?>
                            </a>
                        </td>
                        <td>
                            <?php if (!empty($contact['phone'])): ?>
                                <a href="tel:<?= htmlspecialchars($contact['phone']) ?>" style="color: var(--accent-color); text-decoration: none;">
                                    <?= htmlspecialchars($contact['phone']) ?>
                                </a>
                            <?php else: ?>
                                <span style="color: var(--text-light); font-style: italic;">Non renseigné</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($contact['subject']) ?></strong>
                            <div style="font-size: 0.85rem; color: var(--text-light); margin-top: 0.25rem;">
                                <?= htmlspecialchars(substr($contact['message'], 0, 80)) ?>
                                <?= strlen($contact['message']) > 80 ? '...' : '' ?>
                            </div>
                        </td>
                        <td style="font-size: 0.9rem;">
                            <?= date('d/m/Y', strtotime($contact['created_at'])) ?><br>
                            <span style="color: var(--text-light);"><?= date('H:i', strtotime($contact['created_at'])) ?></span>
                        </td>
                        <td>
                            <?php 
                            $statusConfig = [
                                'nouveau' => ['color' => 'var(--error-color)', 'icon' => 'fas fa-exclamation', 'text' => 'Nouveau'],
                                'en_cours' => ['color' => 'var(--warning-color)', 'icon' => 'fas fa-clock', 'text' => 'En cours'],
                                'traité' => ['color' => 'var(--success-color)', 'icon' => 'fas fa-check-circle', 'text' => 'Traité'],
                                'fermé' => ['color' => 'var(--text-light)', 'icon' => 'fas fa-times-circle', 'text' => 'Fermé']
                            ];
                            $config = $statusConfig[$contact['status']] ?? $statusConfig['nouveau'];
                            ?>
                            <span class="badge" style="background: <?= $config['color'] ?>; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem;">
                                <i class="<?= $config['icon'] ?>"></i>
                                <?= $config['text'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <button onclick="showContactDetails(<?= htmlspecialchars(json_encode($contact)) ?>)" class="btn btn-sm btn-primary" title="Voir les détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if ($contact['status'] === 'nouveau' || $contact['status'] === 'en_cours'): ?>
                                <form action="/admin/contacts/<?= $contact['id'] ?>/processed" method="post" style="display: inline;" onsubmit="return confirm('Marquer ce contact comme traité ?')">
                                    <button type="submit" class="btn btn-sm btn-success" title="Marquer comme traité">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                                <a href="mailto:<?= htmlspecialchars($contact['email']) ?>?subject=Re: <?= urlencode($contact['subject']) ?>" class="btn btn-sm btn-warning" title="Répondre par email">
                                    <i class="fas fa-reply"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Modal pour les détails du contact -->
<div id="contactModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 12px; max-width: 600px; max-height: 80vh; overflow-y: auto; margin: 2rem; box-shadow: var(--shadow-lg);">
        <div style="padding: 2rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin: 0; color: var(--text-color);">
                <i class="fas fa-envelope"></i>
                Détails de la demande
            </h2>
            <button onclick="closeContactModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-light);">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="contactModalContent" style="padding: 2rem;">
            <!-- Le contenu sera rempli par JavaScript -->
        </div>
    </div>
</div>

<script>
function showContactDetails(contact) {
    const modal = document.getElementById('contactModal');
    const content = document.getElementById('contactModalContent');
    
    const statusConfig = {
        'nouveau': { color: 'var(--error-color)', icon: 'fas fa-exclamation', text: 'Nouveau' },
        'en_cours': { color: 'var(--warning-color)', icon: 'fas fa-clock', text: 'En cours' },
        'traité': { color: 'var(--success-color)', icon: 'fas fa-check-circle', text: 'Traité' },
        'fermé': { color: 'var(--text-light)', icon: 'fas fa-times-circle', text: 'Fermé' }
    };
    
    const config = statusConfig[contact.status] || statusConfig['nouveau'];
    const createdAt = new Date(contact.created_at);
    
    content.innerHTML = `
        <div style="display: grid; grid-template-columns: auto 1fr; gap: 1rem; margin-bottom: 2rem;">
            <strong>ID :</strong> <span>#${contact.id}</span>
            <strong>Nom :</strong> <span>${contact.name}</span>
            <strong>Email :</strong> <span><a href="mailto:${contact.email}" style="color: var(--primary-color);">${contact.email}</a></span>
            <strong>Téléphone :</strong> <span>${contact.phone || 'Non renseigné'}</span>
            <strong>Date :</strong> <span>${createdAt.toLocaleDateString('fr-FR')} à ${createdAt.toLocaleTimeString('fr-FR')}</span>
            <strong>Statut :</strong> 
            <span>
                <span style="background: ${config.color}; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem;">
                    <i class="${config.icon}"></i> ${config.text}
                </span>
            </span>
        </div>
        
        <div style="margin-bottom: 1.5rem;">
            <strong>Sujet :</strong>
            <div style="background: var(--secondary-color); padding: 1rem; border-radius: 8px; margin-top: 0.5rem;">
                ${contact.subject}
            </div>
        </div>
        
        <div>
            <strong>Message :</strong>
            <div style="background: var(--secondary-color); padding: 1rem; border-radius: 8px; margin-top: 0.5rem; white-space: pre-line;">
                ${contact.message}
            </div>
        </div>
        
        <div style="margin-top: 2rem; text-align: center;">
            <a href="mailto:${contact.email}?subject=Re: ${encodeURIComponent(contact.subject)}" class="btn btn-primary">
                <i class="fas fa-reply"></i> Répondre par email
            </a>
        </div>
    `;
    
    modal.style.display = 'flex';
}

function closeContactModal() {
    document.getElementById('contactModal').style.display = 'none';
}

// Fermer le modal en cliquant à l'extérieur
document.getElementById('contactModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeContactModal();
    }
});
</script>