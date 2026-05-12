(function () {
    const track = document.getElementById('sliderTrack');
    const cards = track.querySelectorAll('.slide-card');
    const total = cards.length;
    let current = 0;
    let startX = 0;
    function getVisible() {
        return window.innerWidth >= 768 ? 2 : 1;
    }
    function maxIndex() {
        return Math.max(0, total - getVisible());
    }
    function updateSlider() {
        const cardWidth = cards[0].offsetWidth + 32;
        track.style.transform = `translateX(-${current * cardWidth}px)`;
        document.getElementById('btnPrev').disabled = current === 0;
        document.getElementById('btnNext').disabled = current >= maxIndex();
    }
    window.moveSlide = function (dir) {
        current = Math.min(Math.max(current + dir, 0), maxIndex());
        updateSlider();
    };
    track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; });
    track.addEventListener('touchend', e => {
        const diff = startX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) moveSlide(diff > 0 ? 1 : -1);
    });
    window.addEventListener('resize', updateSlider);
    updateSlider();
})();