import './bootstrap';

// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'public/css/halaman-jadwal.css'],
            refresh: true,
        }),
    ],
});

document.addEventListener('DOMContentLoaded', () => {
    const body    = document.body;
    const toggle  = document.getElementById('menuToggle');
    const overlay = document.getElementById('menuOverlay');
    const menubar = document.getElementById('appMenubar');

    const isOpen = () => body.classList.contains('menu-open');

    function openMenu() {
        body.classList.add('menu-open');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Tutup menu');
        menubar.setAttribute('aria-hidden', 'false');
    }

    function closeMenu() {
        body.classList.remove('menu-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Buka menu');
        menubar.setAttribute('aria-hidden', 'true');
    }

    toggle.addEventListener('click', () => {
        isOpen() ? closeMenu() : openMenu();
    });

    // klik area gelap = tutup
    overlay.addEventListener('click', closeMenu);

    // tombol Esc = tutup
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen()) closeMenu();
    });

    // opsional: klik salah satu link menu langsung menutup navbar
    menubar.querySelectorAll('a.menu-item').forEach((link) => {
        link.addEventListener('click', () => {
            if (!link.getAttribute('href')?.startsWith('#')) closeMenu();
        });
    });
});