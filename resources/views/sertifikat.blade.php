<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unduh Sertifikat</title>
    
    <!-- 1. Panggil Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- 2. Panggil CSS Navbar -->
    <link rel="stylesheet" href="{{ asset('css/menubar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    
    <!-- 3. Panggil CSS Murni Halaman Ini -->
    <link rel="stylesheet" href="{{ asset('css/sertifikat.css') }}">
</head>
<body>

    <!-- NAVBAR KIRI -->
    @include('components.menubar')

    <!-- KONTEN UTAMA (KANAN) -->
    <div class="main-wrapper">
        
        <div class="card-container">
            
            <!-- Pembungkus Kartu -->
            <div class="cards-wrapper">
                
                <!-- ================= KARTU DONASI 1 ================= -->
                <div class="card">
                    
                    <div class="card-header">
                        <h2>DONASI PADA</h2>
                        <span>Penanaman Bibit Bakau di Pantai Cemara</span>
                    </div>
                    
                    <div class="card-body">
                        <img src="https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2070&auto=format&fit=crop" alt="Hutan">
                        <div class="card-overlay"></div>
                        
                        <div class="card-content">
                            <div class="peserta-row">
                                <span class="label">Peserta</span>
                                <span class="value">20</span>
                                <!-- Ikon User SVG -->
                                <svg style="width: 1rem; height: 1rem; margin-bottom: 0.125rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="donasi-row">
                                <span class="label">Total Donasi</span>
                                <span class="value">Rp 700.000,00</span>
                            </div>
                            <a href="#" class="detail-link">
                                <span>&gt;&gt;</span> Detail
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="nilai-label">NILAI</span>
                            <span class="nilai-value">RP 200.000,-</span>
                        </div>
                        <button class="btn-sertifikat">
                            Sertifikat
                        </button>
                    </div>
                </div>

                <!-- ================= KARTU DONASI 2 ================= -->
                <div class="card">
                    
                    <div class="card-header">
                        <h2>DONASI PADA</h2>
                        <span>Penanaman Bibit Pinus di Bantul</span>
                    </div>
                    
                    <div class="card-body">
                        <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?q=80&w=2070&auto=format&fit=crop" alt="Hutan Pinus">
                        <div class="card-overlay"></div>
                        
                        <div class="card-content">
                            <div class="peserta-row">
                                <span class="label">Peserta</span>
                                <span class="value">20</span>
                                <svg style="width: 1rem; height: 1rem; margin-bottom: 0.125rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="donasi-row">
                                <span class="label">Total Donasi</span>
                                <span class="value">Rp 700.000,00</span>
                            </div>
                            <a href="#" class="detail-link">
                                <span>&gt;&gt;</span> Detail
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="nilai-label">NILAI</span>
                            <span class="nilai-value">RP 200.000,-</span>
                        </div>
                        <button class="btn-sertifikat">
                            Sertifikat
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>