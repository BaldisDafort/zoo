<?php

require 'env-loader.php';

// Configuration pour OVH
$host = 'nausicnadmin.mysql.db';
$dbname = 'nausicnadmin';
$username = 'nausicnadmin';
$password = 'Admin0vh';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_TIMEOUT => 10,
        PDO::ATTR_PERSISTENT => true
    ));
} catch (PDOException $e) {
    // Log de l'erreur pour le débogage
    error_log("Erreur de connexion à la base de données OVH : " . $e->getMessage());
    
    // Message d'erreur plus détaillé
    $error_message = "Erreur de connexion à la base de données : ";
    if (strpos($e->getMessage(), "getaddrinfo") !== false) {
        $error_message .= "Impossible de résoudre le nom d'hôte. Vérifiez votre connexion internet.";
    } elseif (strpos($e->getMessage(), "Connection timed out") !== false) {
        $error_message .= "La connexion a expiré. Vérifiez que le serveur est accessible.";
    } else {
        $error_message .= $e->getMessage();
    }
    
    die($error_message);
}