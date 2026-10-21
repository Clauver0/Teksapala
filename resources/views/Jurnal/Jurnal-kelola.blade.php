<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jurnal</title>
      @vite(['public/css/menubar.css', 'resources/js/app.js'])
      @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
     <div class="jurnal-hero">
          @include('components.menubar')
        <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
      </div>
       <div  class="card">
         <div class="card-header">Kelola Jurnal</div> 
         <div class="card-body"> 
           <div class="card-input kelola-wrapper">
                {{-- Pencarian --}}
                <form action="/kelola-jurnal" method="GET" class="form-cari">
                    <input type="text" name="cari" placeholder="Cari Jurnal"
                           value="{{ request('cari') }}">
                </form>
                {{-- Daftar data dari database --}}
                <div class="daftar-jurnal">
                   @forelse ($data1 as $jurnal)
                    <div class="item-jurnal">
                          <span>{{ $jurnal->judul_jurnal }}</span>

                          <div class="aksi">
                          <a href="{{ route('jurnals.edit', $jurnal->id_jurnal) }}">Edit</a>

                     <form action="{{ route('jurnals.destroy', $jurnal->id_jurnal) }}" method="POST"
                     onsubmit="return confirm('Yakin hapus jurnal ini?')">
                    @csrf
                   @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
    </div>
@empty
    <p class="kosong">{{ $Pesan ?? 'Belum ada jurnal.' }}</p>
@endforelse
                </div>     
       </div>

    <div class="aksi-jurnal">
         <button type="button" class="btn batal-jurnal"onclick="window.location.href='/jurnal'">Batal</button>
        <button type="submit" class="btn simpan-jurnal">Simpan</button>
        </div>
    </div>
</body>
<script>
        const card = document.getElementById('jurnalCard');
        const btn = document.getElementById('btnExpand');

        btn.addEventListener('click', () => {
            card.classList.toggle('expanded');
            const isBig = card.classList.contains('expanded');
            btn.textContent = isBig ? '🗗' : '⛶';
            btn.title = isBig ? 'Perkecil' : 'Perbesar';
        });
    </script>
</html>