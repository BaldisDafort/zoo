<?php
require_once '../config.php';
require_once 'functions.php';

// Vérifier si l'utilisateur est admin
requireRole('admin');

// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
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

<div class="admin-page">
    <div class="admin-container">
        <h1>Panneau d'administration</h1>
        
        <div class="admin-actions">
            <a href="../index.php?p=liste_users" class="admin-button">
                <h3>Gestion des utilisateurs</h3>
                <p>Gérer les comptes utilisateurs</p>
            </a>
            
            <a href="../index.php?p=edit_enclos" class="admin-button">
                <h3>Gestion des enclos</h3>
                <p>Modifier les informations des enclos</p>
            </a>
        </div>
    </div>
</div>

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
?>
