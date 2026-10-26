<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;

class DokumentasiController extends Controller
{
    public function tampilkanDokumentasi()
    {
        // Ambil semua dokumentasi beserta relasi jadwal dan jadwal_tanaman-nya
        $dokumentasis = Dokumentasi::with('jadwal.jadwalTanaman')->get();

        return view('sites.halaman-dokumentasi', compact('dokumentasis'));
    }
}