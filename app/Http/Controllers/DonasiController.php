<?php

namespace App\Http\Controllers;
use App\Models\JadwalTanaman;
use App\Models\Donasi;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */
    public function index()
{
    // Mengambil semua jadwal yang tidak diarsipkan
    $jadwals = Jadwal::tidakDiarsipkan()
        ->with('jadwalTanaman')
        ->orderBy('tanggal_pelaksanaan', 'asc')
        ->get();

    // Menghitung total donasi yang sudah terverifikasi
    $totalDonasi = DB::select("
        SELECT
            jt.id_jadwal,
            SUM(dd.jumlah_tanaman * jt.harga) AS total_donasi
        FROM detail_donasi dd
        JOIN jadwal_tanaman jt
            ON jt.id_jadwal_tanaman = dd.id_jadwal_tanaman
        JOIN donasi d
            ON d.id_donasi = dd.id_donasi
        WHERE LOWER(TRIM(d.status_verifikasi)) = 'terverifikasi'
        GROUP BY jt.id_jadwal
    ");

    // Mengubah hasil query menjadi pasangan ID jadwal dan total donasi
    $mapTotal = collect($totalDonasi)
        ->pluck('total_donasi', 'id_jadwal');

    // Memasukkan total donasi ke masing-masing jadwal
    foreach ($jadwals as $jadwal) {
        $jadwal->total_donasi_terverifikasi =
            (float) ($mapTotal[$jadwal->id_jadwal] ?? 0);
    }

    // Mengirim data jadwal ke halaman informasi donasi
    return view(
        'donasi.lihat-informasi-donasi',
        compact('jadwals')
    );
}

    /**
     * Memproses transaksi/pembayaran donasi.
     */
  public function store(Request $request)
{
    $request->validate([
        'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:20480',
    ]);

    $total = session('total_donasi');
    $items = session('item_donasi', []);

   if (!$total) {
    return back()->with('error', 'Data donasi tidak ditemukan.');
    }

    $donatur = Auth::guard('donatur')->user();
    if (!$donatur) {
        return back()->with('error', 'Hanya akun donatur yang dapat berdonasi.');
    }

    DB::transaction(function () use ($request, $total, $items, $donatur) {
        $last = DB::table('donasi')->lockForUpdate()->max('id_donasi');
        $next = $last ? ((int) substr($last, 2)) + 1 : 1;
        $idDonasi = 'DN' . str_pad($next, 8, '0', STR_PAD_LEFT);

        $path = $request->file('bukti_transfer')->store('bukti_donasi', 'public');

        DB::table('donasi')->insert([
            'id_donasi'         => $idDonasi,
            'nominal_donasi'    => $total,
            'waktu_donasi'      => now(),
            'metode_donasi'     => 'Transfer',
            'status_verifikasi' => 'Pending',
            'bukti_donasi'      => $path,
            'id_donatur'        => $donatur->id_donatur,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

       $lastDetail = DB::table('detail_donasi')->lockForUpdate()->max('id_detail_donasi');
$nextDetail = $lastDetail ? ((int) substr($lastDetail, 2)) + 1 : 1;

foreach ($items as $item) {
    DB::table('detail_donasi')->insert([
        'id_detail_donasi'  => 'DD' . str_pad($nextDetail++, 8, '0', STR_PAD_LEFT),
        'jumlah_tanaman'    => (int) $item['jumlah'],
        'id_donasi'         => $idDonasi,
        'id_jadwal_tanaman' => $item['id_jadwal_tanaman'],
    ]);
}
    });


 return back()->with('success', 'Donasi berhasil dikirim, menunggu verifikasi.');
}


public function tanaman($idJadwal)
{
     $jadwal = DB::table('jadwal')->where('id_jadwal', $idJadwal)->first();
    abort_if(!$jadwal, 404);

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

    return view('donasi.Donasi', compact('tanaman', 'jadwal'));
}

public function daftar()
{
    $perJadwal = DB::table('detail_donasi')
        ->join('jadwal_tanaman', 'jadwal_tanaman.id_jadwal_tanaman', '=', 'detail_donasi.id_jadwal_tanaman')
        ->join('donasi', 'donasi.id_donasi', '=', 'detail_donasi.id_donasi')
        ->select(
            'jadwal_tanaman.id_jadwal',
            'donasi.id_donasi',
            'donasi.id_donatur',
            'donasi.nominal_donasi'
        )
        ->distinct();

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
            DB::raw('COALESCE(SUM(d.nominal_donasi), 0) as total_donasi')
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
    DB::raw('COALESCE(donatur.nama_lengkap, donatur.display_name, donatur.username) as nama_donatur'),
    'donasi.nominal_donasi as nominal'
)
        ->get();

    $total = $donasi->sum('nominal');

    return view('donasi.detail-donasi', compact('jadwal', 'donasi', 'total'));
}
public function verifikasiIndex()
{
    $donasis = Donasi::with([
            'donatur',
            'detailDonasis.jadwalTanaman.tanaman',
            'detailDonasis.jadwalTanaman.jadwal',
        ])
        ->latest('waktu_donasi')
        ->get();

    return view('donasi.donasi-komunitas', compact('donasis'));
}

public function verifikasiShow($idDonasi)
{
    $donasi = Donasi::with([
            'donatur',
            'detailDonasis.jadwalTanaman.tanaman',
            'detailDonasis.jadwalTanaman.jadwal',
        ])
        ->where('id_donasi', $idDonasi)
        ->firstOrFail();

    $jadwals = $donasi->detailDonasis
        ->map(fn ($detail) => $detail->jadwalTanaman?->jadwal)
        ->filter()
        ->unique('id_jadwal')
        ->values();

    return view('donasi.detail-donasi-komunitas', compact('donasi', 'jadwals'));
}

public function verifikasiUpdate(Request $request, $idDonasi)
{
    $request->validate([
        'status_verifikasi' => 'required|in:Terverifikasi,Ditolak',
    ]);

    DB::transaction(function () use ($request, $idDonasi) {
        $donasi = DB::table('donasi')
            ->where('id_donasi', $idDonasi)
            ->lockForUpdate()
            ->first();

        // hanya donasi Pending yang boleh diproses
        if (!$donasi || $donasi->status_verifikasi !== 'Pending') {
            return;
        }

        DB::table('donasi')->where('id_donasi', $idDonasi)->update([
            'status_verifikasi' => $request->status_verifikasi,
            'updated_at'        => now(),
        ]);

        // Saat terverifikasi, baru tambah kolom terdonasi
        if ($request->status_verifikasi === 'Terverifikasi') {
            $details = DB::table('detail_donasi')->where('id_donasi', $idDonasi)->get();
            foreach ($details as $d) {
                DB::table('jadwal_tanaman')
                    ->where('id_jadwal_tanaman', $d->id_jadwal_tanaman)
                    ->increment('terdonasi', $d->jumlah_tanaman);
            }
        }
    });

    return back()->with('success', 'Status donasi berhasil diperbarui.');
}
}