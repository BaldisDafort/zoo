document.addEventListener("DOMContentLoaded", () => {
    // Vérifier si nous sommes sur la page des enclos
    const carousel = document.querySelector("#carousel");
    if (!carousel) return; // Si le carrousel n'existe pas, on arrête l'exécution

    const prevButton = document.querySelector("#prev");
    const nextButton = document.querySelector("#next");
    const items = document.querySelectorAll(".carousel-item");
    
    let currentIndex = 0;
    let isTransitioning = false;
    const totalItems = items.length;

    function goToSlide(index) {
        if (isTransitioning) return;
        isTransitioning = true;

        // Mettre à jour l'index
        currentIndex = index;
        if (currentIndex < 0) currentIndex = totalItems - 1;
        if (currentIndex >= totalItems) currentIndex = 0;

        // Mettre à jour les classes des éléments
        items.forEach((item, i) => {
            item.classList.remove('active', 'prev', 'next');
            if (i === currentIndex) {
                item.classList.add('active');
            } else if (i === (currentIndex - 1 + totalItems) % totalItems) {
                item.classList.add('prev');
            } else if (i === (currentIndex + 1) % totalItems) {
                item.classList.add('next');
            }
        });

        // Réinitialiser l'état de transition après l'animation
        setTimeout(() => {
            isTransitioning = false;
        }, 500);
    }

    // Gestionnaire d'événements pour le bouton précédent
    prevButton.addEventListener("click", () => {
        if (!isTransitioning) {
            goToSlide(currentIndex - 1);
        }
    });

    // Gestionnaire d'événements pour le bouton suivant
    nextButton.addEventListener("click", () => {
        if (!isTransitioning) {
            goToSlide(currentIndex + 1);
        }
    });

    // Navigation au clavier
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevButton.click();
        } else if (e.key === 'ArrowRight') {
            nextButton.click();
        }
    });

    // Initialisation
    goToSlide(0);

    // Autoplay
    let autoplayInterval = setInterval(() => {
        nextButton.click();
    }, 5000);

    // Arrêter l'autoplay au survol
    carousel.addEventListener('mouseenter', () => {
        clearInterval(autoplayInterval);
    });

    // Reprendre l'autoplay quand la souris quitte
    carousel.addEventListener('mouseleave', () => {
        autoplayInterval = setInterval(() => {
            nextButton.click();
        }, 5000);
    });
}); 