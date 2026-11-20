<?php
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DonasiController;
use Illuminate\Http\Request;
use App\Livewire\KalenderJadwal;
use App\Http\Controllers\DokumentasiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Donasi;
use App\Models\DetailDonasi;



Route::redirect('/', '/dokumentasi');

Route::middleware('guest:donatur,komunitas')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrasi', [AuthController::class, 'registerView'])->name('register');
    Route::post('/registrasi', [AuthController::class, 'register']);
});

Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi.index');
Route::get('/beranda', [DokumentasiController::class, 'index'])
    ->name('beranda');
Route::get('/dokumentasi/{id_jadwal}', [DokumentasiController::class, 'show'])->name('dokumentasi.show');    

Route::middleware('auth:donatur,komunitas')->group(function () {
    
    Route::get('/profil', [AuthController::class, 'profile'])->name('profil');
    Route::get('/profil/edit', [AuthController::class, 'editProfile'])->name('profil.edit');
    Route::post('/profil/edit', [AuthController::class, 'updateProfile'])->name('profil.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Kirim Bukti Donasi
    Route::get('/kirim-bukti-donasi', function () {
        return view('components.kirim-bukti-donasi'); 
    })->name('kirim-bukti');

    // Proses Upload Bukti Donasi

//Route::get('/donasi', [JadwalController::class, 'index'])
  //  ->name('donasi');

  //TESTING HALAMAN DONASI
Route::get('/donasi', [DonasiController::class, 'index'])
    ->name('donasi');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/donasi', [DonasiController::class, 'daftar'])->name('donasi');
Route::get('/donasi-bulanan/{idJadwal}', [DonasiController::class, 'tanaman'])->name('donasi.bulanan');
Route::get('/donasi-pembayaran', [DonasiController::class, 'tampilPembayaran'])
    ->name('donasi.pembayaran.tampil');
    Route::get('/donasi', [DonasiController::class, 'daftar'])->name('donasi');
    Route::get('/donasi-bulanan/{idJadwal}', [DonasiController::class, 'tanaman'])->name('donasi.bulanan');
    Route::get('/donasi-pembayaran', [DonasiController::class, 'tampilPembayaran'])
      ->name('donasi.pembayaran.tampil');

    Route::post('/donasi-pembayaran', [DonasiController::class, 'pembayaran'])
        ->name('donasi.pembayaran');
    Route::post('/kirim-bukti-donasi', [DonasiController::class, 'store'])->name('kirim-bukti.store');
    Route::get('/daftar-pendonasi', [DonasiController::class, 'verifikasiIndex'])->name('donasi.verifikasi');
    Route::patch('/daftar-pendonasi/{donasi}', [DonasiController::class, 'verifikasiUpdate'])->name('donasi.verifikasi.update');

    Route::get('/donasi-sukarela', [DonasiController::class, 'sukarela'])->name('donasi.sukarela');
    Route::get('/donasi-detail/{idJadwal}', [DonasiController::class, 'detail'])->name('donasi.detail');

});


// Rute untuk Halaman Bantuan Pembayaran

Route::get('/jurnal', function () {
    return view('Jurnal.Jurnal');
})->name('jurnal');

Route::middleware('auth:komunitas')->group(function () {
    Route::get('/kelola-jurnal', [JurnalController::class, 'index'])->name('jurnals.index');
    Route::get('/input-jurnal', [JurnalController::class, 'create'])->name('jurnals.create');
    Route::post('/input-jurnal', [JurnalController::class, 'store'])->name('jurnals.store');
    Route::get('/edit-jurnal/{jurnal}', [JurnalController::class, 'edit'])->name('jurnals.edit');
    Route::put('/edit-jurnal/{jurnal}', [JurnalController::class, 'update'])->name('jurnals.update');
    Route::delete('/jurnal/{jurnal}', [JurnalController::class, 'destroy'])->name('jurnals.destroy');
});


Route::view('/tentang-kami', 'tentang-kami')->name('tentang');

