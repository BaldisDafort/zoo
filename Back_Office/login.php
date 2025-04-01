<?php
require_once '../config.php';
session_start(); //Permet d'acceder au profil du user (name, mdp etc..)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email"); //fais une requete SQL qui récupère tous les champs que le user vient d'entrer. Cette requete permet d'empecher les injections SQL
        $stmt->bindParam(':email', $email); // permet d'associer le :email de la requete SQL avec le mail $email
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // fetch permet de récupérer le résultat de la requete et de le save dans le tableau user

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nickname'] = $user['nickname'];
            $_SESSION['profil'] = $user['fk_id_profil'];
            header('Location: profile.php'); //redirige vers la page profil
            exit();
        } else {
            $error = "Identifiants incorrects."; // Affiche au user le message d'erreur ligne 54
        }
    } catch (PDOException $e) { //Affiche les classes d'erreur
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
	<LINK href="./mes_styles.css" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .form-container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Connexion</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <br><br>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <br><br>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="register.php">Inscription</a></p>
    </div>
</body>
</html>
