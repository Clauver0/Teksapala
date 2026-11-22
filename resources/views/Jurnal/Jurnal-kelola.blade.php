<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jurnal</title>
  <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    @vite(['resources/css/jurnal.css', 'resources/js/app.js', 'resources/js/Jurnal/Jurnal.js'])
      
</head>
<body>
     <div class="jurnal-hero">
          @include('components.menubar')
        <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
      </div>
         <div  class="card">
          <div class="card-header">Kelola Jurnal</div> 
             <div class="card-body-kelola"> 
                @if(session('success'))
                  <div class="alert-success" style="width: 100%; margin-bottom: 20px;">
                    {{ session('success') }}
                  </div>
                @endif
               <div class="card-Jurnal-Kelola">
                {{-- Pencarian --}}
                <form action="/kelola-jurnal" method="GET" class="form-cari">
                    <input type="text" name="cari" placeholder="Cari Jurnal"
                           value="{{ request('cari') }}" class="input-cari">
                </form>
                {{-- Daftar data dari database --}}
                <div class="daftar-jurnal">
                   @forelse ($data1 as $jurnal)
                    <div class="item-jurnal">
                        <span>{{ $jurnal->judul_jurnal }}</span>
                          <div class="aksi">
                            <a href="{{ route('jurnals.edit', $jurnal->id_jurnal) }}" class="link">Edit</a>
                              <form action="{{ route('jurnals.destroy', $jurnal->id_jurnal) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <a href="#" class="link btn-hapus" data-judul="{{ $jurnal->judul_jurnal }}">Hapus</a>
</form>
                          </div>
                    </div>    
                  @empty
                     <p class="kosong">{{ $Pesan ?? 'Belum ada jurnal.' }}</p>
                  @endforelse
                </div> 
               </div>
             </div>
             <div class="card-footer-kelola">
                  <button type="button" class="btn kembali-jurnal"onclick="window.location.href='/jurnal'">Kembali</button>
              </div>    
         </div>
           <div id="modalHapus" class="modal-overlay">
        <div class="modal-box">
            <h3>Konfirmasi Hapus</h3>
            <p id="modalPesan"></p>
            <div class="modal-aksi">
                <button type="button" id="btnBatalHapus" class="btn">Batal</button>
                <button type="button" id="btnYaHapus" class="btn modal-ya">Ya, Hapus</button>
            </div>
        </div>
    </div>
<script src="{{ asset('js/Jurnal.js') }}"></script>
</body>

</html>