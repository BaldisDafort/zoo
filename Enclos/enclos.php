<?php
require_once __DIR__ . '/../config.php';

// Récupération des informations des enclos
try {
    $stmt = $pdo->query("SELECT * FROM enclos");
    $enclos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des enclos : " . $e->getMessage());
}
?>

<div class="enclos-page">
    <section class="enclos-section">
        <h1>Parc Animalier - Les Animaux Marins</h1>
        <div class="carousel-container">
            <div class="carousel" id="carousel">
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/tortue-poissons.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Tortues et Poissons</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 1; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/requins.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Requins</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 2; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/raie.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Raies</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 3; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/poisson-styledansnemo.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Poissons Clowns</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 4; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/poisson-corail.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Poissons de Corail</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 5; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/otarie-trop-mingonne.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Otarie</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 6; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/meduse-champignon-bleu.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Méduse Champignon Bleu</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 7; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/manchot-swim.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Manchots</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 8; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/des-nemos.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Poissons Clowns</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 9; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/crabe-trop-mignon.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Crabe</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 10; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/banc-poissons.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Banc de Poissons</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 11; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <video autoplay loop muted playsinline>
                        <source src="../Assets/aquanimaux/videos/corail.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    <h3>Corail</h3>
                    <div class="enclos-status">
                        <?php 
                        $enclo = array_filter($enclos, function($e) { return $e['id'] == 12; });
                        $enclo = reset($enclo);
                        if ($enclo) {
                            echo $enclo['ouvert'] ? '<span class="status-open">Enclos ouvert</span>' : '<span class="status-closed">Enclos fermé</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <button id="prev">&#10094;</button>
                <button id="next">&#10095;</button>
            </div>
        </div>
    </section>
</div>
