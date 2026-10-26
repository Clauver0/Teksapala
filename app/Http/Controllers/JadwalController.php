<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\JadwalTanaman;

class JadwalController extends Controller{
    public function tampilkanJadwal()
{
    $jadwals = Jadwal::all(); // Ambil data dari model Jadwal
    return view('sites.halaman-jadwal-penanaman', compact('jadwals'));
}

    public function create()
    {
        return view('components.formulir-jadwal');
    }

    public function store(Request $request)
    {
        // 1. Validasi data input dari user
        $request->validate([
            'deskripsi' => 'required|string',
            'status_pelaksanaan' => 'required|in:terjadwal,berlangsung,selesai',
            'lokasi_pelaksanaan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'jumlah_peserta' => 'required|integer',
        ]);

        // 2. Simpan data menggunakan Eloquent Model
        // (Catatan: id_jadwal otomatis terisi karena sudah diatur di fungsi booted() pada Model Jadwal kamu)
        Jadwal::create([
            'deskripsi' => $request->deskripsi,
            'status_pelaksanaan' => $request->status_pelaksanaan,
            'lokasi_pelaksanaan' => $request->lokasi_pelaksanaan,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'is_archived' => 0, // Nilai default jika dibutuhkan
        ]);

        // 3. Redirect kembali ke halaman jadwal atau halaman utama dengan pesan sukses
        return redirect()->route('jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }
}

?>