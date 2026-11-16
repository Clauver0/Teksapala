<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Menampilkan halaman informasi donasi.
     */
    public function index()
    {
        // Ambil donasi terverifikasi beserta data donatur
        $donasis = Donasi::with('donatur')
            ->where('status_verifikasi', 'Terverifikasi')
            ->orderBy('waktu_donasi', 'desc')
            ->get();

        // Total nominal donasi
        $totalDonasi = $donasis->sum('nominal_donasi');

        // Judul kegiatan (statis, bisa diganti dari tabel kegiatan)
        $judulKegiatan = "PENANAMAN MANGROVE DI PANTAI CEMARA";

        return view('donasi.donasi-detail', compact('donasis', 'totalDonasi', 'judulKegiatan'));
    }

    /**
     * Memproses transaksi donasi.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nominal_donasi' => 'required|numeric|min:1000',
            'metode_donasi'  => 'required|string|max:50',
            'bukti_donasi'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'id_donatur'     => 'required|string|exists:donatur,id_donatur',
        ]);

        $buktiPath = $request->file('bukti_donasi')->store('bukti_donasi', 'public');

        Donasi::create([
            'nominal_donasi'    => $request->nominal_donasi,
            'waktu_donasi'      => now(),
            'metode_donasi'     => $request->metode_donasi,
            'status_verifikasi' => 'Pending',
            'bukti_donasi'      => $buktiPath,
            'file_sertifikat'   => null,
            'id_donatur'        => $request->id_donatur,
        ]);

        return redirect()->back()->with('success', 'Donasi berhasil diproses!');
    }
}