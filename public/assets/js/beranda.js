// Smooth scroll for Home link
const homeLink = document.querySelector('.nav-menu a[href="#home"]');
if (homeLink) {
    homeLink.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Smooth scroll for all navbar links (except Home)
document.querySelectorAll('.nav-menu a[href^="#"]:not([href="#home"])').forEach(link => {
    link.addEventListener('click', function(e) {
        const targetId = this.getAttribute('href').replace('#', '');
        const target = document.getElementById(targetId);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// Smooth scroll for footer links
const footerLinks = document.querySelectorAll('.footer-link');
footerLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#home') {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else if (href.startsWith('#')) {
            const targetId = href.replace('#', '');
            const target = document.getElementById(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

// Smooth scroll for 'Cari Kost' button
const cariKostBtn = document.querySelector('.btn-explore[href="#kamar"]');
if (cariKostBtn) {
    cariKostBtn.addEventListener('click', function(e) {
        const target = document.getElementById('kamar');
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
}

// Kost slider logic (scroll version)
const kostSlider = document.querySelector('.kost-slider');
const kostCards = document.querySelectorAll('.kost-card');
const btnLeft = document.querySelector('.kost-slider-btn-left');
const btnRight = document.querySelector('.kost-slider-btn-right');

function getVisibleCount() {
    if (window.innerWidth <= 700) return 1;
    if (window.innerWidth <= 1200) return 2;
    return 4;
}

function scrollKostSlider(direction) {
    const visible = getVisibleCount();
    const cardWidth = 240;
    const gap = 30;
    const scrollAmount = visible * (cardWidth + gap);
    kostSlider.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}

btnLeft && btnLeft.addEventListener('click', () => scrollKostSlider(-1));
btnRight && btnRight.addEventListener('click', () => scrollKostSlider(1));
window.addEventListener('resize', updateKostSlider);
window.addEventListener('DOMContentLoaded', updateKostSlider);

// Navbar scrollspy: highlight menu sesuai section di viewport
const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');
const sectionIds = Array.from(navLinks).map(link => link.getAttribute('href').replace('#', ''));
const sections = sectionIds.map(id => document.getElementById(id)).filter(Boolean);

function updateActiveNav() {
    let scrollPos = window.scrollY + 120; // offset for sticky navbar
    let activeIdx = 0;
    sections.forEach((section, i) => {
        if (section.offsetTop <= scrollPos) {
            activeIdx = i;
        }
    });
    navLinks.forEach((link, i) => {
        if (i === activeIdx) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}
window.addEventListener('scroll', updateActiveNav);
window.addEventListener('DOMContentLoaded', updateActiveNav);
