    <div class="jadwal-container">
        <div class="image-container">
            <img src="{{ $jadwal ? $jadwal->gambar : 'Gambar tidak tersedia' }}" alt="gambar tidak tersedia">
        </div>
        <div class="information">
            <label for="deskripsi">
                {{ $jadwal ? $jadwal->deskripsi : 'Deskripsi tidak tersedia'}}
            </label>
            <label for="status-pelaksanaan">status: {{ $jadwal ? $jadwal->status_pelaksanaan : 'tidak diketahui'}}</label>
            <label for="tanggal_pelaksanaan">tanggal pelaksanaan: {{$jadwal ? $jadwal->tanggal_pelaksanaan : 'tanggal tidak tersedia'}}</label>
        </div>
    </div>