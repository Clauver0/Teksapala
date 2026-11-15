// Kebab menu: buka/tutup, klik di luar, Escape, navigasi panah, konfirmasi hapus.
(() => {
    const semuaMenu = () => document.querySelectorAll('[data-kebab]');

    const tutup = (menu, kembalikanFokus = false) => {
        const tombol = menu.querySelector('[data-kebab-tombol]');
        const daftar = menu.querySelector('.kebab-daftar');
        daftar.hidden = true;
        tombol.setAttribute('aria-expanded', 'false');
        if (kembalikanFokus) tombol.focus();
    };

    const buka = (menu) => {
        semuaMenu().forEach((m) => m !== menu && tutup(m)); // hanya satu menu terbuka
        const tombol = menu.querySelector('[data-kebab-tombol]');
        const daftar = menu.querySelector('.kebab-daftar');
        daftar.hidden = false;
        tombol.setAttribute('aria-expanded', 'true');
        daftar.querySelector('[role="menuitem"]')?.focus();
    };

    document.addEventListener('click', (e) => {
        const tombol = e.target.closest('[data-kebab-tombol]');

        if (tombol) {
            e.preventDefault();
            e.stopPropagation();
            const menu = tombol.closest('[data-kebab]');
            tombol.getAttribute('aria-expanded') === 'true' ? tutup(menu) : buka(menu);
            return;
        }

        // klik di luar menu -> tutup semua
        if (!e.target.closest('[data-kebab]')) semuaMenu().forEach((m) => tutup(m));
    });

    document.addEventListener('keydown', (e) => {
        const menu = e.target.closest('[data-kebab]');

        if (e.key === 'Escape') {
            semuaMenu().forEach((m) => tutup(m, m === menu));
            return;
        }

        if (!menu || !['ArrowDown', 'ArrowUp'].includes(e.key)) return;

        const daftar = menu.querySelector('.kebab-daftar');
        if (daftar.hidden) return;

        e.preventDefault();
        const item = [...daftar.querySelectorAll('[role="menuitem"]')];
        const sekarang = item.indexOf(document.activeElement);
        const arah = e.key === 'ArrowDown' ? 1 : -1;
        item[(sekarang + arah + item.length) % item.length].focus();
    });

    // Konfirmasi sebelum hapus
    document.addEventListener('submit', (e) => {
        const pesan = e.target.dataset.konfirmasi;
        if (pesan && !window.confirm(pesan)) e.preventDefault();
    });
})();
