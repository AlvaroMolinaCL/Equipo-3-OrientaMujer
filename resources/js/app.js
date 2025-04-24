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