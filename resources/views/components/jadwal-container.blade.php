        <div class="doc-container" style="--bg-gambar: url('{{ asset($jadwal->gambar) }}');">
            <h1 class="doc-item">{{ $jadwal ? $jadwal->deskripsi : 'judul tidak tersedia' }}</h1>
    <!-- Baris img di bawah ini opsional, jika sudah jadi background-image biasanya img tag ini bisa dihapus -->
            <table>                
                <tr>
                    <td>
                        <label class="doc-item" for="status-pelaksanaan">status: {{ $jadwal ? $jadwal->status_pelaksanaan : 'tidak tersedia' }}</label>
                    </td>
                    <td>
                        <label class="doc-item" for="tanggal_pelaksanaan">tanggal pelaksanaan: {{ $jadwal ? $jadwal->tanggal_pelaksanaan : 'tidak tersedia' }}</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="doc-item">>>> Detail</a>
                    </td>
                </tr>
            </table>
        </div>