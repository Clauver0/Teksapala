<?php

namespace App\Http\Controllers;
use App\Models\JadwalTanaman;
use App\Models\Donasi;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */
public function index($idJadwal)
{
    $tanaman = DB::table('jadwal_tanaman')
        ->join('tanaman', 'tanaman.id_tanaman', '=', 'jadwal_tanaman.id_tanaman')
        ->where('jadwal_tanaman.id_jadwal', $idJadwal)
        ->select(
            'jadwal_tanaman.id_jadwal_tanaman',
            'tanaman.nama_tanaman',
            'tanaman.gambar',
            'jadwal_tanaman.harga',
            'jadwal_tanaman.kouta',
            'jadwal_tanaman.terdonasi'
        )
        ->get();

    return view('donasi.Donasi', compact('tanaman'));
}

public function daftar()
{
    return view('donasi.lihat-informasi-donasi');
}
}
   

