<?php
/**
 * Vérifie si l'utilisateur est connecté
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user']);
}

/**
 * Vérifie si l'utilisateur est un administrateur
 * @return bool
 */
function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

/**
 * Vérifie si l'utilisateur a accès à une page
 * @param string $requiredRole Le rôle requis ('admin' ou 'client')
 * @return bool
 */
function hasAccess($requiredRole) {
    if (!isLoggedIn()) {
        return false;
    }
    
    if ($requiredRole === 'admin') {
        return isAdmin();
    }
    
    return true; // Les clients ont accès à toutes les pages non-admin
}

/**
 * Redirige l'utilisateur si il n'a pas les droits d'accès
 * @param string $requiredRole Le rôle requis
 * @param string $redirectUrl L'URL de redirection
 */
function requireRole($requiredRole, $redirectUrl = '../index.php') {
    if (!hasAccess($requiredRole)) {
        header('Location: ' . $redirectUrl);
        exit();
    }
}
?> 