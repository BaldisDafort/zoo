<?php
$host = 'easyentbtsndrc.mysql.db';
$dbname = 'easyentbtsndrc';
$username = 'easyentbtsndrc'; 
$password = 'Ifasud123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}