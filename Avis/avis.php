<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
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
    <form id="reviewForm" action="../Avis/avis_save.php" method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['nickname']) : ''; ?>" readonly>
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
        <button type="submit" class="cta-button">Soumettre l'avis</button>
    </form>

    <h2>Avis des visiteurs</h2>
    <div id="reviewsContainer">
        <!-- Les avis ajoutés s'afficheront ici -->
		<?php foreach ($avis as $avi): ?>
			<div class="ticket-card">
				<h3><?php echo " par ".htmlspecialchars($avi['nom']); ?></h3>
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