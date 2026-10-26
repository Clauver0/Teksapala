    <div class="doc-container">
        <h1 class="doc-item">{{ $dokumentasi ? $dokumentasi->deskripsi : 'judul tidak tersedia' }}</h1>
        <table class="doc-item">
            <tr>
                <td><p>Peserta:  </p></td>
                <td><p class="value">{{ $dokumentasi ? $dokumentasi->peserta : 'peserta tidak tersedia' }}</p></td>
                <td><img src="/icons/peserta-icon.png" alt="Ikon perserta"></td>
            </tr>
            <tr>
                <td><p>Tertanam</p></td>
                <td><p class="value">{{ number_format($dokumentasi->jadwal ? $dokumentasi->jadwal->jadwalTanaman->sum('terdonasi') : 0, 0, ',', '.') }}</p></td>
                <td><img src="/icons/tertanam-icon.png" alt="Ikon Tertanam"></td>
            </tr>
        </table>
        <a href="#" class="doc-item">>> Detail</a>
    </div>