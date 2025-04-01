<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nom = htmlspecialchars($_POST['nom']);
    $fk_id_enclos = $_POST['fk_id_enclos'];
    $note = $_POST['note'];    
    $commentaire = htmlspecialchars($_POST['commentaire']);
    try {
        $stmt = $pdo->prepare("INSERT INTO avis (nom, fk_id_enclos, note, commentaire) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom,$fk_id_enclos, $note, $commentaire]);
        header('Location: avis.php?success=1');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout de l'avis : " . $e->getMessage());
    }
}
?>