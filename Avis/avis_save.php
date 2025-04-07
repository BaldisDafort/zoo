<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nom = htmlspecialchars($_POST['nom']);
    $note = $_POST['note'];    
    $commentaire = htmlspecialchars($_POST['commentaire']);
    try {
        $stmt = $pdo->prepare("INSERT INTO avis (nom, note, commentaire) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $note, $commentaire]);
        header('Location: ../index.php?p=avis&success=1');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout de l'avis : " . $e->getMessage());
    }
}
?>