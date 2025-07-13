// Slider logic
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let currentSlide = 0;

function showSlide(idx) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === idx);
        dots[i].classList.toggle('active', i === idx);
    });
    currentSlide = idx;
}

dots.forEach((dot, i) => {
    dot.addEventListener('click', () => showSlide(i));
});

// Auto slide every 5 seconds
setInterval(() => {
    let next = (currentSlide + 1) % slides.length;
    showSlide(next);
}, 5000);

// Demo button animation
const demoBtn = document.getElementById('watchDemoBtn');
if (demoBtn) {
    demoBtn.addEventListener('click', () => {
        demoBtn.classList.add('clicked');
        setTimeout(() => demoBtn.classList.remove('clicked'), 300);
        alert('Demo video coming soon!');
    });
}
