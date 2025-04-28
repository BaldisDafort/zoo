<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'nausicnadmin.mysql.db';
$dbname = 'nausicnadmin';
$username = 'nausicnadmin';
$password = 'Admin0vh'; // Remplace par ton mot de passe si besoin

echo "<h1>Test de connexion à la base de données</h1>";
echo "<pre>";

try {
    echo "Tentative de connexion à la base de données...\n";
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    echo "DSN: " . $dsn . "\n\n";
    
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion établie !\n\n";
    // Test de la connexion
    $stmt = $pdo->query('SELECT NOW()');
    $row = $stmt->fetch(PDO::FETCH_NUM);
    echo "✅ Connexion réussie à la base de données OVH !\n";
    echo "Heure actuelle de la base de données : " . $row[0] . "\n";
} catch (PDOException $e) {
    echo "❌ ERREUR DE CONNEXION\n";
    echo "Message : " . $e->getMessage() . "\n";
    echo "Code : " . $e->getCode() . "\n";
    echo "Fichier : " . $e->getFile() . "\n";
    echo "Ligne : " . $e->getLine() . "\n";
}
echo "</pre>";
?> 