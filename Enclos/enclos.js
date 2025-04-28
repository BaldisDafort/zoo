document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.querySelector("#carousel");
    const prevButton = document.querySelector("#prev");
    const nextButton = document.querySelector("#next");
    const indicatorsContainer = document.querySelector("#indicators");
    const items = document.querySelectorAll(".carousel-item");
    
    let currentIndex = 0;
    let isTransitioning = false;
    const totalItems = items.length;

    // Créer les indicateurs
    items.forEach((_, index) => {
        const indicator = document.createElement('span');
        indicator.classList.add('indicator');
        if (index === 0) indicator.classList.add('active');
        indicator.addEventListener('click', () => goToSlide(index));
        indicatorsContainer.appendChild(indicator);
    });

    const indicators = document.querySelectorAll('.indicator');

    function updateIndicators() {
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentIndex);
        });
    }

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

        // Mettre à jour les indicateurs
        updateIndicators();

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