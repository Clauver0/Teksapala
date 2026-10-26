<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JadwalController;


// Rute Jadwal & Penanaman
// Ubah dari yang tadinya pakai function() {} jadi begini:

// Rute Jadwal & Penanaman
Route::get('/jadwal', [JadwalController::class, 'tampilkanJadwal'])->name('jadwal.index');
Route::get('/iwak', [JadwalController::class, 'tampilkanDetailJadwal'])->name('jadwal.iwak');

// Rute Form Input Jadwal
Route::get('/formulir-jadwal', [JadwalController::class, 'create'])->name('jadwal.create');
Route::post('/formulir-jadwal', [JadwalController::class, 'store'])->name('jadwal.store');