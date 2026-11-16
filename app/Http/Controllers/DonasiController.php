<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */
     public function index()
    {
        // Mengambil semua jadwal yang tidak diarsipkan
        $jadwals = Jadwal::tidakDiarsipkan()
            ->with('jadwalTanaman')
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->get();

        // Mengirim data jadwal ke halaman informasi donasi
        return view(
            'donasi.lihat-informasi-donasi',
            compact('jadwals')
        );
    }

    /**
     * Memproses transaksi/pembayaran donasi.
     */
    public function store(Request $request)
    {
        // Logika menyimpan transaksi donasi
        return redirect()->back()->with(
            'success',
            'Donasi berhasil diproses!'
        );
    }
}