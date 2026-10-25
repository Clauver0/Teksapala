<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Informasi Donasi</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Memanggil Vite & CSS Navbar Anda -->
    @vite(['public/css/menubar.css', 'resources/js/app.js'])
    @vite(['public/css/Navbar.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
        }

        /* Custom Warna */
        .bg-header-dark { background-color: #5c4a32; }
        .bg-header-brown { background-color: #6b4c2a; }
        .bg-modal-content { background-color: #ffffff; }
        .bg-upload-box { background-color: #cccccc; }
        .bg-main-panel { background-color: rgba(200, 200, 200, 0.7); } 

        /* Animasi Pop-up Modal */
        @keyframes popUp {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-popup { animation: popUp 0.3s ease-out forwards; }
    </style>
</head>
<body class="flex flex-col">

    <!-- ================= NAVBAR ANDA ================= -->
    @include('components.menubar')

    <!-- ================= KONTEN UTAMA ================= -->
    <div class="flex-1 relative flex items-center justify-center p-4 md:p-8 pt-24 pb-12">
        
        <!-- Background Overlay Gelap tipis (Default Halaman) -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Kotak Utama (LIHAT INFORMASI DONASI) -->
        <div class="relative w-full max-w-5xl bg-main-panel rounded-xl shadow-2xl overflow-hidden border-2 border-[#5c4a32] z-10 p-2 transition-all duration-300" id="main-panel">
            
            <div class="bg-header-dark py-3 text-center rounded-t-lg mb-4">
                <h2 class="text-white text-xl font-bold tracking-wide">LIHAT INFORMASI DONASI</h2>
            </div>

            <div class="px-6 pb-6 relative">
                
                <!-- Tab -->
                <div class="flex justify-center gap-10 mb-8">
                    <button class="bg-white border-2 border-gray-400 text-gray-800 font-bold py-1.5 px-16 rounded-md shadow-sm">Donasi</button>
                    <button class="bg-gray-300 border-2 border-gray-400 text-gray-800 font-bold py-1.5 px-16 rounded-md shadow-inner">Catatan</button>
                </div>

                <!-- Tombol Pemicu Pop-up -->
                <div class="text-center mt-6">
                    <button onclick="openModal()" class="bg-[#3b3ef5] hover:bg-blue-700 text-white font-semibold py-3 px-12 rounded-lg shadow-lg transition text-lg">
                        Lanjutkan Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= POP-UP MODAL (Tersembunyi) ================= -->
    <div id="modal-overlay" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        
        <!-- KUNCI PERUBAHAN: Menambahkan pl-64 (padding-left) agar modal bergeser ke kanan secara visual -->
        <div class="w-full h-full flex items-center justify-center pl-64">
            
            <!-- Kotak Modal -->
            <div class="relative bg-white border-2 border-[#5c4a32] rounded-lg overflow-hidden shadow-2xl mx-auto w-full max-w-3xl animate-popup">
                
                <!-- Header Modal -->
                <div class="bg-header-brown py-2 text-center relative">
                    <h3 class="text-white text-lg font-bold">Kirim Bukti Pembayaran</h3>
                    <!-- Tombol Close (X) -->
                    <button onclick="closeModal()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white hover:text-red-300 text-xl font-bold">&times;</button>
                </div>

                <!-- Body Modal -->
                <div class="bg-modal-content p-6">
                    <form action="{{ route('kirim-bukti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Area Upload -->
                        <label for="file-upload" class="flex flex-col items-center justify-center w-full max-w-xl mx-auto h-48 bg-upload-box rounded-xl cursor-pointer hover:bg-gray-400 transition-colors mb-6 border-2 border-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-20 h-20 text-gray-800 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-sm font-bold text-gray-800">UNGGAH BUKTI DONASI ANDA DISINI</p>
                                <p class="text-xs text-gray-600">(Format: JPG, PNG. Maks: 20MB)</p>
                            </div>
                            <input id="file-upload" name="bukti_transfer" type="file" class="hidden" accept=".jpg, .jpeg, .png" required />
                        </label>

                        <!-- Footer Modal (Timer & Tombol) -->
                        <div class="flex items-end justify-between mt-6 max-w-xl mx-auto">
                            <!-- Timer dengan ID untuk JavaScript -->
                            <div>
                                <p class="text-sm font-bold text-red-600">Bayar Sebelum:</p>
                                <p id="countdown-timer" class="text-3xl font-extrabold text-black tracking-wider">23:59:53</p>
                            </div>

                            <div class="flex gap-4">
                                <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-10 rounded shadow-md transition">
                                    Batal
                                </button>
                                <button type="submit" class="bg-[#3b3ef5] hover:bg-blue-700 text-white font-semibold py-2 px-10 rounded shadow-md transition">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= SCRIPT ================= -->
    <script>
        const modalOverlay = document.getElementById('modal-overlay');
        const mainPanel = document.getElementById('main-panel');

        function openModal() {
            modalOverlay.classList.remove('hidden');
            mainPanel.classList.add('blur-sm', 'opacity-50'); 
        }

        function closeModal() {
            modalOverlay.classList.add('hidden');
            mainPanel.classList.remove('blur-sm', 'opacity-50');
        }

        // Timer Mundur
        let hours = 23;
        let minutes = 59;
        let seconds = 53;

        function updateTimer() {
            if (seconds > 0) {
                seconds--;
            } else {
                if (minutes > 0) {
                    minutes--;
                    seconds = 59;
                } else {
                    if (hours > 0) {
                        hours--;
                        minutes = 59;
                        seconds = 59;
                    } else {
                        clearInterval(timerInterval);
                        document.getElementById('countdown-timer').textContent = "Waktu Habis";
                        document.getElementById('countdown-timer').classList.add('text-red-600');
                        return;
                    }
                }
            }

            const formatHours = String(hours).padStart(2, '0');
            const formatMinutes = String(minutes).padStart(2, '0');
            const formatSeconds = String(seconds).padStart(2, '0');

            document.getElementById('countdown-timer').textContent = `${formatHours}:${formatMinutes}:${formatSeconds}`;
        }

        const timerInterval = setInterval(updateTimer, 1000);
    </script>

</body>
</html>