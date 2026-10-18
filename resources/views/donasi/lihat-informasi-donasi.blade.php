<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Informasi Donasi - Teksapala</title>
    
    @vite(['resources/css/donasi.css'])
</head>
<body class="donasi-layout">

    <!-- SIDEBAR KIRI -->
    <div class="sidebar">
        <div>
            <button class="sidebar-top-btn">&lt;&lt;</button>

            <nav class="nav-menu">
                <a href="{{ route('beranda') }}" class="nav-link">
                    <img src="{{ asset('icons/beranda-icon.png') }}" alt="Beranda" class="nav-icon">
                    <span>BERANDA</span>
                </a>

                <a href="{{ route('donasi') }}" class="nav-link active">
                    <img src="{{ asset('icons/donasi-icon.png') }}" alt="Donasi" class="nav-icon">
                    <span>DONASI</span>
                </a>

                <a href="#" class="nav-link">
                    <img src="{{ asset('icons/jadwal-icon.png') }}" alt="Jadwal" class="nav-icon">
                    <span>JADWAL</span>
                </a>

                <a href="#" class="nav-link">
                    <img src="{{ asset('icons/dokumentasi-icon.png') }}" alt="Dokumen" class="nav-icon">
                    <span>DOKUMEN</span>
                </a>

                <a href="#" class="nav-link">
                    <img src="{{ asset('icons/akun-icon.png') }}" alt="Akun" class="nav-icon">
                    <span>AKUN</span>
                </a>
            </nav>
        </div>

        <div>
            <a href="#" class="nav-link">
                <img src="{{ asset('icons/lainnya-icon.png') }}" alt="Lainnya" class="nav-icon">
                <span>LAINNYA</span>
            </a>
        </div>
    </div>

    <!-- AREA KONTEN UTAMA -->
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
                @forelse($jadwals as $jadwal)
                <div class="donation-item">
                    <div>
                        <h3 class="donation-title">{{ $jadwal->lokasi_pelaksanaan ?? 'PENANAMAN MANGROVE DI PANTAI CEMARA' }}</h3>
                        <div class="donation-info">
                            <span>Donator <strong class="highlight-num">3</strong> <img src="{{ asset('images/icons/user-group.svg') }}" class="nav-icon-inline" alt="Donator"></span>
                        </div>
                        <div class="donation-info">
                            <span>Donasi Terkumpul <strong class="donation-amount-highlight">Rp 300.000,00</strong></span>
                            <a href="#" class="btn-detail">&gt;&gt; Detail</a>
                        </div>
                    </div>

                    <div class="donation-footer">
                        <span class="donation-date">
                            Pelaksanaan <strong>{{ $jadwal->tanggal ?? '12 Jan 2027' }}</strong>
                            <img src="{{ asset('images/icons/calendar.svg') }}" class="nav-icon-inline" alt="Tanggal">
                        </span>

                        <div class="action-buttons">
                            <a href="#" class="btn-donate">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
                @empty
                <!-- CARD 1 (MANGROVE) -->
                <div class="donation-item card-mangrove">
                    <div>
                        <h3 class="donation-title">PENANAMAN MANGROVE DI PANTAI CEMARA</h3>
                        <div class="donation-row">
                            <span>Donator <strong class="highlight-num">3</strong> 👥</span>
                        </div>
                        <div class="donation-row between">
                            <span>Donasi Terkumpul <strong class="donation-amount-highlight">Rp 300.000,00</strong> 🔗</span>
                            <a href="#" class="btn-detail">&gt;&gt; Detail</a>
                        </div>
                    </div>

                    <div class="donation-footer">
                        <span class="donation-date">
                            Pelaksanaan <strong>12 Jan 2027</strong> 📅
                        </span>
                        
                        <a href="#" class="btn-donate">Donasi Sekarang</a>
                    </div>
                </div>

                <!-- CARD 2 (PINUS) -->
                <div class="donation-item card-pinus">
                    <div>
                        <h3 class="donation-title">PENANAMAN PINUS DI BANTUL</h3>
                        <div class="donation-row">
                            <span>Donator <strong class="highlight-num">2</strong> 👥</span>
                        </div>
                        <div class="donation-row between">
                            <span>Donasi Terkumpul <strong class="donation-amount-highlight">Rp 100.000,00</strong> 🔗</span>
                            <a href="#" class="btn-detail">&gt;&gt; Detail</a>
                        </div>
                    </div>

                    <div class="donation-footer">
                        <span class="donation-date">
                            Pelaksanaan <strong>10 Mar 2027</strong> 📅
                        </span>
                        
                        <a href="#" class="btn-donate">Donasi Sekarang</a>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="content-footer">
                <button class="btn-sukarela">Donasi Sukarela</button>
                <button class="btn-bantu">Bantu?</button>
            </div>

        </div>
    </div>

</body>
</html>