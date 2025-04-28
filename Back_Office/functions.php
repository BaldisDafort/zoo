<?php
require_once __DIR__ . '/logger.php';

/**
 * Vérifie si l'utilisateur est connecté
 * @return bool
 */
function isLoggedIn() {
    $logged = isset($_SESSION['user']);
    Logger::debug("Vérification connexion : " . ($logged ? "Connecté" : "Non connecté"));
    return $logged;
}

/**
 * Vérifie si l'utilisateur est un administrateur
 * @return bool
 */
function isAdmin() {
    $isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    Logger::debug("Vérification rôle admin : " . ($isAdmin ? "Admin" : "Non admin"));
    return $isAdmin;
}

/**
 * Vérifie si l'utilisateur a accès à une page
 * @param string $requiredRole Le rôle requis ('admin' ou 'client')
 * @return bool
 */
function hasAccess($requiredRole) {
    if (!isLoggedIn()) {
        Logger::error("Accès refusé : Utilisateur non connecté");
        return false;
    }
    
    if ($requiredRole === 'admin') {
        $hasAccess = isAdmin();
        Logger::debug("Vérification accès admin : " . ($hasAccess ? "Accès autorisé" : "Accès refusé"));
        return $hasAccess;
    }
    
    Logger::debug("Accès client autorisé");
    return true; // Les clients ont accès à toutes les pages non-admin
}

/**
 * Redirige l'utilisateur si il n'a pas les droits d'accès
 * @param string $requiredRole Le rôle requis
 * @param string $redirectUrl L'URL de redirection
 */
function requireRole($requiredRole, $redirectUrl = '../index.php') {
    if (!hasAccess($requiredRole)) {
        Logger::error("Redirection : Accès refusé pour le rôle " . $requiredRole);
        header('Location: ' . $redirectUrl);
        exit();
    }
    Logger::info("Accès autorisé pour le rôle " . $requiredRole);
}
?> 