<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'GaragePhp' ?> - Garage V. Parrot</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="/">
                        <i class="fas fa-car"></i>
                        <span>Garage V. Parrot</span>
                    </a>
                </div>
                <nav class="nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="user-menu">
                            <span class="user-welcome">
                                <i class="fas fa-user-circle"></i>
                                Bonjour <?= htmlspecialchars($_SESSION['user_username'] ?? 'Utilisateur') ?>
                            </span>
                            <a href="/cars" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i>
                                Tableau de bord
                            </a>
                            <a href="/admin/contacts" class="nav-link">
                                <i class="fas fa-envelope"></i>
                                Contacts
                            </a>
                            <form action="/logout" method="post" class="logout-form">
                                <button type="submit" class="btn btn-logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <a href="/login" class="btn btn-primary">
                            <i class="fas fa-lock"></i>
                            Espace Pro
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <?= $content ?? '' ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3><i class="fas fa-car"></i> Garage V. Parrot</h3>
                    <p>Votre spécialiste automobile de confiance</p>
                </div>
                <div class="footer-links">
                    <a href="/"><i class="fas fa-home"></i> Accueil</a>
                    <a href="/vehicles"><i class="fas fa-car"></i> Véhicules</a>
                    <a href="/contact"><i class="fas fa-envelope"></i> Contact</a>
                </div>
                <div class="footer-copy">
                    <p>&copy; <?= date('Y') ?> Garage V. Parrot - Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>