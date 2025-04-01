<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    // Récupération des informations de l'enclos sélectionné
    $stmt = $pdo->prepare("SELECT * FROM enclos WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $enclos = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$enclos) {
        throw new Exception("Enclos non trouvé.");
    }

    $error = "";

    // Mise à jour des informations
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ouvert = trim($_POST['ouvert']);
        $h_deb_repas = trim($_POST['h_deb_repas']);
        $h_fin_repas = trim($_POST['h_fin_repas']);
		
        if (empty($h_deb_repas) || empty($h_fin_repas)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            $updateStmt = $pdo->prepare("UPDATE enclos SET ouvert = :ouvert, h_deb_repas = :h_deb_repas, h_fin_repas = :h_fin_repas WHERE id = :id");
            $updateStmt->bindParam(':ouvert', $ouvert, PDO::PARAM_INT);
            $updateStmt->bindParam(':h_deb_repas', $h_deb_repas, PDO::PARAM_STR);
            $updateStmt->bindParam(':h_fin_repas', $h_fin_repas, PDO::PARAM_STR);
            $updateStmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                // Redirection après la mise à jour réussie
                header('Location: admin.php');
                exit(); // Toujours inclure exit() après un header('Location')
            } else {
                $error = "Erreur lors de la mise à jour. Veuillez réessayer.";
            }
        }
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données de l'enclos : " . $e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un enclos</title>
</head>
<body>
    <h1><center>Modifier un enclos</center></h1>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error); ?></td></tr>
    <?php endif; ?>

    <form method="post">
		<table align="center">
			<tr>
				<td><label for="name">Animaux présents dans l'enclos :</label></td>
				<td><?php echo get_animaux_by_enclos($enclos['id'],$pdo);?></td>
			</tr>
			<tr>
				<td><label for="ouvert">Ouvert :</label></td>
				<td>
					<select id="ouvert" name="ouvert" required>
						<option value="1" <?php if ($enclos['ouvert']==1) echo "selected"; ?>>OUI
						<option value="0" <?php if ($enclos['ouvert']==0) echo "selected"; ?>>NON
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="h_deb_repas">Heure de début de repas :</label></td>
				<td><input type="h_deb_repas" id="h_deb_repas" name="h_deb_repas" value="<?php print htmlspecialchars($enclos['h_deb_repas']); ?>" required></td>
			</tr>
			<tr>
				<td><label for="h_fin_repas">Heure de fin de repas :</label></td>
				<td><input type="h_fin_repas" id="h_fin_repas" name="h_fin_repas" value="<?php print htmlspecialchars($enclos['h_fin_repas']); ?>" required></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button type="submit">Mettre à jour</button></td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
    </form>

    <tr><td><a href="admin.php">Retour à l'administration</a></td></tr>
</body>
</html>
<?php
function get_animaux_by_enclos($fk_id_enclos,$pdo) {
	$stmt = $pdo->query("SELECT name FROM animaux WHERE id='$fk_id_enclos' order by name");
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$liste_animaux='';
	foreach ($animaux as $animal) {
		if ($liste_animaux=="") {
			$liste_animaux=$animal['name'];
		} else {
			$liste_animaux.=" - ".$animal['name'];
		}
	}
	return $liste_animaux;
}

