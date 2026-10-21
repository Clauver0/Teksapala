<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jurnal</title>
     
      @vite(['public/css/Navbar.css', 'resources/js/app.js'])
      @vite(['public/css/menubar.css', 'resources/js/app.js'])
      @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
     <div class="jurnal-hero">
          @include('components.menubar')
          <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
    </div>
        <div class="card card-resizable" id="jurnalCard">
            <div class="card-header">Input Jurnal <button type="button" class="btn-expand" id="btnExpand" title="Perbesar">⛶</button></div>
              <div class="card-body"> 
                  <form action="/jurnal" method="POST" enctype="multipart/form-data"> 
                    @csrf
                      <div class="card-Jurnal-input">
                        <div class="judul-jurnal">
                         <label for="judul">Judul Jurnal :</label>
                         <input type="text" id="judul" name="judul" class="form-control">
                        </div>
                        <div class="tanggal-jurnal">
                          <label for="tanggal">Tanggal Jurnal :</label>
                          <input type="date" id="tanggal" name="tanggal" class="form-control">
                        </div>
                        <div class="jenis-jurnal">
                          <label for="jenis">Jenis Tanaman:</label>
                          <input type="text" id="jenis" name="jenis" class="form-control">
                        </div>
                        <div class="deskripsi">
                          <label for="deskripsi">Deskripsi:</label>
                          <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="unggah-file">
                          <label for="file">Unggah File:</label>
                          <input type="file" id="file" name="file" class="form-control">
                        </div>
                      </div>        
                    <div class="aksi-jurnal">
                     <button type="button" class="btn batal-jurnal"onclick="window.location.href='/jurnal'">Batal</button>
                     <button type="submit" class="btn simpan-jurnal">Simpan</button>
                    </div>   
                  </form> 
                </div>     
              </div>
        </div>
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
</body>
</html>