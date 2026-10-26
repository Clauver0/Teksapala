{{-- resources/views/dokumentasi/show.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Dokumentasi</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
</head>
<body>
    @include('components.menubar')

    <div class="container">
        <main class="main-content dok-page">
            <div class="dok-panel">
                <div class="dok-panel-head">
                    <a href="{{ route('dokumentasi.index') }}" class="dok-back">&larr;</a>
                    <h1 class="dok-panel-title">Planting</h1>
                </div>

                <article class="dok-detail">
                    <h2>{{ $jadwal->nama_kegiatan }}</h2>

                    <p class="dok-info">
                        Tanggal: {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id')->translatedFormat('d F Y') }}<br>
                        Partisipan: {{ $jadwal->jumlah_peserta }} Orang<br>
                        Tertanam: {{ $jadwal->jumlah_pohon }} Mangrove
                    </p>

                    @php $deskripsi = $jadwal->dokumentasi->pluck('deskripsi')->filter()->first(); @endphp
                    @if ($deskripsi)
                        <p class="dok-desc-label">Deskripsi:</p>
                        <p class="dok-desc">{!! nl2br(e($deskripsi)) !!}</p>
                    @endif

                    <section class="dok-gallery-box">
                        <h3>Foto</h3>
                        <div class="dok-gallery">
                            @foreach ($jadwal->dokumentasi as $dok)
                                <a href="{{ asset('storage/' . $dok->file_foto) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $dok->file_foto) }}"
                                         alt="{{ $dok->judul_foto }}"
                                         title="{{ $dok->judul_foto }}">
                                </a>
                            @endforeach
                        </div>
                    </section>
                </article>
            </div>
        </main>
    </div>
</body>
</html>