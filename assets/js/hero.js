let currentHeroIndex = 0;
const heroSlides = document.querySelectorAll('.hero-item');
const heroDots = document.querySelectorAll('.dot');
let heroInterval;

function showHeroSlide(index) {
    heroSlides.forEach(slide => slide.classList.remove('active'));
    heroDots.forEach(dot => dot.classList.remove('active'));
    heroSlides[index].classList.add('active');
    heroDots[index].classList.add('active');
    currentHeroIndex = index;
}
function nextHeroSlide() {
    let next = (currentHeroIndex + 1) % heroSlides.length;
    showHeroSlide(next);
}
function heroJump(index) {
    clearInterval(heroInterval);
    showHeroSlide(index);
    startHeroAutoSlide(); 
}
function startHeroAutoSlide() {
    heroInterval = setInterval(nextHeroSlide, 5000); 
}
document.addEventListener('DOMContentLoaded', () => {
    startHeroAutoSlide();
});
