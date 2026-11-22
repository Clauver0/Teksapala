<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Informasi Donasi - Teksapala</title>
<<<<<<< HEAD
<link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
=======
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kartu-jadwal.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
>>>>>>> 4c09a0884b4284102fc3d076a53ff7a654ba3b99
    @vite(['resources/css/donasi.css'])
    @vite(['resources/js/donasi.js'])
    @vite(['resources/css/Donasi-bulanan.css', 'resources/js/Donasi/donasi.js'])
    
</head>

    @vite(['resources/css/donasi.css', 'resources/js/help-model.js'])
</head>

<body class="donasi-layout" style="background-image: url('{{ asset('icons/haldonasi.jpg') }}');">

    <!-- Sidebar dipanggil di luar kontainer utama -->
    @include('components.menubar')

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="content-card">

            <div class="content-header">
                LIHAT INFORMASI DONASI
            </div>

            <div class="tab-container">
    <div class="tab-label active">Donasi</div>
</div>

            
<div class="donation-list">

    @forelse ($jadwals as $jadwal)

        <div class="donation-item"
             style="--gambar-kartu: url('{{ $jadwal->gambar_url }}');">

            <div>
                {{-- Nama kegiatan --}}
                <h3 class="donation-title">
                    {{ strtoupper($jadwal->judul) }}
                </h3>

                {{-- Jumlah peserta --}}
                <div class="donation-info">
                    <div class="donation-info-left">
                        <span>Peserta</span>

                        <strong class="highlight-num">
                            {{ $jadwal->jumlah_peserta ?? 0 }}
                        </strong>

                        <img src="{{ asset('icons/donatur.png') }}"
                             class="nav-icon-inline"
                             alt="Peserta">
                    </div>
                </div>

                {{-- Total donasi --}}
                <div class="donation-info">
                    <div class="donation-info-left">
                        <span>Donasi Terkumpul</span>

                        <strong class="donation-amount-highlight">
                            Rp {{ number_format($jadwal->total_donasi, 0, ',', '.') }},00
                        </strong>

                        <img src="{{ asset('icons/donasi-terkumpul.png') }}"
                             class="nav-icon-inline"
                             alt="Donasi Terkumpul">
                    </div>

                    <a href="{{ route('jadwal.show', $jadwal) }}"
                       class="btn-detail">
                        &gt;&gt; Detail
                    </a>
                </div>
            </div>

            {{-- Tanggal dan tombol donasi --}}
            <div class="donation-footer">

                <span class="donation-date">
                    Pelaksanaan

                    <strong>
                        {{ $jadwal->tanggal_pelaksanaan
                            ? $jadwal->tanggal_pelaksanaan->translatedFormat('d M Y')
                            : '-' }}
                    </strong>

                    <img src="{{ asset('icons/jadwal-icon.png') }}"
                         class="nav-icon-inline"
                         alt="Tanggal">
                </span>

                <div class="action-buttons">
    <a href="{{ route('donasi.bulanan', ['idJadwal' => $jadwal->id_jadwal]) }}"
       class="btn-donate">
        Donasi Sekarang
    </a>
</div>

            </div>

        </div>

    @empty

        <p>Belum ada jadwal penanaman yang tersedia.</p>

    @endforelse

</div>


            <div class="content-footer">
    <button type="button"
            class="btn-sukarela"
            onclick="window.location.href='{{ route('donasi.sukarela') }}'">
        Donasi Sukarela
    </button>

    <!-- Membuka pop-up bantuan pembayaran -->
    <button type="button" class="btn-bantu" onclick="openHelpModal()">Bantu?</button>
</div>

        </div>
    </div>

    @include('donasi.help-modal')
</body>
</html>