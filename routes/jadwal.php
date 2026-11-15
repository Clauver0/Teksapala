<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;

Route::prefix('jadwal')->name('jadwal.')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('index');           // halaman-jadwal.blade.php
    Route::get('/create', [JadwalController::class, 'create'])->name('create');   // form tambah (harus di atas /{jadwal})
    Route::post('/', [JadwalController::class, 'store'])->name('store');
    Route::get('/arsip', [JadwalController::class, 'daftarArsip'])->name('daftar-arsip'); // harus di atas /{jadwal}

    Route::get('/{jadwal}', [JadwalController::class, 'show'])->name('show');     // detail-jadwal.blade.php
    Route::get('/{jadwal}/edit', [JadwalController::class, 'edit'])->name('edit');
    Route::put('/{jadwal}', [JadwalController::class, 'update'])->name('update');
    Route::patch('/{jadwal}/arsip', [JadwalController::class, 'arsip'])->name('arsip');
    Route::patch('/{jadwal}/kembalikan', [JadwalController::class, 'kembalikan'])->name('kembalikan');
    Route::delete('/{jadwal}', [JadwalController::class, 'destroy'])->name('destroy');
});

// Dipisah dari grup agar namanya tetap "donasi.create" sesuai yang dipakai di view.
Route::get('/jadwal/{jadwal}/donasi', [DonasiController::class, 'create'])->name('donasi.create');