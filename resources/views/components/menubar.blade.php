<nav class="app-menubar">
    <div class="menu-container">

        <a href="#" class="menu-item">
            <img src="{{ asset('icons/beranda-icon.png') }}" alt="Beranda">
            <span>BERANDA</span>
        </a>

        <a href="#" class="menu-item">
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

        <a href="{{ route('profil') }}"
           class="menu-item {{ request()->routeIs('profil', 'profil.edit') ? 'active' : '' }}">
            <img src="{{ asset('icons/akun-icon.png') }}" alt="Akun">
            <span>AKUN</span>
        </a>

        <a href="#" class="menu-item">
            <img src="{{ asset('icons/lainnya-icon.png') }}" alt="Lainnya">
            <span>LAINNYA</span>
        </a>

    </div>
</nav>