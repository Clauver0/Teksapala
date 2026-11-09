<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan Untuk Pembayaran</title>
    
    <!-- 1. Panggil Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- 2. Panggil CSS Navbar (Pastikan ada di folder public/css/) -->
    <link rel="stylesheet" href="{{ asset('css/menubar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    
    <!-- 3. Panggil CSS Murni Halaman Ini -->
    <link rel="stylesheet" href="{{ asset('css/help.css') }}">
</head>
<body>

    <!-- ================= NAVBAR ================= -->
    @include('components.menubar')

    <!-- ================= KONTEN UTAMA ================= -->
    <div class="main-container">
        
        <div class="content-wrapper">
            
            <!-- Header Atas -->
            <div class="content-header">
                <h1>BANTUAN UNTUK PEMBAYARAN</h1>
            </div>

            <!-- Area Konten -->
            <div class="content-body">
                
                <!-- Tombol Tab (Hanya Donasi) -->
                <div class="tab-container" style="justify-content: center;">
                    <button class="btn-tab active" style="width: 250px;">Donasi</button>
                </div>

                <!-- Kotak Pembayaran -->
                <div class="payment-box">
                    
                    <div class="payment-title">
                        <h2>Cara Melakukan Pembayaran</h2>
                    </div>

                    <div class="payment-content">
                        
                        <!-- Garis Pembatas Tengah -->
                        <div class="divider-line"></div>

                        <!-- Kolom Kiri (Bank) -->
                        <div class="col-left">
                            <h3 class="col-title">Bank</h3>
                            <ul>
                                <li>Buka aplikasi bank BRI / Mandiri &rarr; pilih Transfer &rarr; pilih Bank BRI / Mandiri &rarr; masukan No Rek BRI 9876543210 / Mandiri 400012345678 &rarr; Transfer.</li>
                                <li>Buka aplikasi Bri &rarr; pilih BRIVA &rarr; masukan No 123456789012345 &rarr; pilih bank BRI &rarr; masukan Nominal &rarr; Transfer</li>
                                <li>Buka aplikasi Mandiri &rarr; pilih LIVIN BY MANDIRI &rarr; masukan No 8808123456789012 &rarr; pilih bank Mandiri &rarr; masukan Nominal &rarr; Transfer</li>
                            </ul>
                        </div>

                        <!-- Kolom Kanan (Qiris) -->
                        <div class="col-right">
                            <h3 class="col-title">Qiris</h3>
                            <p>
                                Buka aplikasi Bank &rarr; pilih metode QRIS &rarr; sken barkode Qris yang sudah di sediakan &rarr; masukan nominal &rarr; Transfer.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>