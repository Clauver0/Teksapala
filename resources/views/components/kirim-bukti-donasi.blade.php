<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Informasi Donasi</title>
    
    <!-- 1. Panggil Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- 2. Panggil CSS Navbar -->
    <link rel="stylesheet" href="{{ asset('css/menubar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    
    <!-- 3. Panggil CSS Murni Halaman Ini -->
    <link rel="stylesheet" href="{{ asset('css/kirim-bukti-donasi.css') }}">
</head>
<body>

    <!-- ================= NAVBAR ================= -->
    @include('components.menubar')

    <!-- ================= KONTEN UTAMA ================= -->
    <div class="main-content">
        <div class="overlay-dark"></div>

        <!-- Kotak Panel -->
        <div class="main-panel" id="main-panel">
            
            <div class="header-title">
                <h2>LIHAT INFORMASI DONASI</h2>
            </div>

            <div class="panel-content">
                
                <!-- Tab (Hanya Donasi) -->
                <div class="tab-container" style="justify-content: center; width: 100%;">
                    <button class="btn-tab active" style="width: 100%; max-width: 300px;">Donasi</button>
                </div>

                <!-- Tombol Pemicu Pop-up -->
                <button onclick="openModal()" class="btn-primary">
                    Lanjutkan Pembayaran
                </button>
            </div>
        </div>
    </div>

    <!-- ================= POP-UP MODAL ================= -->
    <div id="modal-overlay" class="modal-overlay">
        
        <div class="modal-container">
            
            <div class="modal-box">
                
                <!-- Header Modal -->
                <div class="modal-header">
                    <h3>Kirim Bukti Pembayaran</h3>
                    <button onclick="closeModal()" class="btn-close">&times;</button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <form action="{{ route('kirim-bukti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Area Upload -->
                        <label for="file-upload" class="upload-area">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p>UNGGAH BUKTI DONASI ANDA DISINI</p>
                            <span>(Format: JPG, PNG. Maks: 20MB)</span>
                            <input id="file-upload" name="bukti_transfer" type="file" style="display: none;" accept=".jpg, .jpeg, .png" required />
                        </label>

                        <!-- Footer Modal -->
                        <div class="modal-footer">
                            <!-- Timer Box -->
                            <div class="timer-box">
                                <p class="timer-label">Bayar Sebelum:</p>
                                <p id="countdown-timer" class="timer-value">23:59:53</p>
                            </div>

                            <div class="btn-group">
                                <button type="button" onclick="closeModal()" class="btn-cancel">Batal</button>
                                <button type="submit" class="btn-submit">Kirim</button>
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
            modalOverlay.classList.add('active');
            mainPanel.classList.add('blur-effect'); 
        }

        function closeModal() {
            modalOverlay.classList.remove('active');
            mainPanel.classList.remove('blur-effect');
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
                        document.getElementById('countdown-timer').style.color = "#dc2626";
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