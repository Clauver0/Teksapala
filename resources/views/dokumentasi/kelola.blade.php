<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Dokumentasi - Teksapala</title>
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
        <a class="dok-back" href="{{ route('dokumentasi.index') }}" aria-label="Kembali ke Beranda Dokumentasi">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1>Kelola Dokumentasi</h1>
    </header>

    <div class="dok-panel-body">
        @if (session('sukses'))
            <div class="alert alert-success">{{ session('sukses') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @forelse ($jadwals as $jadwal)
            <article class="dok-card"
                @if ($jadwal->gambar_url)
                    style="background-image: url('{{ $jadwal->gambar_url }}');"
                @endif>
                <div class="dok-card-overlay">
                    <h2 class="dok-card-title">{{ $jadwal->judul }}</h2>
                    <p class="dok-card-status">
                        Status: <strong>{{ $jadwal->status_pelaksanaan ?? '-' }}</strong> |
                        Tanggal: {{ $jadwal->tanggal_pelaksanaan?->translatedFormat('d F Y') ?? '-' }}
                    </p>

                    @if ($jadwal->dokumentasi)
                        <div class="dok-card-info">
                            <p class="dok-info-title">
                                {{ $jadwal->dokumentasi->judul_dokumentasi }}
                            </p>
                        </div>

                        <div class="dok-card-actions">
                            <a href="{{ route('dokumentasi.show', $jadwal->id_jadwal) }}" class="btn-action btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('komunitas.dokumentasi.edit', $jadwal->dokumentasi) }}" class="btn-action btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('komunitas.dokumentasi.destroy', $jadwal->dokumentasi) }}"
                                method="POST"
                                class="js-delete-form"
                                data-dok-judul="{{ $jadwal->dokumentasi->judul_dokumentasi }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Hapus</button>
                            </form>
                        </div>
                    @elseif ($jadwal->sudahTerlaksana())
                        <div class="dok-card-actions">
                            <a href="{{ route('komunitas.dokumentasi.create', $jadwal->id_jadwal) }}" class="btn-action btn-create">
                                + Buat Dokumentasi
                            </a>
                        </div>
                    @else
                        <p class="dok-muted">
                            Dokumentasi baru bisa dibuat setelah status kegiatan <strong>Selesai</strong>.
                        </p>
                    @endif
                </div>
            </article>
        @empty
            <p class="dok-empty">Belum ada kegiatan yang terdaftar.</p>
        @endforelse
    </div>
</main>
<div class="dok-modal-backdrop" id="deleteDokModal" role="dialog" aria-modal="true" aria-labelledby="deleteDokModalTitle" aria-hidden="true">
    <div class="dok-modal">
        <div class="dok-modal-header">
            <h2 class="dok-modal-title" id="deleteDokModalTitle">Konfirmasi Hapus</h2>
        </div>
        <div class="dok-modal-body">
            <p class="dok-modal-text" id="deleteDokModalText">
                Yakin ingin menghapus dokumentasi ini?
            </p>
        </div>
        <div class="dok-modal-footer">
            <button type="button" class="btn-modal-cancel" id="cancelDeleteDok">Batal</button>
            <button type="button" class="btn-action btn-delete" id="confirmDeleteDok">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
(() => {
    const modal = document.getElementById('deleteDokModal');
    const modalText = document.getElementById('deleteDokModalText');
    const cancelBtn = document.getElementById('cancelDeleteDok');
    const confirmBtn = document.getElementById('confirmDeleteDok');
    let targetForm = null;

    document.querySelectorAll('.js-delete-form').forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            targetForm = form;
            const judul = form.dataset.dokJudul;
            modalText.textContent = judul
                ? `Yakin ingin menghapus dokumentasi "${judul}"?`
                : 'Yakin ingin menghapus dokumentasi ini?';
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            confirmBtn.focus();
        });
    });

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        targetForm = null;
    }

    cancelBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });

    confirmBtn.addEventListener('click', () => {
        if (targetForm) {
            targetForm.submit();
        }
    });
})();
</script>
</body>
</html>