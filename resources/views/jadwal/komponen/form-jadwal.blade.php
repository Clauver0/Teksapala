{{--
    Formulir tambah/edit jadwal (gaya: public/css/form-jadwal.css).
    Tambah: @include('jadwal.komponen.form-jadwal')
    Edit:   @include('jadwal.komponen.form-jadwal', ['jadwal' => $jadwal])
--}}
@php
    $sedangEdit = isset($jadwal);
    $namaFile = $sedangEdit && $jadwal->gambar ? basename($jadwal->gambar) : 'belum ada file';
    $kembali = $sedangEdit ? route('jadwal.show', $jadwal) : route('jadwal.index');
@endphp

<form method="POST"
      action="{{ $sedangEdit ? route('jadwal.update', $jadwal) : route('jadwal.store') }}"
      enctype="multipart/form-data"
      class="jadwal-form">
    @csrf
    @if ($sedangEdit)
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="jadwal-field">
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" maxlength="150"
               value="{{ old('judul', $jadwal->judul ?? '') }}"
               placeholder="Masukkan judul kegiatan" required>
        @error('judul') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="jadwal-field jadwal-field-baris">
        <div class="jadwal-field">
            <label for="tanggal-pelaksanaan">Tanggal pelaksanaan</label>
            <input type="date" id="tanggal-pelaksanaan" name="tanggal_pelaksanaan"
                   value="{{ old('tanggal_pelaksanaan', isset($jadwal) ? $jadwal->tanggal_pelaksanaan?->format('Y-m-d') : '') }}"
                   required>
            @error('tanggal_pelaksanaan') <small class="pesan-error">{{ $message }}</small> @enderror
        </div>

        <div class="jadwal-field">
            <label for="lokasi-pelaksanaan">Lokasi pelaksanaan</label>
            <input type="text" id="lokasi-pelaksanaan" name="lokasi_pelaksanaan" maxlength="100"
                   value="{{ old('lokasi_pelaksanaan', $jadwal->lokasi_pelaksanaan ?? '') }}"
                   placeholder="Masukkan lokasi kegiatan" required>
            @error('lokasi_pelaksanaan') <small class="pesan-error">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="jadwal-field">
        <label for="gambar">Sampul</label>
        <div class="jadwal-unggah">
            <input type="file" id="gambar" name="gambar" accept="image/*"
                   data-awal="{{ $namaFile }}"
                   onchange="this.closest('.jadwal-field').querySelector('.nama-file').textContent = this.files[0] ? this.files[0].name : this.dataset.awal"
                   {{ $sedangEdit ? '' : 'required' }}>
            <span class="jadwal-unggah-teks">Pilih atau seret gambar sampul</span>
        </div>
        <small class="jadwal-hint nama-file">{{ $namaFile }}</small>
        @error('gambar') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="jadwal-field">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" maxlength="255"
                  placeholder="Masukkan deskripsi kegiatan (maks. 255 karakter)" required>{{ old('deskripsi', $jadwal->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="jadwal-aksi">
        <button type="submit" class="jadwal-simpan">Simpan</button>
        <a href="{{ $kembali }}" class="jadwal-batal">Batal</a>
    </div>
</form>
