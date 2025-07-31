# 🚗 Garage V. Parrot - Système de Gestion

Une application web moderne de gestion de garage automobile développée en PHP avec une architecture MVC personnalisée.

![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-777BB4?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat-square&logo=docker&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 📋 Table des matières

- [Fonctionnalités](#-fonctionnalités)
- [Technologies](#-technologies)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Tests](#-tests)
- [API](#-api)
- [Déploiement](#-déploiement)
- [Contribution](#-contribution)

## ✨ Fonctionnalités

### 🔐 Authentification & Sécurité
- Système d'authentification sécurisé avec hashage Argon2ID
- Protection CSRF sur tous les formulaires
- Validation et sanitisation des données
- Gestion des sessions PHP natives
- Contrôle d'accès basé sur les rôles

### 🚗 Gestion des Véhicules
- CRUD complet pour les véhicules d'occasion
- Catalogue avec filtres et recherche
- Gestion des statuts (disponible, vendu, réservé)
- Upload et gestion d'images
- Statistiques et tableau de bord

### 🎨 Interface Utilisateur
- Design moderne et responsive
- Interface administrateur intuitive
- Animations et transitions fluides
- Support mobile et desktop
- Thème cohérent avec variables CSS

### 📊 Fonctionnalités Business
- Tableau de bord avec métriques
- Export des données
- Logs d'activité
- Gestion des utilisateurs

## 🛠 Technologies

### Backend
- **PHP 8.1+** - Langage principal
- **MySQL 8.0** - Base de données
- **FastRoute** - Routage URL
- **PHPUnit** - Tests unitaires
- **PHP-DotEnv** - Gestion des variables d'environnement

### Frontend
- **HTML5 / CSS3** - Structure et style
- **JavaScript Vanilla** - Interactions
- **Font Awesome** - Icônes
- **Design System** - Variables CSS personnalisées

### DevOps
- **Docker & Docker Compose** - Conteneurisation
- **Nginx** - Serveur web
- **Supervisor** - Gestion des processus

## 📋 Prérequis

### Développement Local
- PHP 8.1 ou supérieur
- MySQL 8.0 ou supérieur  
- Composer
- Extension PHP : PDO, PDO_MySQL

### Avec Docker (Recommandé)
- Docker
- Docker Compose

## 🚀 Installation

### Méthode 1: Avec Docker (Recommandé)

```bash
# Cloner le repository
git clone https://github.com/votre-username/garage-php.git
cd garage-php

# Copier le fichier d'environnement
cp .env.example .env

# Configurer les variables d'environnement
nano .env

# Lancer l'application
docker-compose up -d

# L'application sera accessible sur http://localhost:8080
```

### Méthode 2: Installation manuelle

```bash
# Cloner le repository
git clone https://github.com/votre-username/garage-php.git
cd garage-php

# Installer les dépendances
composer install

# Configurer la base de données
mysql -u root -p < sql/garagephp.sql

# Configurer le serveur web pour pointer vers /public
# Exemple avec Apache : DocumentRoot vers /path/to/garage-php/public
```

## ⚙️ Configuration

### Variables d'environnement (.env)

```env
# Base de données
DB_HOST=localhost
DB_NAME=garagephp_db
DB_USER=root
DB_PASSWORD=votre_mot_de_passe

# Application
APP_DEBUG=true
APP_KEY=votre_cle_secrete_32_caracteres
APP_URL=http://localhost:8080

# Stockage
STORAGE_PATH=/var/www/html/storage
```

### Configuration Docker

Le fichier `docker-compose.yml` configure automatiquement :
- Application PHP-FPM + Nginx sur le port 8080
- Base de données MySQL avec import automatique du schéma
- Volumes persistants pour les données

## 📖 Utilisation

### Accès à l'application

1. **Page d'accueil** : `http://localhost:8080`
2. **Espace professionnel** : `http://localhost:8080/login`
3. **Tableau de bord** : `http://localhost:8080/cars` (après connexion)

### Comptes par défaut

```
Email: admin@garage-parrot.fr
Mot de passe: AdminPass123!
```

### Structure des URLs

```
GET  /                    # Page d'accueil
GET  /login               # Formulaire de connexion
POST /login               # Traitement connexion
POST /logout              # Déconnexion
GET  /cars                # Liste des véhicules
GET  /cars/create         # Formulaire ajout véhicule
POST /cars                # Création véhicule
GET  /cars/{id}           # Détails véhicule
GET  /cars/{id}/edit      # Formulaire modification
PUT  /cars/{id}           # Mise à jour véhicule
DELETE /cars/{id}         # Suppression véhicule
```

## 🧪 Tests

```bash
# Exécuter tous les tests
vendor/bin/phpunit

# Tests unitaires uniquement
vendor/bin/phpunit --testsuite=Unit

# Tests fonctionnels uniquement  
vendor/bin/phpunit --testsuite=Functional

# Test spécifique
vendor/bin/phpunit Tests/Unit/UserTest.php

# Avec couverture de code
vendor/bin/phpunit --coverage-html coverage/
```

## 📁 Structure du projet

```
garage-php/
├── public/                 # Point d'entrée web
│   ├── index.php          # Front controller
│   └── assets/            # CSS, JS, images
├── src/                   # Code source
│   ├── Controllers/       # Contrôleurs MVC
│   ├── Models/           # Modèles de données
│   ├── Config/           # Configuration
│   ├── Security/         # Authentification & validation
│   └── Utils/            # Utilitaires
├── views/                # Templates PHP
│   ├── layout.php        # Template principal
│   ├── auth/            # Vues authentification
│   └── cars/            # Vues gestion véhicules
├── Tests/               # Tests automatisés
├── sql/                 # Scripts de base de données
├── docker/              # Configuration Docker
└── vendor/              # Dépendances Composer
```

## 🔧 Architecture

### Modèle MVC Personnalisé

```php
# Contrôleur de base
class BaseController {
    protected function render(string $view, array $data = []): void
    protected function requireAuth(): void
    protected function getPostData(): array
}

# Modèle de base  
class BaseModel {
    protected PDO $db;
    public function save(): bool
    public function find(int $id): ?array
}
```

### Système de routage

```php
# Configuration des routes (public/index.php)
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('POST', '/login', [AuthController::class, 'login']);
    // ...
});
```

## 🚢 Déploiement

### Production avec Docker

```bash
# Build de l'image de production
docker build -t garage-php:prod .

# Déploiement
docker-compose -f docker-compose.prod.yml up -d
```

### Variables d'environnement de production

```env
APP_DEBUG=false
DB_HOST=your-production-db-host
DB_PASSWORD=strong-production-password
APP_KEY=your-32-char-production-key
```

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

### Standards de code

- PSR-4 pour l'autoloading
- PSR-12 pour le style de code
- Tests unitaires requis pour les nouvelles fonctionnalités
- Documentation des méthodes publiques

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👥 Auteurs

- **V. Parrot** - *Propriétaire du garage* 
- **Équipe de développement** - *Développement initial*

## 🆘 Support

- 📧 Email: contact@garage-parrot.fr
- 📱 Téléphone: 06 12 34 56 78
- 🐛 Issues: [GitHub Issues](https://github.com/votre-username/garage-php/issues)

## 📈 Roadmap

- [ ] API REST complète
- [ ] Interface de réservation client
- [ ] Système de notifications
- [ ] Integration avec des services tiers
- [ ] Application mobile

---

⭐ N'hésitez pas à star le projet si vous le trouvez utile !


