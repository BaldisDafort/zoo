# Documentation Technique - Système de Gestion de Zoo

## 1. Introduction

### 1.1 Présentation du Projet
Le système de gestion de zoo est une application web permettant la gestion des enclos, des animaux, des avis et des réservations. Le système est divisé en deux parties : une interface publique pour les visiteurs et un back-office pour les administrateurs.

### 1.2 Objectifs
- Gérer les enclos et leur état (ouvert/fermé)
- Permettre aux visiteurs de consulter les enclos
- Gérer les avis et les réservations
- Fournir une interface d'administration complète

## 2. Architecture Technique

### 2.1 Technologies Utilisées
- **Backend** : PHP 8.2+
- **Base de données** : MySQL
- **Frontend** : HTML, CSS, JavaScript
- **Dépendances** :
  - vlucas/phpdotenv (gestion des variables d'environnement)
  - PHPUnit (tests unitaires)

### 2.2 Structure du Projet
```
zoo/
├── Back_Office/     # Interface d'administration
├── Avis/           # Gestion des avis
├── Enclos/         # Gestion des enclos
├── Billets/        # Gestion des réservations
├── Assets/         # Ressources statiques
├── tests/          # Tests unitaires
├── vendor/         # Dépendances
└── config.php      # Configuration
```

## 3. Fonctionnalités

### 3.1 Interface Publique
- Consultation des enclos
- Visualisation de l'état des enclos (ouvert/fermé)
- Système d'authentification

### 3.2 Back Office
- Gestion des animaux
- Gestion des enclos
- Gestion des avis
- Gestion des réservations

## 4. Base de Données

### 4.1 Structure
- Table `animaux` : Informations sur les animaux
- Table `enclos` : Gestion des enclos
- Table `avis` : Système d'avis
- Table `profil` : Gestion des utilisateurs

### 4.2 Relations
- Un enclos peut contenir plusieurs animaux
- Un enclos peut avoir plusieurs avis
- Les profils déterminent les droits d'accès

## 5. Sécurité

### 5.1 Authentification
- Système de connexion sécurisé
- Gestion des sessions
- Protection des routes d'administration

### 5.2 Validation des Données
- Validation des entrées utilisateur
- Protection contre les injections SQL
- Gestion des erreurs

## 6. Installation et Déploiement

### 6.1 Prérequis
- PHP 8.2 ou supérieur
- MySQL
- Serveur web (Apache/Nginx)
- Composer

### 6.2 Installation
1. Cloner le repository
2. Installer les dépendances : `composer install`
3. Configurer le fichier `.env`
4. Importer la base de données
5. Configurer le serveur web

### 6.3 Configuration
- Variables d'environnement dans `.env`
- Configuration de la base de données
- Paramètres du serveur web

## 7. Tests

### 7.1 Tests Unitaires
- Utilisation de PHPUnit
- Tests des fonctionnalités principales
- Tests de sécurité

### 7.2 Tests d'Intégration
- Tests des interactions entre composants
- Tests des scénarios d'utilisation

## 8. Maintenance

### 8.1 Sauvegarde
- Sauvegarde régulière de la base de données
- Gestion des logs

### 8.2 Mises à Jour
- Procédure de mise à jour
- Gestion des versions

## 9. Diagrammes

### 9.1 Diagrammes UML
- Diagramme de cas d'utilisation
- Diagramme de classes
- Diagramme de séquence
- Diagramme de composants
- Diagramme d'état

## 10. Annexes

### 10.1 Glossaire
- Définitions des termes techniques
- Abréviations utilisées

### 10.2 Références
- Documentation des technologies utilisées
- Liens utiles 