document.addEventListener("DOMContentLoaded", () => {
    const biomeButtons = document.querySelectorAll(".biome-button");
    const backButton = document.querySelector(".back-button");
    const carousel = document.querySelector("#carousel");
    const prevButton = document.querySelector("#prev");
    const nextButton = document.querySelector("#next");

    let currentIndex = 0;

    // Navigation entre les biomes
    biomeButtons.forEach(button => {
        button.addEventListener("click", () => {
            const biomeId = button.dataset.biome;
            document.querySelector(".biomes").classList.add("hidden");
            document.getElementById(biomeId).classList.remove("hidden");
        });
    });

    // Retour à la liste des biomes
    backButton.addEventListener("click", () => {
        document.querySelector(".biomes").classList.remove("hidden");
        document.querySelectorAll(".enclos-carousel").forEach(carousel => carousel.classList.add("hidden"));
    });

    // Mise à jour du carrousel
    const updateCarousel = () => {
        const offset = -currentIndex * 100;
        carousel.style.transform = `translateX(${offset}%)`;
    };

    // Bouton précédent
    prevButton.addEventListener("click", () => {
        const totalItems = document.querySelectorAll(".carousel-item").length;
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalItems - 1;
        updateCarousel();
    });

    // Bouton suivant
    nextButton.addEventListener("click", () => {
        const totalItems = document.querySelectorAll(".carousel-item").length;
        currentIndex = (currentIndex < totalItems - 1) ? currentIndex + 1 : 0;
        updateCarousel();
    });

    updateCarousel(); // Initialisation du carrousel
});
