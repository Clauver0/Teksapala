<?php

namespace App\Http\Controllers;
use App\Models\JadwalTanaman;
use App\Models\Donasi;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 


class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */




public function index()
{
    // Ambil semua jadwal yang tidak diarsipkan
    $jadwals = Jadwal::tidakDiarsipkan()
        ->with('jadwalTanaman')
        ->orderBy('tanggal_pelaksanaan', 'asc')
        ->get();

    // Hitung total donasi yang sudah terverifikasi
    $totalDonasi = DB::select("
        SELECT
            jt.id_jadwal,
            SUM(dd.jumlah_tanaman * jt.harga) AS total_donasi
        FROM detail_donasi dd
        JOIN jadwal_tanaman jt
            ON jt.id_jadwal_tanaman = dd.id_jadwal_tanaman
        JOIN donasi d
            ON d.id_donasi = dd.id_donasi
        WHERE d.status_verifikasi = 'Terverifikasi'
        GROUP BY jt.id_jadwal
    ");

    // Masukkan total donasi ke masing-masing jadwal
    foreach ($jadwals as $jadwal) {
        $jadwal->total_donasi = 0;

        foreach ($totalDonasi as $total) {
            if ((string) $total->id_jadwal === (string) $jadwal->id_jadwal) {
                $jadwal->total_donasi = (float) $total->total_donasi;
                break;
            }
        }
    }
   
    // Kirim data ke halaman donasi
    return view('donasi.lihat-informasi-donasi', compact('jadwals'));
}


    /**
     * Memproses transaksi/pembayaran donasi.
     */
  public function store(Request $request)
{
    $request->validate([
    'metode_donasi' => 'required|string|max:100',
    'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:20480',
]);

    // Pastikan donor login
    $donatur = auth()->guard('donatur')->user();

    if (!$donatur) {
        return back()->with('error', 'Silakan login sebagai donatur.');
    }

    $total = session('total_donasi');
    $items = session('item_donasi', []);
    $jenis = session('jenis_donasi');

    if (!$total || !$jenis) {
        return back()->with('error', 'Data transaksi donasi tidak ditemukan.');
    }

   $path = $request->file('bukti_transfer')
    ->store('bukti-donasi', 'public');
    try {
        DB::transaction(function () use (
            $request,
            $donatur,
            $total,
            $items,
            $jenis,
            $path
        ) {
            // Simpan transaksi donasi
            $idDonasi = DB::table('donasi')->insertGetId([
                'nominal_donasi'  => $total,
                'waktu_donasi'   => now(),
                'metode_donasi'  => $request->metode_donasi,
                'status_verifikasi' => 'Pending',
                'bukti_donasi'   => $path,
                'id_donatur'     => $donatur->id_donatur,
            ]);

            // Jika donasi tanaman, simpan detail setiap tanaman
            if ($jenis === 'tanaman') {
                foreach ($items as $item) {
                    DB::table('detail_donasi')->insert([
                        'jumlah_tanaman' => (int) $item['jumlah'],
                        'id_donasi' => $idDonasi,
                        'id_jadwal_tanaman' =>
                            $item['id_jadwal_tanaman'],
                    ]);
                }
            }
        });
    } catch (\Throwable $e) {
        // Jika penyimpanan gagal, hapus file bukti yang tadi di-upload
        \Storage::disk('public')->delete($path);

        throw $e;
    }

    // Hapus data transaksi dari session setelah berhasil disimpan
    session()->forget([
        'total_donasi',
        'item_donasi',
        'jenis_donasi',
    ]);

    return redirect()->route('donasi')
        ->with('success', 'Bukti donasi berhasil dikirim. Menunggu verifikasi.');
}

public function tanaman($idJadwal)
{
    $tanaman = DB::table('jadwal_tanaman')
        ->join('tanaman', 'tanaman.id_tanaman', '=', 'jadwal_tanaman.id_tanaman')
       ->where('jadwal_tanaman.id_jadwal', $idJadwal)
        ->select(
            'jadwal_tanaman.id_jadwal_tanaman',
            'tanaman.nama_tanaman',
            'tanaman.gambar',
            'jadwal_tanaman.harga',
            'jadwal_tanaman.kouta',
            'jadwal_tanaman.terdonasi'
        )
        ->get();

    return view('donasi.Donasi', compact('tanaman'));
}

public function daftar()
{
    $perJadwal = DB::table('detail_donasi')
        ->join(
            'jadwal_tanaman',
            'jadwal_tanaman.id_jadwal_tanaman',
            '=',
            'detail_donasi.id_jadwal_tanaman'
        )
        ->join(
            'donasi',
            'donasi.id_donasi',
            '=',
            'detail_donasi.id_donasi'
        )
        ->where('donasi.status_verifikasi', 'Terverifikasi')
        ->select(
            'jadwal_tanaman.id_jadwal',
            'donasi.id_donatur',
            'detail_donasi.jumlah_tanaman',
            'jadwal_tanaman.harga'
        );

    $jadwal = DB::table('jadwal')
        ->leftJoinSub($perJadwal, 'd', 'd.id_jadwal', '=', 'jadwal.id_jadwal')
        ->where('jadwal.is_archived', 0)
        ->whereNull('jadwal.deleted_at')
        ->select(
            'jadwal.id_jadwal',
            'jadwal.lokasi_pelaksanaan',
            'jadwal.tanggal_pelaksanaan',
            'jadwal.status_pelaksanaan',
            DB::raw('COUNT(DISTINCT d.id_donatur) as jumlah_donatur'),
            DB::raw('COALESCE(SUM(d.jumlah_tanaman * d.harga), 0) as total_donasi')
        )
        ->groupBy(
            'jadwal.id_jadwal',
            'jadwal.lokasi_pelaksanaan',
            'jadwal.tanggal_pelaksanaan',
            'jadwal.status_pelaksanaan'
        )
        ->orderBy('jadwal.tanggal_pelaksanaan')
        ->get();

    return view('donasi.lihat-informasi-donasi', compact('jadwal'));
}
public function sukarela()
{
    return view('donasi.donasi-sukarela');   // resources/views/donasi/donasi-sukarela.blade.php
}
public function pembayaran(Request $request)
{
    // =================================
    // DONASI SUKARELA
    // =================================
    if ($request->filled('nominal')) {

        $nominal = (int) str_replace(
            '.',
            '',
            $request->input('nominal')
        );

        if ($nominal < 1000) {
            return back()->with('error', 'Minimal donasi Rp1.000.');
        }

        session([
            'total_donasi' => $nominal,
            'item_donasi' => [],
            'jenis_donasi' => 'sukarela',
        ]);

        $total = $nominal;
        $banks = $this->dataBank();

        return view(
            'donasi.donasi-pembayaran',
            compact('total', 'banks')
        );
    }

    // =================================
    // DONASI TANAMAN
    // =================================
    $items = json_decode($request->input('items'), true) ?? [];

    if (empty($items)) {
        return back()->with('error', 'Pilih minimal satu pohon.');
    }

    $total = 0;

    foreach ($items as $item) {

        $harga = DB::table('jadwal_tanaman')
            ->where('id_jadwal_tanaman', $item['id_jadwal_tanaman'])
            ->value('harga');

        $total += $harga * (int) $item['jumlah'];
    }

    session([
        'total_donasi' => $total,
        'item_donasi' => $items,
        'jenis_donasi' => 'tanaman',
    ]);

    $banks = $this->dataBank();

    return redirect()->route('donasi.pembayaran.tampil');
}
public function tampilPembayaran()
{
    // Ambil data dari session
    $total = session('total_donasi');
    $items = session('item_donasi', []);
    $jenis = session('jenis_donasi');

    // Cek apakah total donasi tersedia
    if (!$total) {
        return redirect()->route('donasi')
            ->with('error', 'Data donasi tidak ditemukan.');
    }

    // Cek khusus donasi tanaman
    if ($jenis == 'tanaman' && empty($items)) {
        return back()->with('error', 'Data donasi tidak ditemukan.');
    }

    $banks = $this->dataBank();

    return view(
        'donasi.donasi-pembayaran',
        compact('total', 'banks', 'items', 'jenis')
    );
}

private function dataBank(): array
{
    return [
        'BRI' => [
            'BRIVA'    => '123456789012345',
            'TRANSFER' => '9876543210',
        ],
        'Mandiri' => [
            'LIVIN BY MANDIRI' => '8808123456789012',
            'TRANSFER'         => '1400012345678',
        ],
    ];
}
 public function detail($idJadwal)
{
    $jadwal = DB::table('jadwal')->where('id_jadwal', $idJadwal)->first();
    abort_if(!$jadwal, 404);

    $donasi = DB::table('donasi')
        ->join('donatur', 'donatur.id_donatur', '=', 'donasi.id_donatur')
        ->whereIn('donasi.id_donasi', function ($q) use ($idJadwal) {
            $q->select('detail_donasi.id_donasi')
              ->from('detail_donasi')
              ->join('jadwal_tanaman', 'jadwal_tanaman.id_jadwal_tanaman', '=', 'detail_donasi.id_jadwal_tanaman')
              ->where('jadwal_tanaman.id_jadwal', $idJadwal);
        })
       ->select(
    'donatur.nama_lengkap as nama_donatur',
    'donasi.nominal_donasi as nominal'
)
        ->get();

    $total = $donasi->sum('nominal');

    return view('donasi.detail-donasi', compact('jadwal', 'donasi', 'total'));
}

}