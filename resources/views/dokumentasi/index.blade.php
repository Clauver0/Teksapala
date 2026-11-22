<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
</head>
<body class="dok-layout dok-bg-photo"
      style="background-image: url('{{ asset('img/background-dokumentasi.png') }}');">
<div class="sidebar">
    @include('components.menubar')
</div>

<main class="dok-panel">
    <header class="dok-panel-header">
        <h1>Planting</h1>
    </header>

    <div class="dok-panel-body">
        @forelse ($jadwals as $jadwal)
            <article class="dok-card"
                @if ($jadwal->gambar_url)
                    style="background-image: url('{{ $jadwal->gambar_url }}');"
                @endif>
                <div class="dok-card-overlay">
                    <h2 class="dok-card-title">{{ $jadwal->judul }}</h2>

                    <dl class="dok-stats">
                        <div class="dok-stat">
                            <dt>Partisipan</dt>
                            <dd>{{ $jadwal->jumlah_peserta ?? 0 }}</dd>
                        </div>
                    </dl>

                    <a class="dok-detail-link" href="{{ route('dokumentasi.show', $jadwal->id_jadwal) }}">
                        &gt;&gt; Detail
                    </a>
                </div>
            </article>
        @empty
            <p class="dok-empty">
                Belum ada dokumentasi. Dokumentasi muncul di sini setelah komunitas menambahkannya untuk kegiatan yang sudah terlaksana.
            </p>
        @endforelse
    </div>

    {{-- Area Bawah Container: Button Kelola Dokumentasi untuk Komunitas --}}
    <footer class="dok-panel-footer">
        @auth('komunitas')
            <a href="{{ route('komunitas.dokumentasi.index') }}" class="btn-kelola-dok">
                Kelola Dokumentasi
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-kelola-dok">
                Kelola Dokumentasi (Login Komunitas)
            </a>
        @endauth
    </footer>
</main>

</body>
</html>