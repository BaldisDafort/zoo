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

    $error = "";

    // Mise à jour des informations
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Upload de la photo
        if ($_FILES['photo']['name']!=""){
            $repertoire_pj ='./profile_picture/';
            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photo = $_SESSION['user_id']."_picture.".$extension;
            if (move_uploaded_file($_FILES['photo']['tmp_name'],$repertoire_pj.$photo)) {
                print "<center>PJ : Photo enregistré</center>";
                chmod($repertoire_pj.$photo, 0604);
            }
            else {
                print "<center>PJ : Erreur lors de l'enregistrement</center>";
            }
        }

        $nickname = trim($_POST['nickname']);
        $email = trim($_POST['email']);

        if (empty($nickname) || empty($email)) {
            $error = "Veuillez remplir tous les champs.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide.";
        } else {
            $updateStmt = $pdo->prepare("UPDATE users SET photo = :photo, nickname = :nickname, email = :email WHERE id = :id");
            $updateStmt->bindParam(':photo', $photo, PDO::PARAM_STR);
            $updateStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
            $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $updateStmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                // Redirection après la mise à jour réussie
                header('Location: profile.php');
                exit(); // Toujours inclure exit() après un header('Location')
            } else {
                $error = "Erreur lors de la mise à jour. Veuillez réessayer.";
            }
        }
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
    <title>Modifier le profil</title>
</head>
<body>
    <h1>Modifier le profil</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" enctype='multipart/form-data'> <!--Permet au serveur d'envoyer un temporary file qu'on va traiter par la suite (picture profile)-->
        <p>
            <label for="nickname">Nom d'utilisateur :</label>
            <input type="text" id="nickname" name="nickname" value="<?php print htmlspecialchars($user['nickname']); ?>" required>
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php print htmlspecialchars($user['email']); ?>" required>
        </p>
        <p>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <?php if(isset($user['photo'])) {?>
            <img src="./profile_picture/<?php print $user['photo'];?>"width="10%">
            <?php } ?>
        </p>
        <p>
            <button type="submit">Mettre à jour</button>
        </p>
    </form>

    <p><a href="profile.php">Retour au profil</a></p>
</body>
</html>
