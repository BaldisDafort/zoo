<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enclos</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="enclos.css" rel="stylesheet" type="text/css">
	<script src="script.js"></script>
</head>
<body>
    <h1>Parc Animalier - Les Biomes et leurs Enclos</h1>
    <div class="biomes">
        <button class="biome-button" data-biome="bois-des-pins">Le Bois des Pins</button>
        <button class="biome-button" data-biome="belvedere">Le Belvédère</button>
        <button class="biome-button" data-biome="vallon-cascades">Le Vallon des Cascades</button>
    </div>

    <div class="enclos-carousel hidden" id="bois-des-pins">
        <h2>Enclos du Bois des Pins</h2>
        <div class="carousel-container">
            <div class="carousel" id="carousel">
                <div class="carousel-item">
                    <img src="cerfmacaque.png" alt="Cerf et Macaque Crabe">
                    <h3>Enclos du Cerf et du Macaque Crabe</h3>
                    <p>Animaux : Cerf et Macaque Crabe.</p>
                </div>
                <div class="carousel-item">
                    <img src="vautour.jpg" alt="Vautour">
                    <h3>Enclos du Vautour</h3>
                    <p>Animaux : Vautour.</p>
                </div>
				<div class="carousel-item">
                    <img src="nigaultantilope.png" alt="Nilgaut et Antilope">
                    <h3>Enclos du Nilgaut et de l'Antilope</h3>
                    <p>Animaux : Nilgaut et Antilope.</p>
                </div>
                <div class="carousel-item">
                    <img src="loup.jpg" alt="Loup d'Europe">
                    <h3>Enclos du Loup d'Europe</h3>
                    <p>Animaux : Loup d'Europe.</p>
                </div>
            </div>
        </div>
        <div class="carousel-controls">
            <button id="prev">&#10094;</button>
            <button id="next">&#10095;</button>
        </div>
        <button class="back-button">Retour aux Biomes</button>
    </div>

   
</body>
</html>
