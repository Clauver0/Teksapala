<?php
// app/Http/Controllers/DokumentasiController.php

namespace App\Http\Controllers;

use App\Models\Jadwal;

class DokumentasiController extends Controller
{
    public function index()
    {
        // hanya jadwal yang sudah punya dokumentasi
        $jadwals = Jadwal::whereHas('dokumentasi')
            ->with(['dokumentasi' => fn ($q) => $q->orderBy('tanggal_unggah')])
            ->get();

        return view('dokumentasi.index', compact('jadwals'));
    }

    public function show(string $id_jadwal)
    {
        $jadwal = Jadwal::with(['dokumentasi' => fn ($q) => $q->orderBy('tanggal_unggah')])
            ->where('id_jadwal', $id_jadwal)
            ->firstOrFail();

        return view('dokumentasi.show', compact('jadwal'));
    }
}