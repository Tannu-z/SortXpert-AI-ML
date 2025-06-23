// Loader
window.addEventListener('load', () => {
    document.getElementById('loader').style.display = 'none';
});

// Sliding Images
let slideIndex = 0;

function updateSlide() {
    const slider = document.querySelector('.slider');
    slider.style.transform = `translateX(-${slideIndex * 220}px)`;
}

function nextSlide() {
    const images = document.querySelectorAll('.slider img');
    if (slideIndex < images.length - 3) {
        slideIndex++;
        updateSlide();
    }
}

function prevSlide() {
    if (slideIndex > 0) {
        slideIndex--;
        updateSlide();
    }
}

// Back-to-Top Button
window.onscroll = function () {
    const btn = document.getElementById('back-to-top');
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        btn.style.display = 'block';
    } else {
        btn.style.display = 'none';
    }
};

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
