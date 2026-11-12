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
    
});
//Route::get('/donasi', [JadwalController::class, 'index'])
  //  ->name('donasi');

  //TESTING HALAMAN DONASI
Route::get('/donasi', [DonasiController::class, 'daftar'])->name('donasi');
Route::get('/donasi-bulanan/{idJadwal}', [DonasiController::class, 'index'])->name('donasi.bulanan');
Route::get('/donasi-pembayaran', [DonasiController::class, 'tampilPembayaran'])
    ->name('donasi.pembayaran.tampil');

Route::post('/donasi-pembayaran', [DonasiController::class, 'pembayaran'])
    ->name('donasi.pembayaran');
Route::post('/kirim-bukti-donasi', function (Request $request) {
    $request->validate([
        'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:20480',
    ]);

    $items = session('item_donasi', []);
    if (empty($items)) {
        return back()->with('error', 'Data donasi tidak ditemukan.');
    }

    $path     = $request->file('bukti_transfer')->store('bukti_donasi', 'public');
    $donatur  = Auth::guard('donatur')->user();
    $idDonasi = 'DN' . strtoupper(Str::random(8));

    DB::transaction(function () use ($items, $path, $donatur, $idDonasi) {
        DB::table('donasi')->insert([
            'id_donasi'      => $idDonasi,
            'nominal_donasi' => session('total_donasi'),
            'waktu_donasi'   => now(),
            'metode_donasi'  => 'Transfer',
            'bukti_donasi'   => $path,
            'id_donatur'     => $donatur->id_donatur,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        foreach ($items as $item) {
            DB::table('detail_donasi')->insert([
                'jumlah_tanaman'    => $item['jumlah'],
                'id_donasi'         => $idDonasi,
                'id_jadwal_tanaman' => $item['id_jadwal_tanaman'],
            ]);
        }
    });

    session()->forget(['item_donasi', 'total_donasi']);

    return back()->with('success', 'Bukti donasi berhasil diunggah!');
})->name('kirim-bukti.store');

Route::get('/donasi-sukarela', [DonasiController::class, 'sukarela'])->name('donasi.sukarela');
Route::get('/donasi-detail/{idJadwal}', [DonasiController::class, 'detail'])->name('donasi.detail');
// Testing halaman dokumentasi
Route::get('/iwak', function () {
    return view('sites.halaman-dokumentasi');
});

// Rute untuk Halaman Bantuan Pembayaran
Route::get('/help', function () {
    return view('help'); 
})->name('help');

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

// Testing halaman jadwal
Route::get('/jadwal', function () {
    return view('sites.halaman-jadwal-penanaman');
});

Route::view('/tentang-kami', 'tentang-kami')->name('tentang');
