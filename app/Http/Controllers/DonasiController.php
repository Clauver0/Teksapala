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
    $jadwal = DB::table('jadwal')
        ->leftJoin('donasi', 'donasi.id_jadwal', '=', 'jadwal.id_jadwal')
        ->select(
            'jadwal.id_jadwal',
            'jadwal.nama_kegiatan',
            'jadwal.tanggal',
            DB::raw('COUNT(donasi.id_jadwal) as jumlah_donatur'),
            DB::raw('COALESCE(SUM(donasi.nominal), 0) as total_donasi')
        )
        ->groupBy('jadwal.id_jadwal', 'jadwal.nama_kegiatan', 'jadwal.tanggal')
        ->orderBy('jadwal.tanggal')
        ->get();

    return view('donasi.lihat-informasi-donasi', compact('jadwal'));
}

public function sukarela()
{
    return view('donasi.donasi-sukarela');   // resources/views/donasi/donasi-sukarela.blade.php
}


   public function pembayaran(Request $request)
{
    $total = $request->input('total');
    session(['total_donasi' => $total]);

    $banks = $this->dataBank();

    return view('donasi.donasi-pembayaran', compact('total', 'banks'));
}

private function dataBank(): array
{
    return [
        'BRI' => [
            'BRIVA'    => '123456789012345',
            'TRANSFER' => '9876543210',
        ],
        'Mandiri' => [
            'LIVIN BY MANDIRI' => '8808123456789012',
            'TRANSFER'         => '1400012345678',
        ],
    ];
}
   public function detail($idJadwal)
{
    $jadwal = DB::table('jadwal')->where('id_jadwal', $idJadwal)->first();
    abort_if(!$jadwal, 404);

    $donasi = DB::table('donasi')
        ->where('id_jadwal', $idJadwal)
        ->select('nama_donatur', 'nominal')
        ->get();

    $total = $donasi->sum('nominal');

    return view('donasi.detail-donasi', compact('jadwal', 'donasi', 'total'));
}

}