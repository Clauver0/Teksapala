<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class BerandaController extends Controller
{
    public function index(): View
    {
        // ==========================================
        // 1. DATA CARD DONASI (TERVERIFIKASI)
        // ==========================================
        $totalDonasi = (float) Donasi::query()
            ->where('status_verifikasi', 'Terverifikasi')
            ->sum('nominal_donasi');

        $jumlahPartisipan = (int) Donasi::query()
            ->where('status_verifikasi', 'Terverifikasi')
            ->whereNotNull('id_donatur')
            ->distinct('id_donatur')
            ->count('id_donatur');

        $currentDonaturId = Auth::guard('donatur')->user()?->id_donatur;

        $namaExpr = $this->buildDonaturNameExpression();

        $peringkat = DB::table('donasi as d')
            ->leftJoin('donatur as dn', 'dn.id_donatur', '=', 'd.id_donatur')
            ->where('d.status_verifikasi', 'Terverifikasi')
            ->whereNotNull('d.id_donatur')
            ->select(
                'd.id_donatur',
                DB::raw("{$namaExpr} as nama_tampil"),
                DB::raw('SUM(d.nominal_donasi) as total_nominal')
            )
            ->groupBy('d.id_donatur', 'nama_tampil')
            ->orderByDesc('total_nominal')
            ->limit(3)
            ->get()
            ->map(function ($row, $index) use ($currentDonaturId) {
                $isYou = $currentDonaturId && (string) $row->id_donatur === (string) $currentDonaturId;

                return [
                    'rank'    => $index + 1,
                    'nama'    => $isYou ? 'You' : ($row->nama_tampil ?: 'Donatur'),
                    'nominal' => (float) $row->total_nominal,
                    'is_you'  => $isYou,
                ];
            });

        // ==========================================
        // 2. DATA CARD JEJAK (TANAMAN & CO2)
        // ==========================================
        $totalTertanam = (int) DB::table('detail_donasi as dd')
            ->join('donasi as d', 'd.id_donasi', '=', 'dd.id_donasi')
            ->where('d.status_verifikasi', 'Terverifikasi')
            ->sum('dd.jumlah_tanaman');

        // Faktor estimasi penyerapan CO2 (Ton per pohon) — sesuaikan bila ada rumus khusus
        $co2PerPohonTon = 0.02;
        $penyerapanCo2 = round($totalTertanam * $co2PerPohonTon, 2);

        // ==========================================
        // 3. DATA CARD JADWAL RINGKAS
        // ==========================================
        $jadwals = Jadwal::query()
            ->tidakDiarsipkan()
            ->with(['jadwalTanaman.tanaman'])
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->limit(5)
            ->get()
            ->map(function ($jadwal) {
                
                $namaTanaman = $jadwal->jadwalTanaman
                    ->map(fn ($jt) => $jt->tanaman?->nama_tanaman)
                    ->filter()
                    ->unique()
                    ->values();

                $lokasi = $jadwal->lokasi_pelaksanaan ?: ($jadwal->judul ?: '-');

                return [
                    'tanggal' => $jadwal->tanggal_pelaksanaan
                        ? Carbon::parse($jadwal->tanggal_pelaksanaan)->translatedFormat('d M Y')
                        : '-',
                    'lokasi'  => $lokasi,
                    'tanaman' => $namaTanaman->isNotEmpty() ? $namaTanaman->implode(', ') : '-',
                ];
            });

        return view('Beranda.beranda', [
            'totalDonasi'      => $totalDonasi,
            'jumlahPartisipan' => $jumlahPartisipan,
            'peringkat'        => $peringkat,
            'totalTertanam'    => $totalTertanam,
            'penyerapanCo2'    => $penyerapanCo2,
            'jadwals'          => $jadwals,
        ]);
    }

    /**
     * Susun ekspresi nama donatur secara aman sesuai kolom yang ada di tabel `donatur`.
     */
    private function buildDonaturNameExpression(): string
    {
        if (! Schema::hasTable('donatur')) {
            return "'Donatur'";
        }

        $candidates = [];
        foreach (['display_name', 'nama_lengkap', 'nama', 'username'] as $col) {
            if (Schema::hasColumn('donatur', $col)) {
                $candidates[] = "NULLIF(TRIM(dn.{$col}), '')";
            }
        }

        if (empty($candidates)) {
            return "'Donatur'";
        }

        return 'COALESCE(' . implode(', ', $candidates) . ", 'Donatur')";
    }
}