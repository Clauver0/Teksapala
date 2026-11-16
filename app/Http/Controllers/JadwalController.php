<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public const STATUS_AWAL = 'Belum dilaksanakan';

    public function index(): View
    {
        $daftarJadwal = Jadwal::tidakDiarsipkan()
            ->orderBy('tanggal_pelaksanaan')
            ->paginate(12);

        return view('jadwal.halaman-jadwal', compact('daftarJadwal'));
    }

    public function create(): View
    {
        return view('jadwal.tambah-jadwal');
    }

    public function store(JadwalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['gambar'] = $request->file('gambar')->store('gambar-jadwal', 'public');
        $data['id_komunitas'] = $this->idKomunitas($request);
        $data['status_pelaksanaan'] = self::STATUS_AWAL;

        Jadwal::create($data);

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal): View
    {
        $jadwal->load('jadwalTanaman.tanaman'); // dipakai total donasi & daftar tanaman

        return view('jadwal.detail-jadwal', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal): View
    {
        return view('jadwal.edit-jadwal', compact('jadwal'));
    }

    public function update(JadwalRequest $request, Jadwal $jadwal): RedirectResponse
    {
        $data = $request->validated();
        unset($data['gambar']); // hanya diganti kalau ada file baru

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($jadwal->gambar);
            $data['gambar'] = $request->file('gambar')->store('gambar-jadwal', 'public');
        }

        $jadwal->update($data);

        return redirect()->route('jadwal.show', $jadwal)->with('sukses', 'Jadwal berhasil diperbarui.');
    }

    public function arsip(Jadwal $jadwal): RedirectResponse
    {
        $jadwal->update(['is_archived' => true]);

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil diarsipkan.');
    }

    public function daftarArsip(): View
    {
        $daftarJadwal = Jadwal::where('is_archived', true)
            ->orderByDesc('tanggal_pelaksanaan')
            ->paginate(12);

        return view('jadwal.arsip-jadwal', compact('daftarJadwal'));
    }

    public function kembalikan(Jadwal $jadwal): RedirectResponse
    {
        $jadwal->update(['is_archived' => false]);

        return redirect()->route('jadwal.daftar-arsip')->with('sukses', 'Jadwal berhasil dikembalikan.');
    }

    public function destroy(Jadwal $jadwal): RedirectResponse
    {
        // Soft delete: file gambar sengaja tidak dihapus supaya data bisa direstore.
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil dihapus.');
    }

    /**
     * Asumsi: komunitas diambil dari user yang login (kolom id_komunitas di tabel user).
     * Sesuaikan di sini kalau sumbernya berbeda.
     */
    private function idKomunitas(Request $request): string
    {
        return $request->user()->id_komunitas;
    }
}