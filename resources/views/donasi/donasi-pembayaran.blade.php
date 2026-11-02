<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONASI</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/Donasi-bulanan.css', 'resources/js/Donasi/donasi.js']) 
    
</head>
<body>
      <div class="donasi">
        @include('components.menubar')
        <img src="/icons/Donasi-welpapaer.jpeg" alt="donasi" class="donasi-img">
    </div>
     <div class="card">
    <div class="card-header">LIHAT INFORMASI DONASI</div>
 
    <div class="card-body">
        {{-- Tab --}}
        <div class="tab-baris">
            <a href="{{ route('donasi') }}" class="btn-tab aktif">Donasi</a>
            <a href="#" class="btn-tab">Catatan</a>
        </div>
 
        {{-- Kotak metode pembayaran --}}
        <div class="card-pembayaran">
            <div class="card-pembayaran-header">Metode Pembayaran</div>
 
            <div class="metode-baris">
                {{-- BANK --}}
                <div class="metode-kartu metode-bank">
                    <div class="metode-judul">BANK</div>
                    <div class="metode-isi">
                        <div class="ikon-kartu" aria-hidden="true"></div>
                        <button type="button" class="btn-pilih">Pilih Bank</button>
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
 
            <button type="button" class="btn-lanjut">Lanjutkan Pembayaran</button>
        </div>
    </div>
</div>

      
</body>
</html>