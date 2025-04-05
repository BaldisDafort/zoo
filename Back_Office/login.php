<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="./login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php include("../nav.html"); ?>

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

    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="login-form">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Se connecter</button>
        </form>
        <p class="register-link">Pas encore inscrit ? <a href="register.php">Inscription</a></p>
    </div>
</body>
</html>
