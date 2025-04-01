<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $fk_id_profil = 2; //ca permettra de faire en sorte que les nouveau inscrits seront en compte client et non admin

    try {
        $stmt = $pdo->prepare("INSERT INTO users (fk_id_profil, nickname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([1,$nickname, $email, $password]);
        header('Location: login.php?success=1');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST"> <!DOCTYPE html> <!--Envoie le formulaire avec la method POST ligne 4 -->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>
        <input type="text" name="nickname" placeholder="Pseudonyme" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
