<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokumentasi - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
</head>
<body class="dok-layout dok-bg-photo"
      style="background-image: url('{{ asset('img/background-dokumentasi.png') }}');">

<div class="sidebar">
    @include('components.menubar')
</div>

<main class="dok-panel">
    <header class="dok-panel-header">
        <a class="dok-back" href="{{ route('komunitas.dokumentasi.index') }}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1>Edit Dokumentasi</h1>
    </header>

    <div class="dok-panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="dok-form-card">
            <p class="dok-form-jadwal">
                Jadwal: <strong>{{ $jadwal->judul }}</strong>
            </p>

            <form action="{{ route('komunitas.dokumentasi.update', $dokumentasi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="dok-form-group">
                    <label for="judul_dokumentasi">Judul Dokumentasi</label>
                    <input id="judul_dokumentasi" type="text" name="judul_dokumentasi"
                           value="{{ old('judul_dokumentasi', $dokumentasi->judul_dokumentasi) }}" maxlength="150" required>
                </div>

                <div class="dok-form-group">
                    <label for="link_gdrive">Link Google Drive</label>
                    <input id="link_gdrive" type="url" name="link_gdrive"
                           value="{{ old('link_gdrive', $dokumentasi->link_gdrive) }}" required>
                    <span class="dok-form-hint">Pastikan akses berbagi link Google Drive sudah dibuka agar bisa diakses public.</span>
                </div>

                <div class="dok-form-group">
                    <label for="deskripsi">Deskripsi (Opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
                </div>

                <div class="dok-form-actions">
                    <button type="submit">Perbarui Dokumentasi</button>
                    <a href="{{ route('komunitas.dokumentasi.index') }}" class="btn-form-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>