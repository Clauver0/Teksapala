<form action="{{ route('jadwal.store') }}" method="POST">
    @csrf
    
    <label for="deskripsi">Deskripsi: </label><br>
    <input type="text" id="deskripsi" name="deskripsi"><br>

    <label for="status_pelaksanaan">Status Pelaksanaan</label><br>
    <select name="status_pelaksanaan" id="status_pelaksanaan">
        <option value="" disabled selected>-- Pilih salah satu --</option>
        <option value="terjadwal">Terjadwal</option>
        <option value="berlangsung">Berlangsung</option>
        <option value="selesai">Selesai</option>
    </select><br>

    <label for="lokasi_pelaksanaan">Lokasi Penanaman: </label><br>
    <input type="text" id="lokasi_pelaksanaan" name="lokasi_pelaksanaan"><br>

    <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label><br>
    <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan"><br>

    <label for="jumlah_peserta">Jumlah Peserta</label><br>
    <input type="number" name="jumlah_peserta" id="jumlah_peserta"><br><br>

    <button type="submit">Simpan Jadwal</button>
</form>