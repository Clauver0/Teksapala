<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONASI</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/Donasi-bulanan.css', 'resources/js/Donasi/donasi.js'])
   <link rel="stylesheet" href="{{ asset('css/kirim-bukti-donasi.css') }}">

</head>
<body>
    <div class="donasi">
        @include('components.menubar')
        <img src="/icons/Donasi-welpapaer.jpeg" alt="donasi" class="donasi-img">
    </div>

    <div class="card" id="main-panel">
        <div class="card-header">LIHAT INFORMASI DONASI</div>

        <div class="card-body">
             <button type="button" class="btn btn-donasi"
            onclick="window.location.href='/donasi'">Donasi</button>
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
                             <button type="button" class="btn-pilih" onclick="bukaQris()">QRIS</button>
                            
                        </div>
                    </div>
                </div>
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
                    <button type="button" class="bank-kembali" id="lanjutBank">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL QRIS --}}
    <div class="qris-overlay" id="modalQRIS">
        <div class="qris-card">
            <div class="qris-header">Pembayaran dengan QRIS</div>
            
            <div class="qris-body">
                <img src="{{ asset('images/qris.png') }}" alt="Kode QRIS" class="gambar-qris-modal">

                <div class="qris-actions">
                    <button type="button" class="qris-kembali" id="lanjutQris">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>


   
    {{-- MODAL BUKTI PEMBAYARAN --}}
    <div id="modal-overlay" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-box">

                <div class="modal-header">
                    <h3>Kirim Bukti Pembayaran</h3>
                    <button type="button" onclick="closeModal()" class="btn-close">&times;</button>
                </div>

              <div class="modal-body">
    <form id="form-bukti" action="{{ route('kirim-bukti.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="file-upload" class="upload-area">
            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p id="upload-text">UNGGAH BUKTI DONASI ANDA DISINI</p>
            <span>(Format: JPG, PNG. Maks: 20MB)</span>
            <input id="file-upload" name="bukti_transfer" type="file" style="display:none;" accept=".jpg,.jpeg,.png" />
        </label>

        <div class="modal-footer">
            <div class="timer-box">
                <p class="timer-label">Bayar Sebelum:</p>
                <p id="countdown-timer" class="timer-value">23:59:53</p>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-submit">Kirim</button>
            </div>
                           </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
@php
        $popupPesan = session('success') ?? session('error') ?? ($errors->any() ? $errors->first() : null);
        $popupSukses = session('success') ? true : false;
    @endphp

    @if ($popupPesan)
        <div class="popup-overlay" id="popupNotif">
            <div class="popup-box">
                <div class="popup-icon {{ $popupSukses ? 'sukses' : 'gagal' }}">
                    {{ $popupSukses ? '✓' : '!' }}
                </div>
                <p>{{ $popupPesan }}</p>
                <button type="button" onclick="document.getElementById('popupNotif').remove()">OK</button>
            </div>
        </div>
    @endif
    @php
        $popupBatal = session('batal') ?? session('error') ?? ($errors->any() ? $errors->first() : null);
        $popupSukses = session('batal') ? true : false;
    @endphp

    @if ($popupBatal)
        <div class="popup-overlay" id="popupNotif">
            <div class="popup-box">
                <div class="popup-icon {{ $popupSukses ? 'sukses' : 'gagal' }}">
                    {{ $popupSukses ? '✓' : '!' }}
                </div>
                <p>{{ $popupBatal }}</p>
                <button type="button" onclick="document.getElementById('popupNotif').remove()">OK</button>
            </div>
        </div>
    @endif
</body>
</html>