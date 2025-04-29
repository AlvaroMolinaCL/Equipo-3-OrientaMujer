import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function updateNavbarLogoByClass() {
    const navbar = document.querySelector('.navbar');
    const logo = document.getElementById('logo-navbar');

    if (!navbar || !logo) return;

    const isDark = navbar.classList.contains('navbar-dark-mode');
    logo.src = isDark ? logo.dataset.white : logo.dataset.black;
}

document.addEventListener('DOMContentLoaded', updateNavbarLogoByClass);

document.addEventListener('DOMContentLoaded', function () {
    const faders = document.querySelectorAll('.fade-in-section');

    const appearOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const appearOnScroll = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, appearOptions);

    faders.forEach(fader => {
        appearOnScroll.observe(fader);
    });
});