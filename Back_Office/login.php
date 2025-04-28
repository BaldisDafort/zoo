<?php
ob_start(); // Démarre le buffer de sortie
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';

// Si l'utilisateur est déjà connecté, rediriger vers la page demandée ou l'accueil
if (isset($_SESSION['user'])) {
    if (isset($_SESSION['redirect_after_login'])) {
        $redirect = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        header('Location: ' . $redirect);
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            if (isset($_SESSION['redirect_after_login'])) {
                $redirect = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']);
                header('Location: ' . $redirect);
            } else {
                header('Location: ../index.php?p=profil');
            }
            exit();
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Nausicaa</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <?php 
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']);
                ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="cta-button">Se connecter</button>
        </form>
        
        <p class="register-link">Pas encore de compte ? <a href="../index.php?p=register">S'inscrire</a></p>
    </div>
</body>
</html>
