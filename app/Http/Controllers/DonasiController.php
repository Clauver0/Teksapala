<?php

namespace App\Http\Controllers;

use App\Models\DetailDonasi;
use App\Models\Donasi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    /**
     * Menampilkan form/halaman utama transaksi donasi.
     */
    public function index()
    {
        $jadwals = Jadwal::tidakDiarsipkan()
            ->with('jadwalTanaman')
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->get();

        return view(
            'donasi.lihat-informasi-donasi',
            compact('jadwals')
        );
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
        return view('donasi.donasi-sukarela');
    }

    public function pembayaran(Request $request)
    {
        // =================================
        // DONASI SUKARELA
        // =================================
        if ($request->filled('nominal')) {
            $nominal = (int) str_replace('.', '', $request->input('nominal'));

            if ($nominal < 1000) {
                return back()->with('error', 'Minimal donasi Rp1.000.');
            }

            session([
                'total_donasi' => $nominal,
                'item_donasi'  => [],
                'jenis_donasi' => 'sukarela',
            ]);

            return redirect()->route('donasi.pembayaran.tampil');
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
            'item_donasi'  => $items,
            'jenis_donasi' => 'tanaman',
        ]);

        return redirect()->route('donasi.pembayaran.tampil');
    }

    public function tampilPembayaran()
    {
        $total = session('total_donasi');
        $items = session('item_donasi', []);
        $jenis = session('jenis_donasi');

        if (!$total) {
            return redirect()->route('donasi')
                ->with('error', 'Data donasi tidak ditemukan.');
        }

        if ($jenis === 'tanaman' && empty($items)) {
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
                DB::raw('COALESCE(donatur.display_name, donatur.nama_lengkap, donatur.username) as nama_donatur'),
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

    public function verifikasiUpdate(Request $request, Donasi $donasi)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Terverifikasi,Ditolak',
        ]);

        $donasi->update(['status_verifikasi' => $request->status_verifikasi]);

        return back()->with('success', 'Status donasi diperbarui.');
    }

    public function verifikasiShow(Donasi $donasi)
    {
        $donasi->load([
            'donatur',
            'detailDonasis.jadwalTanaman.tanaman',
            'detailDonasis.jadwalTanaman.jadwal',
        ]);

        $jadwals = $donasi->detailDonasis
            ->map(fn ($detail) => $detail->jadwalTanaman?->jadwal)
            ->filter()
            ->unique('id_jadwal')
            ->values();

        return view('donasi.detail-donasi-komunitas', compact('donasi', 'jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:20480',
        ]);

        $total = session('total_donasi');
        $items = session('item_donasi', []);
        $jenis = session('jenis_donasi');

        if (!$total || !$jenis) {
            return back()->with('error', 'Data donasi tidak ditemukan.');
        }

        if ($jenis === 'tanaman' && empty($items)) {
            return back()->with('error', 'Data donasi tidak ditemukan.');
        }

        $donatur = Auth::guard('donatur')->user();
        if (!$donatur) {
            return back()->with('error', 'Hanya donatur yang dapat berdonasi.');
        }

        $path = $request->file('bukti_transfer')->store('bukti_donasi', 'public');

        DB::transaction(function () use ($items, $path, $donatur, $total, $jenis) {
            $donasi = Donasi::create([
                'nominal_donasi' => $total,
                'waktu_donasi'   => now(),
                'metode_donasi'  => 'Transfer',
                'bukti_donasi'   => $path,
                'id_donatur'     => $donatur->id_donatur,
            ]);

            if ($jenis === 'tanaman') {
                foreach ($items as $item) {
                    DetailDonasi::create([
                        'jumlah_tanaman'    => $item['jumlah'],
                        'id_donasi'         => $donasi->id_donasi,
                        'id_jadwal_tanaman' => $item['id_jadwal_tanaman'],
                    ]);
                }
            }
        });

        session()->forget(['item_donasi', 'total_donasi', 'jenis_donasi']);

        return redirect()->route('donasi')->with('success', 'Bukti donasi berhasil diunggah!');
    }

    public function detailUser(Donasi $donasi)
    {
        $donatur = Auth::guard('donatur')->user();

        abort_if(!$donatur || $donasi->id_donatur !== $donatur->id_donatur, 403);

        $donasi->load([
            'donatur',
            'detailDonasis.jadwalTanaman.tanaman',
            'detailDonasis.jadwalTanaman.jadwal',
        ]);

        return view('donasi.detail-donasi-user', compact('donasi'));
    }
}