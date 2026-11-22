<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul-halaman', config('app.name'))</title>

    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kartu-jadwal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-jadwal.css') }}">
    @stack('styles')
</head>
<body>
    @include('components.menubar')

    {{-- Pesan sukses dari controller (->with('sukses', ...)) --}}
    @if (session('sukses'))
        <div class="pesan-sukses" role="status">{{ session('sukses') }}</div>
    @endif

    <main>
        @yield('konten')
    </main>

    @stack('scripts')
</body>
</html>
