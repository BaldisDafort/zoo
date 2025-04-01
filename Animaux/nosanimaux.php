
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
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\crabe_trop_mignon.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Crabe</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\manchot_swim.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Manchot</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\des_nemos.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Poisson clown</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            
            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\Tortue-Poissons.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Tortue</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\banc-poissons.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Banc de poissons</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\meduse-champignon-bleu.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Méduse</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\requins.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Requin</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\poisson-stylédansNEMO.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Idole mauresque</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\otarie_trop_mingonne.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Otarie</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\raie.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Raie</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\corail.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Corail</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
                </div>
            </div>

            <div class="animal-card">
                <div class="animal-video-container">
                    <video autoplay loop muted>
                        <source src="Assets\aquanimaux\videos\poisson_corail.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
                <div class="animal-info">
                    <h3 class="animal-name">Poisson-combattant</h3>
                    <div class="separator"></div>
                    <p class="animal-description">Description de l'animal ici.</p>
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
