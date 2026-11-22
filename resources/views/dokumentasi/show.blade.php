<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $jadwal->judul }} - Dokumentasi Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
</head>
<body class="dok-layout" style="background-image: url('{{ asset('icons/begroundberanda.jpg') }}');">

<div class="sidebar">
    @include('components.menubar')
</div>

<span class="dok-badge dok-badge-aktif">Detail Dokumentasi</span>

<main class="dok-panel">
    <header class="dok-panel-header">
        <a class="dok-back" href="{{ route('dokumentasi.index') }}" aria-label="Kembali ke daftar dokumentasi">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1>Planting</h1>
    </header>

    <div class="dok-panel-body">
        <article class="dok-detail">
            <h2 class="dok-detail-title">{{ $jadwal->judul }}</h2>

            <dl class="dok-meta">
                <div><dt>Tanggal</dt><dd>{{ $jadwal->tanggal_pelaksanaan?->translatedFormat('d F Y') ?? '-' }}</dd></div>
                <div><dt>Lokasi</dt><dd>{{ $jadwal->lokasi_pelaksanaan ?? '-' }}</dd></div>
                <div><dt>Partisipan</dt><dd>{{ $jadwal->jumlah_peserta ?? 0 }} orang</dd></div>
                @isset($jadwal->jumlah_tertanam)
                    <div><dt>Tertanam</dt><dd>{{ $jadwal->jumlah_tertanam }}</dd></div>
                @endisset
            </dl>

            @if ($jadwal->deskripsi)
                <h3 class="dok-section-label">Deskripsi</h3>
                <p class="dok-deskripsi">{{ $jadwal->deskripsi }}</p>
            @endif

            @forelse ($jadwal->dokumentasi as $dok)
                <section class="dok-entry">
                    <h3 class="dok-entry-title">{{ $dok->judul_foto }}</h3>
                    <p class="dok-entry-date">
                        Diunggah {{ $dok->tanggal_unggah?->translatedFormat('d F Y') }}
                    </p>

                    @if ($dok->deskripsi)
                        <p class="dok-deskripsi">{{ $dok->deskripsi }}</p>
                    @endif

<div class="dok-drive">
    @if ($dok->file_foto)
        <a class="dok-drive-link" href="{{ $dok->file_foto }}"
           target="_blank" rel="noopener noreferrer">
            Buka foto & video di Google Drive
        </a>
    @endif
</div>
                </section>
            @empty
                <p class="dok-empty">Belum ada foto atau video untuk kegiatan ini.</p>
            @endforelse
        </article>
    </div>
</main>

</body>
</html>