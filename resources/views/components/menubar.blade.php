{{-- Tombol toggle (garis 3 ↔ panah back) --}}
<button id="menuToggle" class="menu-toggle" type="button"
        aria-label="Buka menu" aria-expanded="false" aria-controls="appMenubar">
    <span class="menu-toggle__icon menu-toggle__icon--open">
        <span></span><span></span><span></span>
    </span>
    <span class="menu-toggle__icon menu-toggle__icon--back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5"></path>
            <path d="M12 19l-7-7 7-7"></path>
        </svg>
    </span>
</button>

<div class="menu-overlay" id="menuOverlay"></div>

<nav class="app-menubar" id="appMenubar" aria-hidden="true">
    <div class="menu-container">

        <a href="{{ route('beranda') }}"
            class="menu-item {{ request()->routeIs('beranda') ? 'active' : '' }}">
            <img src="{{ asset('icons/beranda-icon.png') }}" alt="Beranda">
            <span>BERANDA</span>
        </a>

        <a href="{{ route('donasi') }}"
            class="menu-item {{ request()->routeIs('donasi') ? 'active' : '' }}">
            <img src="{{ asset('icons/donasi-icon.png') }}" alt="Donasi">
            <span>DONASI</span>
        </a>

        <a href="#" class="menu-item">
            <img src="{{ asset('icons/jadwal-icon.png') }}" alt="Jadwal">
            <span>JADWAL</span>
        </a>

        <a href="{{ route('dokumentasi.index') }}"
           class="menu-item {{ request()->routeIs('dokumentasi.*') ? 'active' : '' }}">
            <img src="{{ asset('icons/dokumentasi-icon.png') }}" alt="Dokumentasi">
            <span>DOKUMENTASI</span>
        </a>

        @if(Auth::guard('komunitas')->check())
            <a href="{{ route('jurnal') }}"
                class="menu-item {{ request()->routeIs('jurnal', 'jurnals.*') ? 'active' : '' }}">
                <img src="{{ asset('icons/jurnal-icon.png') }}" alt="Jurnal">
                <span>JURNAL</span>
            </a>
        @endif

        @php
            $loggedIn = Auth::guard('donatur')->check() || Auth::guard('komunitas')->check();
        @endphp

        <a href="{{ $loggedIn ? route('profil') : route('login') }}"
            class="menu-item {{ request()->routeIs('profil', 'profil.edit', 'login', 'register') ? 'active' : '' }}">
            <img src="{{ asset('icons/akun-icon.png') }}" alt="Akun">
            <span>{{ $loggedIn ? 'AKUN' : 'LOGIN' }}</span>
        </a>

        <a href="{{ route('tentang') }}"
            class="menu-item {{ request()->routeIs('tentang') ? 'active' : '' }}">
            <img src="{{ asset('icons/lainnya-icon.png') }}" alt="Lainnya">
            <span>LAINNYA</span>
        </a>

    </div>
    <div class="menu-image">
        {{-- Ganti 'img/logo-teksapala.png' dengan path gambar kamu --}}
        <img src="{{ asset('img/logo-teksapala.png') }}" alt="Logo Teksapala">
    </div>
</nav>

{{-- ✅ INI YANG SEBELUMNYA HILANG --}}
@once
<script>
document.addEventListener('DOMContentLoaded', () => {
    const body    = document.body;
    const toggle  = document.getElementById('menuToggle');
    const overlay = document.getElementById('menuOverlay');
    const menubar = document.getElementById('appMenubar');

    if (!toggle || !menubar) return;

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

    toggle.addEventListener('click', () => isOpen() ? closeMenu() : openMenu());
    overlay.addEventListener('click', closeMenu);

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && isOpen()) closeMenu();
    });

    // klik link menu → tutup drawer
    menubar.querySelectorAll('a.menu-item').forEach(link => {
        link.addEventListener('click', () => {
            if (!link.getAttribute('href')?.startsWith('#')) closeMenu();
        });
    });

    // resize ke desktop → bersihkan state
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992 && isOpen()) closeMenu();
    });
});
</script>
@endonce