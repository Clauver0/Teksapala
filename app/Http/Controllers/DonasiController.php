<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */
    public function index()
    {
        return view('donasi.lihat-informasi-donasi');
    }

    /**
     * Memproses transaksi/pembayaran donasi.
     */
    public function store(Request $request)
    {
        // Logika menyimpan transaksi donasi
        return redirect()->back()->with('success', 'Donasi berhasil diproses!');
    }
}
   

