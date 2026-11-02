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
 
        {{-- Kotak donasi sukarela --}}
        <div class="card-sukarela">
            <div class="card-pembayaran-header">Donasi Sukarela</div>
 
            {{-- Ganti action="#" dengan route penyimpanan donasi kamu --}}
            <form action="#" method="POST">
                @csrf
 
                <div class="sukarela-isi">
                    <div class="sukarela-input">
                        <label for="nominal" class="sukarela-label">Masukkan Donasimu:</label>
                        <div class="input-rupiah">
                            <span class="rupiah-simbol">Rp</span>
                            <input type="text" id="nominal" name="nominal" value="20.000"
                                   inputmode="numeric" autocomplete="off">
                        </div>
                    </div>
 
                    <p class="sukarela-catatan">
                        <strong>Catatan</strong>: Seluruh donasi sukarela akan dialokasikan pada
                        kegiatan penanaman kami yang masih kekurangan pendanaan.
                    </p>
                </div>
 
                <button type="submit" class="btn-lanjut btn-lebar">Donasikan</button>
            </form>
        </div>
    </div>
</div>
 
<script>
    // Format angka otomatis: 20000 -> 20.000
    document.getElementById('nominal').addEventListener('input', function () {
        const angka = this.value.replace(/\D/g, '');
        this.value = angka ? Number(angka).toLocaleString('id-ID') : '';
    });
</script>
    
      
</body>
</html>