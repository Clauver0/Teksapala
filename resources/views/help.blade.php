<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan Untuk Pembayaran</title>
    
    <!-- Menggunakan Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Panggil Vite & CSS Navbar Anda -->
    @vite(['public/css/menubar.css', 'resources/js/app.js'])
    @vite(['public/css/Navbar.css', 'resources/js/app.js'])
    
    <style>
        /* Background Gambar Hutan */
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            min-height: 100vh;
        }

        /* Warna Custom */
        .bg-header-beige { background-color: #dfd1ba; }
        .bg-box-light { background-color: #f2f2f2; }
        .bg-title-olive { background-color: #54462c; }
        
        /* Efek Bayangan Tombol */
        .shadow-btn { box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.2); }
    </style>
</head>
<body class="flex flex-col">

    <!-- ================= NAVBAR ================= -->
    @include('components.menubar')

    <!-- ================= KONTEN UTAMA ================= -->
    <div class="flex-1 flex items-center justify-center p-4 md:p-8 pt-32 pb-12 w-full">
        
        <div class="w-full max-w-[900px] bg-white/85 backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden border border-gray-300">
            
            <div class="bg-header-beige py-6 text-center border-b border-gray-400">
                <h1 class="text-2xl md:text-3xl font-bold text-black tracking-wide uppercase">Bantuan Untuk Pembayaran</h1>
            </div>

            <div class="p-6 md:p-10">
                
                <!-- Kotak Konten Pembayaran -->
                <div class="bg-box-light border-2 border-gray-400 rounded-xl overflow-hidden shadow-lg relative">
                    
                    <!-- Judul Konten -->
                    <div class="bg-title-olive text-white text-center py-3">
                        <h2 class="text-xl md:text-2xl font-bold">Cara Melakukan Pembayaran</h2>
                    </div>

                    <!-- Isi Konten (2 Kolom) -->
                    <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-6 text-sm text-gray-800 leading-relaxed relative">
                        
                        <!-- Garis Pembatas Tengah -->
                        <div class="hidden md:block absolute border-l-2 border-gray-300 h-[60%] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

                        <!-- Kolom Kiri (Bank) -->
                        <div class="pr-0 md:pr-6">
                            <h3 class="text-center font-bold text-black mb-4">Bank</h3>
                            <ul class="list-disc pl-5 space-y-3">
                                <li>Buka aplikasi bank BRI / Mandiri &rarr; pilih Transfer &rarr; pilih Bank BRI / Mandiri &rarr; masukan No Rek BRI 9876543210 / Mandiri 400012345678 &rarr; Transfer.</li>
                                <li>Buka aplikasi Bri &rarr; pilih BRIVA &rarr; masukan No 123456789012345 &rarr; pilih bank BRI &rarr; masukan Nominal &rarr; Transfer</li>
                                <li>Buka aplikasi Mandiri &rarr; pilih LIVIN BY MANDIRI &rarr; masukan No 8808123456789012 &rarr; pilih bank Mandiri &rarr; masukan Nominal &rarr; Transfer</li>
                            </ul>
                        </div>

                        <!-- Kolom Kanan (Qiris) -->
                        <div class="pl-0 md:pl-6 pt-4 md:pt-0">
                            <h3 class="text-center font-bold text-black mb-4">Qiris</h3>
                            <p class="text-center md:text-left">
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