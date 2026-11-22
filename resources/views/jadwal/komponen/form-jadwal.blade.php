{{--
    Formulir tambah/edit jadwal (gaya: public/css/form-jadwal.css).
    Tambah: @include('jadwal.komponen.form-jadwal')
    Edit:   @include('jadwal.komponen.form-jadwal', ['jadwal' => $jadwal])
--}}
@php
    $sedangEdit = isset($jadwal);
    $namaFile = $sedangEdit && $jadwal->gambar ? basename($jadwal->gambar) : '-';
@endphp

<form method="POST"
      action="{{ $sedangEdit ? route('jadwal.update', $jadwal) : route('jadwal.store') }}"
      enctype="multipart/form-data"
      class="form-jadwal">
    @csrf
    @if ($sedangEdit)
        @method('PUT')
    @endif

    <header class="form-kepala">
        <h1 class="form-judul-halaman">{{ $sedangEdit ? 'Sunting' : 'Tambah jadwal' }}</h1>
        <button type="submit" class="tombol-simpan">Simpan</button>
    </header>

    <div class="kolom-form kolom-judul">
        <label for="judul">Judul</label>
        <div class="panel-input">
            <input type="text" id="judul" name="judul" maxlength="150"
                   value="{{ old('judul', $jadwal->judul ?? '') }}"
                   placeholder="Masukkan judul kegiatan" required>
        </div>
        @error('judul') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form kolom-tanggal">
        <label for="tanggal-pelaksanaan">Tanggal pelaksanaan</label>
        <div class="panel-input panel-input--ikon panel-input--tanggal">
            <input type="date" id="tanggal-pelaksanaan" name="tanggal_pelaksanaan"
                   value="{{ old('tanggal_pelaksanaan', isset($jadwal) ? $jadwal->tanggal_pelaksanaan?->format('Y-m-d') : '') }}"
                   required>
        </div>
        @error('tanggal_pelaksanaan') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form kolom-sampul">
        <label for="gambar">Upload sampul</label>
        <div class="panel-input panel-unggah">
            <span class="ikon-unggah" aria-hidden="true"></span>

            <div class="area-unggah">
                {{-- Input file dibuat transparan di atas area ini; nama file dibaca lewat onchange --}}
                <input type="file" id="gambar" name="gambar" accept="image/*"
                       data-awal="{{ $namaFile }}"
                       onchange="this.closest('.panel-unggah').querySelector('.nama-file').textContent = 'file unggah : ' + (this.files[0] ? this.files[0].name : this.dataset.awal)"
                       {{ $sedangEdit ? '' : 'required' }}>
                <span class="teks-unggah">Unggah atau Seret dan Lepas file</span>
            </div>

            <small class="nama-file">file unggah : {{ $namaFile }}</small>
        </div>
        @error('gambar') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form kolom-lokasi">
        <label for="lokasi-pelaksanaan">Lokasi pelaksanaan</label>
        <div class="panel-input panel-input--ikon panel-input--lokasi">
            <input type="text" id="lokasi-pelaksanaan" name="lokasi_pelaksanaan" maxlength="100"
                   value="{{ old('lokasi_pelaksanaan', $jadwal->lokasi_pelaksanaan ?? '') }}"
                   placeholder="Masukkan lokasi kegiatan" required>
        </div>
        @error('lokasi_pelaksanaan') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="pembatas-form" aria-hidden="true"></div>

    <div class="kolom-form kolom-deskripsi">
        <label for="deskripsi">Deskripsi</label>
        <div class="panel-input">
            <textarea id="deskripsi" name="deskripsi" rows="5" maxlength="255"
                      placeholder="Masukkan deskripsi kegiatan (maks. 255 karakter)" required>{{ old('deskripsi', $jadwal->deskripsi ?? '') }}</textarea>
        </div>
        @error('deskripsi') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>
</form>
