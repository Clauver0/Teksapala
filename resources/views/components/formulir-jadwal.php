<form action="">
    <label for="deskripsi-penanaman">Deskripsi: </label><br>
    <input type="text" id="deskripsi-penanaman" name="deskripsi-penanaman"><br>

    <label for="status-pelaksanaan">Status Pelaksanaan</label>
    <select name="status-pelaksanaan" id="status-pelaksanaan"><br>
        <option value="" disabled selected>-- Pilih salah satu --</option>
        <option value="terjadwal">Terjadwal</option>
        <option value="berlangsung">Berlangsung</option>
        <option value="selesai">Selesai</option>
    </select><br>

    <label for="lokasi-penanaman">Lokasi Penanaman: </label><br>
    <input type="text" id="lokasi-penanaman" name="lokasi-penanaman"><br>

    <label for="tanggal-pelaksanaan">Tanggal Pelaksanaan</label><br>
    <input type="date" name="tanggal-pelaksanaan" id="tanggal-pelaksanaan"><br>

    <label for="jumlah peserta">Jumlah Peserta</label><br>
    <input type="number" name="jumlah-peserta" id="jumlah-peserta"><br>
</form>

<!-- what we are going to fill in databases
 1. id_jadwal - automated by sistem
 2. status_pelaksanaan - enum > terjadwal, berlangsung, selesai
 3. lokasi_penanaman - string
 3. tanggal_pelaksanaan -calendar
 4. dekskripsi - teks
 5. jumlah peserta -int
 6. deleted_at - timestamp - automated by sistem
 7. is_archieved - boolean -->