<?php
// Inclure le fichier de configuration pour la connexion à la base de données
require_once 'config.php';

// Récupérer tous les animaux depuis la base de données
try {
    // Requête SQL pour récupérer les données des animaux
    $query = "SELECT id, name, video_url FROM animaux";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer les résultats sous forme de tableau associatif
} catch (PDOException $e) {
    die('Erreur lors de la récupération des animaux : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Animaux</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <LINK href="./nosanimaux.css" rel="stylesheet" type="text/css">

<body>
    <main class="main-content">
        <h2 class="section-title">Découvrez Nos Animaux</h2>
        <div class="animal-grid">
            <?php if (!empty($animaux)): ?>
                <?php foreach ($animaux as $animal): ?>
                    <div class="animal-card">
                        <div class="animal-video-container">
                            <video autoplay loop muted>
                                <source src="<?= htmlspecialchars($animal['video_url']) ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                        <div class="animal-info">
                            <h3 class="animal-name"><?= htmlspecialchars($animal['name']) ?></h3>
                            <div class="separator"></div>
                            <p class="animal-description"><?= htmlspecialchars($animal['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun animal trouvé dans la base de données.</p>
            <?php endif; ?>
        </div>
    </main>
    <script>
        function filterAnimals() {
            const searchInput = document.getElementById("search-bar").value.toLowerCase();
            const animalCards = document.querySelectorAll(".animal-card");

            animalCards.forEach((card) => {
                const animalName = card.querySelector("h3").textContent.toLowerCase();
                if (animalName.includes(searchInput)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>

</main>
