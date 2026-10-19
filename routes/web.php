<?php

use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DonationController;

Route::redirect('/', '/profil');

Route::middleware('guest:donatur,komunitas')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'registerView'])->name('register');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::middleware('auth:donatur,komunitas')->group(function () {
    Route::get('/profil', [AuthController::class, 'profile'])->name('profil');
    Route::get('/profil/edit', [AuthController::class, 'editProfile'])->name('profil.edit');
    Route::post('/profil/edit', [AuthController::class, 'updateProfile'])->name('profil.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return view('welcome');
});

// Testing halaman dokumentasi
Route::get('/iwak', function () {
    return view('sites.halaman-dokumentasi');
});