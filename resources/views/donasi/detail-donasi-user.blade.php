<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Donasi {{ $donasi->id_donasi }} - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/donasi-komunitas.css') }}">
</head>
<body class="dok-layout" style="background-image: url('{{ asset('img/background-riwayat.png') }}');">

<div class="sidebar">
    @include('components.menubar')
</div>

<main class="dok-panel">
    <header class="dok-panel-header">
        <a class="dok-back" href="{{ route('profil') }}" aria-label="Kembali ke Profil">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1>Rincian Pembayaran Donasi</h1>
    </header>

    <div class="dok-panel-body">
        @php
            $namaTampil = $donasi->donatur?->display_name
                ?: ($donasi->donatur?->nama_lengkap ?: ($donasi->donatur?->username ?? '-'));
        @endphp

        <article class="dok-detail">
            <h2 class="dok-detail-title">{{ $donasi->id_donasi }}</h2>

            <dl class="dok-meta">
                <div>
                    <dt>Donatur</dt>
                    <dd>{{ $namaTampil }}</dd>
                </div>
                <div>
                    <dt>Nominal</dt>
                    <dd><strong>Rp {{ number_format((float) $donasi->nominal_donasi, 0, ',', '.') }}</strong></dd>
                </div>
                <div>
                    <dt>Metode</dt>
                    <dd>{{ $donasi->metode_donasi }}</dd>
                </div>
                <div>
                    <dt>Waktu</dt>
                    <dd>{{ \Carbon\Carbon::parse($donasi->waktu_donasi)->translatedFormat('d F Y H:i') }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd>
                        @if ($donasi->status_verifikasi === 'Terverifikasi')
                            <span class="badge-status badge-verified">Terverifikasi</span>
                        @elseif ($donasi->status_verifikasi === 'Ditolak')
                            <span class="badge-status badge-rejected">Ditolak</span>
                        @else
                            <span class="badge-status badge-pending">Belum Terverifikasi (Pending)</span>
                        @endif
                    </dd>
                </div>
            </dl>

            <h3 class="dok-section-label">Jadwal & Tanaman yang Didonasikan</h3>
            @if ($donasi->detailDonasis->isNotEmpty())
                <ul class="tanaman-list">
                    @foreach ($donasi->detailDonasis as $detail)
                        @php
                            $namaTanaman = $detail->jadwalTanaman?->tanaman?->nama_tanaman ?? 'Tanaman';
                            $jadwalInfo = $detail->jadwalTanaman?->jadwal?->judul
                                ?? $detail->jadwalTanaman?->jadwal?->lokasi_pelaksanaan
                                ?? '-';
                        @endphp
                        <li>
                            <strong>{{ $namaTanaman }}</strong> — {{ $detail->jumlah_tanaman }} pohon
                            <em>(Jadwal: {{ $jadwalInfo }})</em>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="dok-muted donasi-muted-dark">Donasi sukarela (tidak terikat item tanaman tertentu).</p>
            @endif

            <div class="dok-entry">
                <h3 class="dok-entry-title">Foto Bukti Pembayaran</h3>
                @if ($donasi->bukti_donasi)
                    <div class="bukti-box">
                        <img src="{{ asset('storage/' . $donasi->bukti_donasi) }}" alt="Bukti donasi {{ $donasi->id_donasi }}">
                    </div>
                @else
                    <p class="dok-muted donasi-muted-dark">Tidak ada file bukti donasi.</p>
                @endif
            </div>
        </article>
    </div>
</main>

</body>
</html>