{{-- resources/views/dokumentasi/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentasi</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
</head>
<body>
    @include('components.menubar')

    <div class="container">
        <main class="main-content dok-page">
            <div class="dok-panel">
                <h1 class="dok-panel-title">Planting</h1>

                <div class="dok-list">
                    @forelse ($jadwals as $jadwal)
                        @php
                            $cover = $jadwal->dokumentasi->first();
                            $bg = $cover
                                ? asset('storage/' . $cover->file_foto)
                                : asset('images/forest.jpg');
                        @endphp

                        <a href="{{ route('dokumentasi.show', $jadwal->id_jadwal) }}"
                           class="dok-card"
                           style="background-image: linear-gradient(rgba(0,0,0,.35), rgba(0,0,0,.55)), url('{{ $bg }}')">
                            <h2>{{ $jadwal->nama_kegiatan }}</h2>

                            <div class="dok-stat">
                                <span>Partisipan</span>
                                <strong>{{ $jadwal->jumlah_peserta }}</strong>
                            </div>
                            <div class="dok-stat">
                                <span>Tertanam</span>
                                <strong>{{ $jadwal->jumlah_pohon }}</strong>
                            </div>

                            <span class="dok-detail-link">&gt;&gt; Detail</span>
                        </a>
                    @empty
                        <p class="dok-empty">Belum ada dokumentasi.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>
</html>