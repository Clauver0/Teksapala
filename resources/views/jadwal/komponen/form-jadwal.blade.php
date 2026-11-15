{{--
    Formulir tambah/edit jadwal.
    Tambah: @include('jadwal.komponen.form-jadwal')
    Edit:   @include('jadwal.komponen.form-jadwal', ['jadwal' => $jadwal])
--}}
@php($sedangEdit = isset($jadwal))

<form method="POST"
      action="{{ $sedangEdit ? route('jadwal.update', $jadwal) : route('jadwal.store') }}"
      enctype="multipart/form-data"
      class="form-jadwal">
    @csrf
    @if ($sedangEdit)
        @method('PUT')
    @endif

    <div class="kolom-form">
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" maxlength="150"
               value="{{ old('judul', $jadwal->judul ?? '') }}"
               placeholder="Masukkan judul kegiatan" required>
        @error('judul') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form">
        <label for="lokasi-pelaksanaan">Lokasi pelaksanaan</label>
        <input type="text" id="lokasi-pelaksanaan" name="lokasi_pelaksanaan" maxlength="100"
               value="{{ old('lokasi_pelaksanaan', $jadwal->lokasi_pelaksanaan ?? '') }}"
               placeholder="Masukkan lokasi kegiatan" required>
        @error('lokasi_pelaksanaan') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" maxlength="255"
                  placeholder="Masukkan deskripsi kegiatan (maks. 255 karakter)" required>{{ old('deskripsi', $jadwal->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form">
        <label for="tanggal-pelaksanaan">Tanggal pelaksanaan</label>
        <input type="date" id="tanggal-pelaksanaan" name="tanggal_pelaksanaan"
               value="{{ old('tanggal_pelaksanaan', isset($jadwal) ? $jadwal->tanggal_pelaksanaan?->format('Y-m-d') : '') }}"
               required>
        @error('tanggal_pelaksanaan') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <div class="kolom-form">
        <label for="gambar">Upload sampul</label>
        <div class="kontainer-input-upload">
            <input type="file" id="gambar" name="gambar" accept="image/*" {{ $sedangEdit ? '' : 'required' }}>
        </div>
        @error('gambar') <small class="pesan-error">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="tombol-simpan">
        {{ $sedangEdit ? 'Simpan perubahan' : 'Tambahkan jadwal' }}
    </button>
</form>
