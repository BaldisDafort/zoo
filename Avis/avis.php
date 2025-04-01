<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donnez Votre Avis - Zoo de la Barben</title>
	<LINK href="../mes_styles.css" rel="stylesheet" type="text/css">
    <link href="./Avis/avis.css" rel="stylesheet">
</head>
<body>

<?php
require_once './config.php';
try {
    $stmt2 = $pdo->query("SELECT * FROM avis");
    $avis = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des avis : " . $e->getMessage());
}
?>
<header>
    <h1>Donnez Votre Avis - Nausicaà</h1>
</header>

<div class="container">
    <h2>Laissez votre avis</h2>
    <form id="reviewForm2" action="./avis_save.php" method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
		<div class="form-group">
            <label for="note">Note :</label>
            <select id="note" name="note" required>
                <option value="5">★★★★★ (5/5)</option>
                <option value="4">★★★★☆ (4/5)</option>
                <option value="3">★★★☆☆ (3/5)</option>
                <option value="2">★★☆☆☆ (2/5)</option>
                <option value="1">★☆☆☆☆ (1/5)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comment">Commentaire :</label>
            <textarea id="commentaire" name="commentaire" rows="4" required></textarea>
        </div>
        <button type="submit">Soumettre l'avis</button>
    </form>

    <h2>Avis des visiteurs</h2>
    <div id="reviewsContainer">
        <!-- Les avis ajoutés s'afficheront ici -->
		<?php foreach ($avis as $avi): ?>
			<div class="ticket-card">
				<?php echo " par ".htmlspecialchars($avi['nom']); ?></h3>
				<div class="price">
				<?php if ($avi['note']==1) print "★☆☆☆☆ (1/5)";?>
					<?php if ($avi['note']==2) print "★★☆☆☆ (2/5)";?>
					<?php if ($avi['note']==3) print "★★★☆☆ (3/5)";?>
					<?php if ($avi['note']==4) print "★★★★☆ (4/5)";?>
					<?php if ($avi['note']==5) print "★★★★★ (5/5)";?>
				</div>
				<p><?php echo htmlspecialchars($avi['commentaire']); ?></p>
			</div>
		<?php endforeach; ?>
		
    </div>
</div>

<script>
    // Fonction pour gérer la soumission du formulaire
    document.getElementById("reviewForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        // Récupérer les valeurs des champs
        const name = document.getElementById("name").value;
        const note = document.getElementById("note").value;
        const comment = document.getElementById("comment").value;
        
        // Créer un élément pour afficher l'avis
        const review = document.createElement("div");
        review.classList.add("review");
        
        // Ajouter le contenu de l'avis
        review.innerHTML = `
            <div class="review-name">${name}</div>
            <div class="review-note">${'★'.repeat(note) + '☆'.repeat(5 - note)} (${note}/5)</div>
            <p class="review-text">${comment}</p>
        `;
        
        // Ajouter l'avis au conteneur des avis
        document.getElementById("reviewsContainer").prepend(review);
        
        // Réinitialiser le formulaire
        document.getElementById("reviewForm").reset();
    });
</script>

</body>
</html>

<?php
function get_animaux_by_enclos($fk_id_enclos,$pdo) {
	$stmt = $pdo->query("SELECT name FROM relation_enclos_animaux,animaux WHERE relation_enclos_animaux.fk_id_animal=animaux.id and fk_id_enclos='$fk_id_enclos' order by name");
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
