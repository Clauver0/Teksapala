<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONASI</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/Donasi-bulanan.css', 'resources/js/Donasi/donasi.js'])
    <!-- <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { corePlugins: { preflight: false } };</script>
    <style>
        .bg-header-brown { background-color: #6b4c2a; }
        .bg-modal-content { background-color: #ffffff; }
        .bg-upload-box { background-color: #cccccc; }
        @keyframes popUp {
            from { opacity: 0; transform: scale(0.9); }
            to   { opacity: 1; transform: scale(1); }
        }
        .animate-popup { animation: popUp 0.3s ease-out forwards; }
    </style> -->
</head>
<body>
    <div class="donasi">
        @include('components.menubar')
        <img src="/icons/Donasi-welpapaer.jpeg" alt="donasi" class="donasi-img">
    </div>

    <div class="card" id="main-panel">
        <div class="card-header">LIHAT INFORMASI DONASI</div>

        <div class="card-body">
            <button type="button" class="btn btn-donasi"onclick="window.location.href='/donasi'">Donasi</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            {{-- Kotak metode pembayaran --}}
            <div class="card-pembayaran">
                <div class="card-pembayaran-header">Metode Pembayaran</div>

                <div class="metode-baris">
                    {{-- BANK --}}
                    <div class="metode-kartu metode-bank">
                        <div class="metode-judul">BANK</div>
                        <div class="metode-isi">
                            <div class="ikon-kartu" aria-hidden="true"></div>
                            <button type="button" class="btn-pilih" onclick="bukaBank()">Pilih Bank</button>
                        </div>
                    </div>

                    {{-- QRIS --}}
                    <div class="metode-kartu metode-qris">
                        <div class="metode-judul">QRIS</div>
                        <div class="metode-isi">
                            <img src="{{ asset('images/qris.png') }}" alt="Kode QRIS" class="gambar-qris">
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-lanjut" onclick="openModal()">Lanjutkan Pembayaran</button>
            </div>
        </div>
    </div>

    {{-- MODAL BANK --}}
    <div class="bank-overlay" id="modalBank">
        <div class="bank-card">
            <div class="bank-header">Pembayaran dengan Bank</div>

            <div class="bank-body">
                @foreach ($banks as $namaBank => $rekening)
                    <div class="bank-group">
                        <h4>Nomor Rekening Virtual {{ $namaBank }}</h4>

                        @foreach ($rekening as $jenis => $nomor)
                            <div class="bank-row">
                                <span class="bank-jenis">{{ $jenis }}</span>
                                <span class="bank-nomor">: {{ $nomor }}</span>
                                <a href="#" class="bank-salin" data-nomor="{{ $nomor }}">Salin</a>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="bank-actions">
                    <button type="button" class="bank-kembali" id="tutupBank">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL BUKTI PEMBAYARAN --}}
    <div id="modal-overlay" class="fixed inset-0 z-[99999] hidden items-center justify-center bg-black/60 backdrop-blur-sm px-4">

        <div class="relative bg-white border-2 border-[#5c4a32] rounded-lg overflow-hidden shadow-2xl mx-auto w-full max-w-3xl animate-popup">

            <div class="bg-header-brown py-2 text-center relative">
                <h3 class="text-white text-lg font-bold">Kirim Bukti Pembayaran</h3>
                <button type="button" onclick="closeModal()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white hover:text-red-300 text-xl font-bold">&times;</button>
            </div>

            <div class="bg-modal-content p-6">
                <form action="{{ route('kirim-bukti.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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

                    <div class="flex items-end justify-between mt-6 max-w-xl mx-auto">
                        <div>
                            <p class="text-sm font-bold text-red-600">Bayar Sebelum:</p>
                            <p id="countdown-timer" class="text-3xl font-extrabold text-black tracking-wider">23:59:53</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script modal --}}
    <script>
        /* ===== MODAL BANK ===== */
        const modalBank = document.getElementById('modalBank');

        function bukaBank()  { modalBank.classList.add('show'); }
        function tutupBank() { modalBank.classList.remove('show'); }

        document.getElementById('tutupBank').addEventListener('click', function (e) {
            e.preventDefault();
            tutupBank();
        });

        modalBank.addEventListener('click', function (e) {
            if (e.target === modalBank) tutupBank();
        });

        document.querySelectorAll('.bank-salin').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                navigator.clipboard.writeText(el.dataset.nomor).then(function () {
                    const teks = el.textContent;
                    el.textContent = 'Tersalin!';
                    setTimeout(function () { el.textContent = teks; }, 1500);
                });
            });
        });

    //     /* ===== MODAL BUKTI ===== */
    //     const overlayBukti = document.getElementById('modal-overlay');
    //     const panelUtama = document.getElementById('main-panel');

    //     function openModal() {
    //         overlayBukti.classList.remove('hidden');
    //         overlayBukti.classList.add('flex');
    //         panelUtama.classList.add('blur-sm', 'opacity-50');
    //     }
    //     function closeModal() {
    //         overlayBukti. classList.add('hidden');
    //         overlayBukti.classList.remove('flex');
    //         panelUtama.classList.remove('blur-sm', 'opacity-50');
    //     }

    //     // timer mundur
    //     let jam = 23, menit = 59, detik = 53;
    //     const elTimer = document.getElementById('countdown-timer');
    //     const timerBukti = setInterval(function () {
    //         if (detik > 0) { detik--; }
    //         else if (menit > 0) { menit--; detik = 59; }
    //         else if (jam > 0) { jam--; menit = 59; detik = 59; }
    //         else { clearInterval(timerBukti); elTimer.textContent = 'Waktu Habis'; return; }

    //         elTimer.textContent =
    //             String(jam).padStart(2, '0') + ':' +
    //             String(menit).padStart(2, '0') + ':' +
    //             String(detik).padStart(2, '0');
    //     }, 1000);
    // </script>

    // @if (session('success'))
    //     <script>alert(@json(session('success')));</script>
    // @endif
    // @if ($errors->any())
    //     <script>alert(@json($errors->first()));</script>
    // @endif
</body>
</html>