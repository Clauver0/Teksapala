<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JadwalController;


// Rute Jadwal & Penanaman
// Ubah dari yang tadinya pakai function() {} jadi begini:
Route::get('/jadwal', [JadwalController::class, 'tampilkanJadwal'])->name('jadwal');

// Halaman Testing / Lainnya
Route::get('/iwak', function () {
    return view('sites.halaman-dokumentasi');
});