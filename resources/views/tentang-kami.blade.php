<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>

    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menubar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="about-layout">

        {{-- Kolom kiri: menu --}}
        <aside class="about-menu">
            @include('components.menubar')
        </aside>

        {{-- Kolom tengah: konten --}}
        <main class="about-content">
            <h1>Tentang Kami</h1>
            <div class="about-scroll">
                <p>
                    Teksapala (Teknik Sanata Dharma Pecinta Alam) merupakan organisasi
                    yang mewadahi minat dan bakat dibidang kepecintaalaman bagi mahasiswa
                    yang dikhususkan bagi mahasiswa fakultas Teknik Universitas Sanata Dharma
                    Yogyakarta ...
                </p>
                <p>
                    Teksapala sendiri merupakan integrasi dari ide-ide mahasiswa fakultas
                    teknik pada saat itu ...
                </p>
            </div>
        </main>

        {{-- Kolom kanan: kontak --}}
        <aside class="about-contact">
            <h2>Hubungi Kami</h2>
            <ul>
                <li><a href="tel:+6281234567890"><i class="bi bi-telephone"></i></a></li>
                <li><a href="https://facebook.com/..." target="_blank"><i class="bi bi-facebook"></i></a></li>
                <li><a href="https://instagram.com/..." target="_blank"><i class="bi bi-instagram"></i></a></li>
            </ul>
        </aside>

    </div>
</body>
</html>