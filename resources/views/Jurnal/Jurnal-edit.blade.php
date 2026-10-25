<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurnal</title>
    @vite([
        'public/css/menubar.css',
        'public/css/Navbar.css',
        'resources/css/jurnal.css',
        'resources/js/jurnal.js'
    ])
</head>
<body>

    <div class="jurnal-hero">
        @include('components.menubar')
        <img src="/icons/jurnals-icon.jpeg" alt="Jurnal" class="jurnal-img">
    </div>

    <div class="card">
        <div class="card-header">Edit Jurnal</div>
        <div class="card-body">
            <div class="card-body-edit">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('jurnals.update', ['jurnal' => $jurnal->id_jurnal]) }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="judul_jurnal">Judul</label>
        <input type="text" id="judul_jurnal" name="judul_jurnal"
               value="{{ old('judul_jurnal', $jurnal->judul_jurnal) }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="jenis_tanaman">Jenis Tanaman</label>
        <input type="text" id="jenis_tanaman" name="jenis_tanaman"
               value="{{ old('jenis_tanaman', $jurnal->jenis_tanaman) }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control">{{ old('deskripsi', $jurnal->deskripsi) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="tanggal_jurnal">Tanggal</label>
        <input type="date" id="tanggal_jurnal" name="tanggal_jurnal"
               value="{{ old('tanggal_jurnal', $jurnal->tanggal_jurnal) }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
    <label>Gambar saat ini</label><br>
    @if ($jurnal->gambar)
        <img src="{{ asset('storage/' . $jurnal->gambar) }}" alt="Gambar jurnal" style="max-width:200px;">
    @endif
</div>

<div class="mb-3">
    <label for="gambar">Ganti gambar (kosongkan jika tidak diganti)</label>
    <input type="file" id="gambar" name="gambar" class="form-control">
</div>
</div>  
<div class="aksi-edit-jurnal">
      <button type="button" class="btn btn-edit"
            onclick="window.location.href='/kelola-jurnal'">Batal</button>
    <button type="submit" class="btn btn-edit">Simpan</button>
    
</div>
</form>


        </div>
    </div>

</body>
</html>