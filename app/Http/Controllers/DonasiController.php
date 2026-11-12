<?php

namespace App\Http\Controllers;
use App\Models\JadwalTanaman;
use App\Models\Donasi;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */
public function index($idJadwal)
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
        ->select('donatur.nama as nama_donatur', 'donasi.nominal_donasi as nominal')
        ->get();

    $total = $donasi->sum('nominal');

    return view('donasi.detail-donasi', compact('jadwal', 'donasi', 'total'));
}

}