document.addEventListener('DOMContentLoaded', function() {
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");
    const carouselImages = document.querySelector(".carousel__images");
    const images = Array.from(carouselImages.getElementsByClassName("carousel__image"));
    const imageCount = images.length;

    let currentImage = 0;

    prevButton.addEventListener("click", () => {
        currentImage = (currentImage - 1 + imageCount) % imageCount;
        updateCarousel();
    });

    nextButton.addEventListener("click", () => {
        currentImage = (currentImage + 1) % imageCount;
        updateCarousel();
    });

    function updateCarousel() {
        images.forEach((image, index) => {
            if (index === currentImage) {
                image.classList.add("carousel__image--active");
            } else {
                image.classList.remove("carousel__image--active");
            }
        });
    }

    updateCarousel();
});



