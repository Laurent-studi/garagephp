CREATE DATABASE IF NOT EXISTS garagephp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE garagephp;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE cars (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(100) NOT NULL,
    modele VARCHAR(100) NOT NULL,
    annee YEAR NOT NULL,
    couleur VARCHAR(50) NOT NULL,
    immatriculation VARCHAR(20) NOT NULL UNIQUE,
    prix DECIMAL(10, 2) NOT NULL,
    status ENUM('disponible', 'vendu') NOT NULL DEFAULT 'disponible',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) DEFAULT '',
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('nouveau', 'en_cours', 'traité', 'fermé') NOT NULL DEFAULT 'nouveau',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

-- Insérer un utilisateur admin par défaut (mot de passe: password)
INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES
('admin', 'admin@garage.com', '$2y$12$r4E4HSCT7xxjl3IdW4qGl.HErj02yTuzb7yYIOMRZId.fztyua91G', 'admin');