const carouselImages = document.querySelector('.carousel-images');
const images = document.querySelectorAll('.carousel-images img');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

let counter = 0;
const size = images[0].clientWidth;

nextButton.addEventListener('click', () => {
    if (counter >= images.length - 1) return;
    carouselImages.style.transition = 'transform 0.4s ease-in-out';
    counter++;
    carouselImages.style.transform = `translateX(${-size * counter}px)`;
});

prevButton.addEventListener('click', () => {
    if (counter <= 0) return;
    carouselImages.style.transition = 'transform 0.4s ease-in-out';
    counter--;
    carouselImages.style.transform = `translateX(${-size * counter}px)`;
});
