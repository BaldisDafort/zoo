<?php
ob_start();
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_SESSION['user'])) {
		$_SESSION['redirect_after_login'] = 'https://' . $_SERVER['HTTP_HOST'] . '/index.php?p=avis';
		$_SESSION['error_message'] = "Vous devez être connecté pour poster un avis.";
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/index.php?p=connexion');
		exit();
	}
	
	$nom = $_SESSION['user']['nickname'];
	$note = $_POST['note'];    
	$commentaire = htmlspecialchars($_POST['commentaire']);
	try {
		$stmt = $pdo->prepare("INSERT INTO avis (nom, note, commentaire) VALUES (?, ?, ?)");
		$stmt->execute([$nom, $note, $commentaire]);
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/index.php?p=avis&success=1');
		exit();
	} catch (PDOException $e) {
		$_SESSION['error_message'] = "Erreur lors de l'ajout de l'avis : " . $e->getMessage();
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/index.php?p=avis');
		exit();
	}
} else {
	header('Location: https://' . $_SERVER['HTTP_HOST'] . '/index.php?p=avis');
	exit();
}
?>