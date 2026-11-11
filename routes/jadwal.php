<?php

use Illuminate\Support\Facades\Route;

// Karena sudah pakai prefix 'jadwal', cukup tulis '/' atau '' untuk halaman utama
Route::get('/', function () {
    return view('jadwal.halaman-jadwal');
});

// Untuk detail, cukup tulis '/detail' (jadi aksesnya /jadwal/detail)
Route::get('/detail', function () {
    return view('jadwal.detail-jadwal');
});

// Untuk formulir, cukup tulis '/formulir' (jadi aksesnya /jadwal/formulir)
Route::get('/formulir', function () {
    return view('jadwal.formulir-jadwal');
});