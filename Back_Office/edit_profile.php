<?php
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php?p=connexion');
    exit();
}

try {
    // Récupération des informations de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception("Utilisateur non trouvé.");
    }

    $error = "";

    // Mise à jour des informations
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Debug: Afficher les informations du fichier uploadé
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";

        $nickname = trim($_POST['nickname']);
        $email = trim($_POST['email']);

        if (empty($nickname) || empty($email)) {
            $error = "Veuillez remplir tous les champs.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide.";
        } else {
            //Upload de la photo
            $photo = $user['photo'] ?? null; // Garde l'ancienne photo par défaut
            if (!empty($_FILES['photo']['name'])) {
                $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                
                // Debug: Afficher l'extension
                echo "<p>Extension détectée: $extension</p>";
                
                // Vérifier l'extension
                $allowed = array('jpg', 'jpeg', 'png', 'gif');
                if (!in_array($extension, $allowed)) {
                    $error = "Type de fichier non autorisé. Utilisez JPG, JPEG, PNG ou GIF.";
                } else {
                    $photo = $_SESSION['user']['id']."_picture.".$extension;
                    $tempFile = $_FILES['photo']['tmp_name'];
                    
                    // Debug: Afficher le chemin temporaire
                    echo "<p>Fichier temporaire: $tempFile</p>";
                    
                    // Créer le dossier s'il n'existe pas
                    $uploadDir = __DIR__ . '/profile_pictures/';
                    if (!file_exists($uploadDir)) {
                        if (!mkdir($uploadDir, 0777, true)) {
                            $error = "Impossible de créer le dossier d'upload. Vérifiez les permissions.";
                        }
                    }
                    
                    // Vérifier les permissions du dossier
                    if (!is_writable($uploadDir)) {
                        $error = "Le dossier d'upload n'a pas les permissions d'écriture. Vérifiez les permissions.";
                    }
                    
                    // Debug: Afficher le chemin de destination
                    echo "<p>Chemin de destination: " . $uploadDir . $photo . "</p>";
                    
                    // Déplacer le fichier
                    if (move_uploaded_file($tempFile, $uploadDir . $photo)) {
                        // Debug: Confirmer le succès
                        echo "<p>Fichier déplacé avec succès</p>";
                        
                        // Mettre à jour la base de données
                        $updateStmt = $pdo->prepare("UPDATE users SET photo = :photo, nickname = :nickname, email = :email WHERE id = :id");
                        $updateStmt->bindParam(':photo', $photo, PDO::PARAM_STR);
                        $updateStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
                        $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $updateStmt->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

                        if ($updateStmt->execute()) {
                            // Mise à jour des informations de session
                            $_SESSION['user']['nickname'] = $nickname;
                            $_SESSION['user']['email'] = $email;
                            $_SESSION['user']['photo'] = $photo;
                            
                            // Redirection après la mise à jour réussie
                            header('Location: ../index.php?p=profil');
                            exit();
                        } else {
                            $error = "Erreur lors de la mise à jour. Veuillez réessayer.";
                        }
                    } else {
                        $error = "Erreur lors de l'upload de la photo. Erreur PHP: " . error_get_last()['message'];
                    }
                }
            } else {
                // Mise à jour sans photo
                $updateStmt = $pdo->prepare("UPDATE users SET nickname = :nickname, email = :email WHERE id = :id");
                $updateStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
                $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
                $updateStmt->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

                if ($updateStmt->execute()) {
                    $_SESSION['user']['nickname'] = $nickname;
                    $_SESSION['user']['email'] = $email;
                    header('Location: ../index.php?p=profil');
                    exit();
                } else {
                    $error = "Erreur lors de la mise à jour. Veuillez réessayer.";
                }
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
    <link href="profile.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="profile-container">
        <h1>Modifier le profil</h1>

        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" enctype='multipart/form-data' class="profile-form">
            <div class="form-group">
                <label for="nickname">Nom d'utilisateur :</label>
                <input type="text" id="nickname" name="nickname" value="<?php print htmlspecialchars($user['nickname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php print htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/gif">
                <?php if(!empty($user['photo'])) { ?>
                    <img src="profile_pictures/<?php echo htmlspecialchars($user['photo']); ?>" width="100" class="profile-picture" alt="Photo de profil">
                <?php } ?>
            </div>
            <div class="form-group">
                <button type="submit" class="cta-button">Mettre à jour</button>
            </div>
        </form>

        <p><a href="../index.php?p=profil" class="cta-button">Retour au profil</a></p>
    </div>
</body>
</html>
