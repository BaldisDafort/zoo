<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
}
try {
    $stmt2 = $pdo->query("SELECT * FROM enclos");
    $enclos = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des enclos : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
<table align="center" cellpadding="20">
	<tr valign="top">
		<td align="center">
			<h1>Gestion des utilisateurs</h1>
			<table border="1" cellpadding="5">
				<tr>
					<th>ID</th>
					<th>Nom d'utilisateur</th>
					<th>Email</th>
				</tr>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo $user['id']; ?></td>
						<td><?php echo htmlspecialchars($user['nickname']); ?></td>
						<td><?php echo htmlspecialchars($user['email']); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</td>
		<td align="center">
			<h1>Gestion des enclos</h1>
			<table border="1" cellpadding="5">
				<tr>
					<th></th>
					<th>ID</th>
					<th>Animaux présents dans l'enclos</th>
					<th>Ouvert</th>
					<th>Heure de début de repas</th>
					<th>Heure de fin de repas</th>
				</tr>
				<?php foreach ($enclos as $enclo): ?>
					<tr align="center">
						<td><a href="edit_enclos.php?id=<?php echo $enclo['id']; ?>"><img src="../Assets/b_edit.jpg"/></a></td>
						<td><?php echo $enclo['id']; ?></td>
						<td><?php echo htmlspecialchars(get_animaux_by_enclos($enclo['id'],$pdo)); ?></td>
						<td><?php echo ($enclo['ouvert']==1) ? 'OUI' : 'NON'; ?></td>
						<td><?php echo htmlspecialchars($enclo['h_deb_repas']); ?></td>
						<td><?php echo htmlspecialchars($enclo['h_fin_repas']); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</td>
	</tr>
</table>	
    <p><a href="profile.php">Retour au profil</a></p>
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
