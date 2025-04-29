<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once __DIR__ . '/../config.php';

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
	$_SESSION['error_message'] = "Vous devez être connecté pour laisser un avis.";
	header('Location: ../index.php?p=connexion&redirect=avis');
	exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		// Log des données reçues
		error_log("Données POST reçues : " . print_r($_POST, true));
		
		// Récupérer et nettoyer les données
		$nom = htmlspecialchars($_POST['nom']);
		$note = (int)$_POST['note'];
		$commentaire = htmlspecialchars($_POST['commentaire']);
		
		// Log des données nettoyées
		error_log("Données nettoyées - Nom: $nom, Note: $note, Commentaire: $commentaire");
		
		// Validation des données
		if (empty($nom) || empty($commentaire) || $note < 1 || $note > 5) {
			throw new Exception("Tous les champs sont obligatoires et la note doit être entre 1 et 5.");
		}
		
		// Vérifier la connexion à la base de données
		if (!$pdo) {
			throw new Exception("Erreur de connexion à la base de données");
		}
		
		// Préparer et exécuter la requête
		$stmt = $pdo->prepare("INSERT INTO avis (nom, note, commentaire) VALUES (?, ?, ?)");
		$result = $stmt->execute([$nom, $note, $commentaire]);
		
		if (!$result) {
			throw new Exception("Erreur lors de l'exécution de la requête");
		}
		
		// Message de succès
		$_SESSION['success_message'] = "Votre avis a été enregistré avec succès !";
		
		// Redirection vers la page des avis
		header('Location: ../index.php?p=avis');
		exit();
		
	} catch (Exception $e) {
		error_log("Erreur dans avis_save.php : " . $e->getMessage());
		$_SESSION['error_message'] = "Erreur lors de l'enregistrement de l'avis : " . $e->getMessage();
		header('Location: ../index.php?p=avis');
		exit();
	}
} else {
	// Si quelqu'un accède directement à ce fichier sans soumettre le formulaire
	header('Location: ../index.php?p=avis');
	exit();
}
?>