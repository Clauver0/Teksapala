<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Informasi Donasi - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/donasi.css') }}">
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
                <button class="tab-btn active">Donasi</button>
                <button class="tab-btn inactive">Catatan</button> 
            </div>

            <div class="donation-list">

                <!-- untuk CARD 1  -->
                <div class="donation-item card-mangrove" style="background-image: url('{{ asset('icons/don1.png') }}'); ">
                    <div>
                        <h3 class="donation-title">PENANAMAN MANGROVE DI PANTAI CEMARA</h3>
                        <div class="donation-info">
                            <span>Donator <strong class="highlight-num">3</strong> <img src="{{ asset('/icons/donatur.png') }}" class="nav-icon-inline" alt="Donator"></span>
                        </div>
                        <div class="donation-info">
                            <span>Donasi Terkumpul <strong class="donation-amount-highlight">Rp 300.000,00</strong> <img src="{{ asset('/icons/donasi-terkumpul.png') }}" class="nav-icon-inline" alt="Donasi Terkumpul"></span>
                            <a href="#" class="btn-detail">&gt;&gt; Detail</a>
                        </div>
                    </div>

                    <div class="donation-footer">
                        <span class="donation-date">
                            Pelaksanaan <strong>12 Jan 2027</strong>
                            <img src="{{ asset('/icons/jadwal-icon.png') }}" class="nav-icon-inline" alt="Tanggal">
                        </span>

                        <div class="action-buttons">
                            <a href="#" class="btn-donate">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>

                <!-- untuk CARD 2 (Diperbaiki tag div-nya) -->
                <div class="donation-item card-pinus" style="background-image: url('{{ asset('icons/don2.png') }}'); ">
                    <div>
                        <h3 class="donation-title">PENANAMAN PINUS DI BANTUL</h3>
                        <div class="donation-info">
                            <span>Donator <strong class="highlight-num">2</strong> <img src="{{ asset('/icons/donatur.png') }}" class="nav-icon-inline" alt="Donator"></span>
                        </div>
                        <div class="donation-info">
                            <span>Donasi Terkumpul <strong class="donation-amount-highlight">Rp 100.000,00</strong> <img src="{{ asset('/icons/donasi-terkumpul.png') }}" class="nav-icon-inline" alt="Donasi Terkumpul"></span>
                            <a href="#" class="btn-detail">&gt;&gt; Detail</a>
                        </div>
                    </div>

                    <div class="donation-footer">
                        <span class="donation-date">
                            Pelaksanaan <strong>10 Mar 2027</strong>
                            <img src="{{ asset('/icons/jadwal-icon.png') }}" class="nav-icon-inline" alt="Tanggal">
                        </span>

                        <div class="action-buttons">
                            <a href="#" class="btn-donate">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-footer">
                <button class="btn-sukarela">Donasi Sukarela</button>
                <button class="btn-bantu">Bantu?</button>
            </div>

        </div>
    </div>

</body>
</html>