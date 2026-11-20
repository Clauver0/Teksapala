<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jurnal</title>
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
      @vite(['resources/css/jurnal.css', 'resources/js/app.js']) 
</head>
<body>
     <div class="jurnal-hero">
          @include('components.menubar')
        <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
      </div>
         <div  class="card">
          <div class="card-header">Kelola Jurnal</div> 
            <div class="card-body-kelola"> 
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
                              <form action="{{ route('jurnals.destroy', $jurnal->id_jurnal) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus jurnal ini?')">
                                @csrf
                                @method('DELETE')
                                <a href="#" onclick="this.closest('form').submit()" class="link">Hapus</a>
                              </form>
                          </div>
                    </div>
                  @empty
                     <p class="kosong">{{ $Pesan ?? 'Belum ada jurnal.' }}</p>
                  @endforelse
                </div>     
             </div>

</body>

</html>