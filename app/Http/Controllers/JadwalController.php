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
}

?>