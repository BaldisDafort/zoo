
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Animaux</title>
    <link href="./Animaux/nosanimaux.css" rel="stylesheet">
    <LINK href="../mes_styles.css" rel="stylesheet" type="text/css">

<body>
    <main class="main-content">
        <h2 class="section-title">Découvrez Nos Animaux</h2>
        <div class="search-container">
            <input
                type="text"
                id="search-bar"
                placeholder="Recherchez un animal..."
                onkeyup="filterAnimals()"
            />
        </div>
        <div class="animal-grid">
            <div class="animal-card">
            <video autoplay loop muted src="Assets\aquanimaux\videos\crabe_trop_mignon.mp4" alt="Loups gris" class="animal-image">
                <div class="animal-info">
                    <h3>Loups Gris</h3>
                    <p>Observez ces prédateurs fascinants dans leur habitat reconstitué</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\manchot_swim.mp4" alt="Pandas géants" class="animal-image">
                <div class="animal-info">
                    <h3>Pandas géants</h3>
                    <p>Venez découvrir ces magnifiques ursidés dans leur espace dédié</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\des_nemos.mp4" alt="Girafes de Rothschild" class="animal-image">
                <div class="animal-info">
                    <h3>Girafes de Rothschild</h3>
                    <p>Admirez la grâce de ces grands herbivores dans la savane provençale</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\Tortue-Poissons.mp4" alt="Ours bruns" class="animal-image">
                <div class="animal-info">
                    <h3>Ours Bruns</h3>
                    <p>Découvrez la force et la puissance de ces mammifères emblématiques</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\banc-poissons.mp4" alt="Nasique" class="animal-image">
                <div class="animal-info">
                    <h3>Nasique</h3>
                    <p>Observez ce singe arboricole de la famille des cercopithecidés endémique de l'île de Bornéo</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\meduse-champignon-bleu.mp4" alt="Caïman noir" class="animal-image">
                <div class="animal-info">
                    <h3>Caïman noir</h3>
                    <p>Découvrez ces reptiles dans la reconstitution des eaux douces d'Amérique centrale</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\requins.mp4" alt="Tigre du Bengale" class="animal-image">
                <div class="animal-info">
                    <h3>Tigre du Bengale</h3>
                    <p>Observez ce prédateur majestueux dans les mangroves reconstituées</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\poisson-stylédansNEMO.mp4" alt="Perroquet" class="animal-image">
                <div class="animal-info">
                    <h3>Perroquet</h3>
                    <p>Découvrez ces oiseaux psittaciformes, connus pour leur imitation des sons</p>
                </div>
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\otarie_trop_mingonne.mp4" alt="Python royal" class="animal-image">
                <div class="animal-info">
                    <h3>Python royal</h3>
                    <p>Observez ce serpent dans une grande variété d’habitats</p>
                </div>    
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\raie.mp4" alt="Zèbre" class="animal-image">
                <div class="animal-info">
                    <h3>Zèbre</h3>
                    <p>Découvrez nos zèbres aux rayures uniques</p>
                </div> 
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\corail.mp4" alt="Lion" class="animal-image">
                <div class="animal-info">
                    <h3>Lion</h3>
                    <p>Observez le roi de la savane dans un environnement captivant</p>
                </div> 
            </div>
            <div class="animal-card">
                <video autoplay loop muted src="Assets\aquanimaux\videos\poisson_corail.mp4" alt="Suricate" class="animal-image">
                <div class="animal-info">
                    <h3>Suricate</h3>
                    <p>Découvrez ces petites mangoustes, sentinelles de la savane</p>
                </div>
            </div>         
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
