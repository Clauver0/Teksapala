<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul-halaman', 'Jadwal - Teksapala')</title>

    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kartu-jadwal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-jadwal.css') }}">
    @stack('styles')
</head>
<body class="dok-layout dok-bg-photo"
      style="background-image: url('{{ asset('img/background-dokumentasi.png') }}');">

    @include('components.menubar')

    <main class="dok-panel">
        @yield('kepala')

        <div class="dok-panel-body">
            @if (session('sukses'))
                <div class="alert alert-success" role="status">{{ session('sukses') }}</div>
            @endif

            @yield('konten')
        </div>

        @yield('kaki')
    </main>

    @stack('scripts')
</body>
</html>
