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
     <div  class="card">
      <div class="card-header">LIHAT INFORMASI DONASI</div> 
         <div class="card-body"> 
         
            <button type="button" class="btn btn-donasi"
            onclick="window.location.href='{{ route('donasi') }}'">Donasi</button>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
        
           <div class="card-input-donasi">
            <div class="card-input-donasi-header">
                 <img src="{{$jadwal->gambar}}" alt="{{ $jadwal->judul }}" class="donasi-input-header">
                <div class="header-teks">
                     <small>Donasikan Tanaman</small>
                     &nbsp;   
                     <h3>{{ strtoupper($jadwal->judul ?? 'Penanaman di ' . $jadwal->lokasi_pelaksanaan) }}</h3>
                </div>
            </div> 

           <div class="card-input-donasi-body">
                    <div class="daftar-tanaman">
                        @foreach ($tanaman as $t)
                            <div class="item-tanaman"
                                 data-id="{{ $t->id_jadwal_tanaman }}"
                                 data-harga="{{ $t->harga }}"
                                 data-sisa="{{ $t->kouta - $t->terdonasi }}">

                                <img src="{{ asset('icons/' . $t->gambar) }}" alt="{{ $t->nama_tanaman }}">
                                <p class="nama">{{ $t->nama_tanaman }}</p>

                                <div class="qty">
                                    <button type="button" class="qty-btn qty-min">-</button>
                                    <span class="qty-angka">0</span>
                                    <button type="button" class="qty-btn qty-plus">+</button>
                                </div>

                                <p class="harga">Rp {{ number_format($t->harga, 0, ',', '.') }},-</p>
                            </div>
                        @endforeach
                    </div>
                </div>
        <div class="card-total">
       <div class="total-donasi">
            <span>Total Donasi: </span>
            <span id="total-donasi-amount">Rp 0,-</span>
        </div> 
        
<form action="{{ route('donasi.pembayaran') }}"
      method="POST"
      id="form-donasi">

    @csrf

    <input type="hidden" name="items" id="items">

    <button type="submit" class="btn btn-donasi-bayar">
        Donasikan
    </button>
</form>

        </div>
    </div>

      
</body>
</html>