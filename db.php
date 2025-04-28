<?php
$host = '/cloudsql/' . getenv('INSTANCE_CONNECTION_NAME');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("mysql:unix_socket=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT NOW() AS current_time');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo ':white_check_mark: Connexion réussie à Cloud SQL ! Heure actuelle : ' . $row['current_time'];
} catch (PDOException $e) {
    echo ':x: Erreur de connexion : ' . $e->getMessage();
}
?>