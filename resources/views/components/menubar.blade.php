<nav class="app-menubar">
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
</nav>