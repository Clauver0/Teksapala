<?php

use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Livewire\KalenderJadwal;

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

    // Rute Kirim Bukti Donasi
    Route::get('/kirim-bukti-donasi', function () {
        return view('components.kirim-bukti-donasi'); 
    })->name('kirim-bukti');

    // Proses Upload Bukti Donasi
    Route::post('/kirim-bukti-donasi', function (Request $request) {
        // Validasi file (Wajib gambar, format jpg/png, maksimal 20MB)
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:20480',
        ]);

        if ($request->hasFile('bukti_transfer')) {
            // Simpan gambar ke folder storage/app/public/bukti_donasi
            $path = $request->file('bukti_transfer')->store('bukti_donasi', 'public');
            
            // Di sini Anda bisa menambahkan logika untuk menyimpan $path ke database
            // Contoh: Auth::user()->update(['bukti_donasi' => $path]);
            
            return redirect()->back()->with('success', 'Bukti donasi berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti donasi.');
    })->name('kirim-bukti.store');

    // ==========================================
    // RUTE HALAMAN SERTIFIKAT (BARU DITAMBAHKAN)
    // ==========================================
    Route::get('/sertifikat', function () {
        return view('sertifikat'); 
    })->name('sertifikat');
});

// Testing halaman dokumentasi
Route::get('/iwak', function () {
    return view('sites.halaman-dokumentasi');
});

// Rute untuk Halaman Bantuan Pembayaran
Route::get('/help', function () {
    return view('help'); 
})->name('help');

Route::get('/donasi',function(){
    return view('Donasi');
    
});

Route::get('/jurnal', function () {
    return view('Jurnal.Jurnal');
});

Route::get('/kelola-jurnal', [JurnalController::class, 'index'])->name('jurnals.index');

Route::get('/input-jurnal', [JurnalController::class, 'create'])->name('jurnals.create');
Route::post('/input-jurnal', [JurnalController::class, 'store'])->name('jurnals.store');

Route::get('/edit-jurnal/{jurnal}', [JurnalController::class, 'edit'])->name('jurnals.edit');
Route::put('/edit-jurnal/{jurnal}', [JurnalController::class, 'update'])->name('jurnals.update');

Route::delete('/jurnal/{jurnal}', [JurnalController::class, 'destroy'])->name('jurnals.destroy');

// Testing halaman jadwal
Route::get('/jadwal', function () {
    return view('sites.halaman-jadwal-penanaman');
});

