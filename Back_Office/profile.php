<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    // Récupération des informations de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception("Utilisateur non trouvé.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données utilisateur : " . $e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h1>Profil de <?php print htmlspecialchars($user['nickname']); ?></h1>
    <p><strong>Nom d'utilisateur :</strong> <?php print htmlspecialchars($user['nickname']); ?></p>
    <p><strong>Email :</strong> <?php print htmlspecialchars($user['email']); ?></p>
    
    <p><a href="edit_profile.php">Modifier le profil</a></p>
    <p><a href="logout.php">Déconnexion</a></p>
    <p><a href="admin.php">Accéder au panneau d'administration</a></p>
</body>
</html>
