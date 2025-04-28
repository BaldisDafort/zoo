<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $fk_id_profil = 2; // Les nouveaux inscrits seront en compte client

    try {
        $stmt = $pdo->prepare("INSERT INTO users (fk_id_profil, nickname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fk_id_profil, $nickname, $email, $password]);
        $_SESSION['redirect'] = '/index.php?p=connexion';
        return;
    } catch (PDOException $e) {
        $error = "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Nausicaa</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="login-container">
        <h2>Inscription</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" class="login-form">
            <div class="form-group">
                <label for="nickname">Pseudonyme :</label>
                <input type="text" id="nickname" name="nickname" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">S'inscrire</button>
        </form>
        <p class="register-link">Déjà inscrit ? <a href="../index.php?p=connexion">Connexion</a></p>
    </div>
</body>
</html>
