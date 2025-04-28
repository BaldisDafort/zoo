<?php

require 'env-loader.php';

// Configuration pour OVH
$host = 'nausicnadmin.mysql.db';
$dbname = 'nausicnadmin';
$username = 'nausicnadmin';
$password = 'Admin0vh';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}