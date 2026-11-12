<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penanaman Bibit Bakau</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/halaman-jadwal.css') }}">
</head>
<body class="bg-light">

    <!-- Menubar Component -->
    @include('jadwal.components.header')

    <main class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8">
                
                <div class="detail-container shadow-sm p-4">
                    <!-- Banner Gambar -->
                    <div class="position-relative mb-4">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1000" class="detail-banner rounded" alt="Banner Detail">
                        
                        <!-- Option Menu (Titik 3) -->
                        <button class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 shadow-sm" style="width: 36px; height: 36px; padding: 0;">
                            ⋮
                        </button>

                        <!-- Popover Menu Sunting/Arsipkan (Opsional/Sembunyi secara default) -->
                        <div class="option-popover d-none">
                            <a href="#" class="option-item">Sunting</a>
                            <a href="#" class="option-item">Arsipkan</a>
                        </div>
                    </div>

                    <!-- Konten Deskripsi & Statistik -->
                    <div class="row">
                        <div class="col-md-7">
                            <h4 class="fw-bold mb-3">PENANAMAN BIBIT BAKAU DI PANTAI CEMARA</h4>
                            <p class="text-secondary style="text-align: justify; fs-6">
                                Kegiatan penanaman mangrove di Pantai Cemara dilaksanakan sebagai upaya untuk melindungi ekosistem pesisir dan mencegah abrasi pantai. Para sukarelawan, bersama dengan anggota masyarakat setempat, menanam ratusan bibit mangrove di sepanjang garis pantai. Mangrove memegang peranan penting dalam melindungi wilayah pesisir dari abrasi, menyediakan habitat bagi biota laut, serta menyerap karbon dari atmosfer.
                            </p>
                        </div>

                        <div class="col-md-5">
                            <h6 class="fw-bold mb-2">Statistik</h6>
                            
                            <!-- Box Dual Statistik -->
                            <div class="row g-0 mb-3 shadow-sm rounded">
                                <div class="col-7 stat-box-left">
                                    <div class="fw-bold fs-6">Total Donasi</div>
                                    <div class="fs-5 fw-bold mt-2">RP 400.000,-</div>
                                    <a href="#" class="btn-donasi">Donasi Sekarang</a>
                                </div>
                                <div class="col-5 stat-box-right text-center">
                                    <div class="fw-bold fs-6 mb-1">Partisipasi</div>
                                    <div class="display-5 fw-bold">20</div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <div class="small text-secondary fw-semibold">Diselenggarakan pada 13 Januari 2027</div>
                                <div class="status-badge sedang-berjalan fs-5 mt-1">SEDANG BERJALAN</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

</body>
</html>