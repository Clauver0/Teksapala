<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unduh Sertifikat</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Panggil Vite & CSS Navbar -->
    @vite(['public/css/menubar.css', 'resources/js/app.js'])
    @vite(['public/css/Navbar.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            min-height: 100vh;
        }
        .bg-card-header { background-color: #e3cfb4; }
        .bg-card-footer { background-color: #dbc3a4; }
        .text-card-dark { color: #4a3b2a; }
        .shadow-soft { box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</head>
<body class="flex">

    <!-- NAVBAR KIRI -->
    @include('components.menubar')

    <!-- KONTEN UTAMA (KANAN) -->
    <!-- ml-64 agar konten mulai setelah navbar -->
    <div class="ml-64 w-[calc(100%-16rem)] h-screen overflow-y-auto overflow-x-hidden">
        
        <!-- KUNCI PERUBAHAN: -->
        <!-- 1. flex, items-center, justify-center: Membuat isi di tengah -->
        <!-- 2. w-full max-w-6xl: Membatasi lebar maksimal agar rapi -->
        <!-- 3. mx-auto: Memberikan margin otomatis kiri-kanan -->
        <div class="flex flex-col items-center justify-center p-6 gap-6 w-full min-h-screen">
            
            <!-- Pembungkus Kartu -->
            <div class="w-full max-w-5xl flex flex-col gap-4">
                
                <!-- ================= KARTU DONASI 1 ================= -->
                <div class="bg-card-header rounded-xl overflow-hidden shadow-soft border border-gray-400/30 w-full flex flex-col">
                    
                    <div class="px-4 py-2 border-b border-gray-400/30">
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-extrabold uppercase tracking-wide text-card-dark">DONASI PADA</h2>
                            <span class="text-xs font-semibold text-gray-700">Penanaman Bibit Bakau di Pantai Cemara</span>
                        </div>
                    </div>
                    
                    <div class="relative w-full h-32 md:h-40">
                        <img src="https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2070&auto=format&fit=crop" alt="Hutan" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                        
                        <div class="absolute inset-0 px-4 py-3 flex flex-col justify-end text-white">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs md:text-sm font-medium">Peserta</span>
                                <span class="text-xl md:text-2xl font-extrabold leading-none">20</span>
                                <svg class="w-4 h-4 mb-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="flex items-end gap-2 mb-2">
                                <span class="text-xs md:text-sm font-medium">Total Donasi</span>
                                <span class="text-lg md:text-xl font-extrabold leading-none">Rp 700.000,00</span>
                            </div>
                            <a href="#" class="text-white font-semibold text-xs hover:underline w-max flex items-center gap-1">
                                <span>&gt;&gt;</span> Detail
                            </a>
                        </div>
                    </div>

                    <div class="bg-card-footer px-4 py-2 flex items-center justify-between border-t border-gray-400/30 w-full">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-extrabold uppercase text-card-dark">NILAI</span>
                            <span class="text-xs font-bold text-gray-800">RP 200.000,-</span>
                        </div>
                        <button class="bg-white text-gray-500 font-bold text-sm py-1 px-8 rounded-full shadow-sm hover:bg-gray-100 transition-colors">
                            Sertifikat
                        </button>
                    </div>
                </div>

                <!-- ================= KARTU DONASI 2 ================= -->
                <div class="bg-card-header rounded-xl overflow-hidden shadow-soft border border-gray-400/30 w-full flex flex-col">
                    
                    <div class="px-4 py-2 border-b border-gray-400/30">
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-extrabold uppercase tracking-wide text-card-dark">DONASI PADA</h2>
                            <span class="text-xs font-semibold text-gray-700">Penanaman Bibit Pinus di Bantul</span>
                        </div>
                    </div>
                    
                    <div class="relative w-full h-32 md:h-40">
                        <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?q=80&w=2070&auto=format&fit=crop" alt="Hutan Pinus" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                        
                        <div class="absolute inset-0 px-4 py-3 flex flex-col justify-end text-white">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs md:text-sm font-medium">Peserta</span>
                                <span class="text-xl md:text-2xl font-extrabold leading-none">20</span>
                                <svg class="w-4 h-4 mb-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="flex items-end gap-2 mb-2">
                                <span class="text-xs md:text-sm font-medium">Total Donasi</span>
                                <span class="text-lg md:text-xl font-extrabold leading-none">Rp 700.000,00</span>
                            </div>
                            <a href="#" class="text-white font-semibold text-xs hover:underline w-max flex items-center gap-1">
                                <span>&gt;&gt;</span> Detail
                            </a>
                        </div>
                    </div>

                    <div class="bg-card-footer px-4 py-2 flex items-center justify-between border-t border-gray-400/30 w-full">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-extrabold uppercase text-card-dark">NILAI</span>
                            <span class="text-xs font-bold text-gray-800">RP 200.000,-</span>
                        </div>
                        <button class="bg-white text-gray-500 font-bold text-sm py-1 px-8 rounded-full shadow-sm hover:bg-gray-100 transition-colors">
                            Sertifikat
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>