<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jurnal</title>
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
      @vite(['resources/css/jurnal.css', 'resources/js/app.js']) 
</head>
<body>
     <div class="jurnal-hero">
          @include('components.menubar')
          <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img"> 
    </div>
        <div class="card card-resizable" id="jurnalCard">
            <div class="card-header">Input Jurnal</div>
              <div class="card-body"> 
                  <form action="{{ route('jurnals.store') }}" method="POST" enctype="multipart/form-data">
                     @csrf

                     @if ($errors->any())
                         <div style="color:red;">
                           <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                      @endif
                      <div class="card-Jurnal-input">
                        <div class="judul-jurnal">
                         <label for="judul">Judul Jurnal :</label>
                         <input type="text" id="judul" name="judul_jurnal" class="form-control"
                          required 
                               oninvalid="this.setCustomValidity('Judul jurnal wajib diisi!')" 
                               oninput="this.setCustomValidity('')">
                        </div>
                        <div class="tanggal-jurnal">
                          <label for="tanggal">Tanggal Jurnal :</label>
                          <input type="date" id="tanggal" name="tanggal_jurnal" class="form-control"
                          required
                              title="Tanggal jurnal wajib dipilih!" 
                               oninvalid="this.setCustomValidity('Tanggal jurnal wajib dipilih!')" 
                               oninput="this.setCustomValidity('')">
                        </div>
                        <div class="jenis-jurnal">
                          <label for="jenis">Jenis Tanaman:</label>
                          <input type="text" id="jenis" name="jenis_tanaman" class="form-control"
                            required 
                               oninvalid="this.setCustomValidity('Jenis tanaman wajib diisi!')" 
                               oninput="this.setCustomValidity('')">
                        </div>
                        <div class="deskripsi">
                          <label for="deskripsi">Deskripsi:</label>
                          <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="unggah-file">
                          <label for="file">Unggah File:</label>
                          <input type="file" id="file" name="gambar" class="form-control">
                        </div>
                      </div>        
                    <div class="aksi-jurnal">
                     <button type="button" class="btn batal-jurnal"onclick="window.location.href='/jurnal'">Batal</button>
                     <button type="submit" class="btn simpan-jurnal">Simpan</button>
                    </div>   
                  </form> 
                </div>     
              </div>
</body>
</html>