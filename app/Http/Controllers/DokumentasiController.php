<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Jadwal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DokumentasiController extends Controller
{
    /**
     * Halaman publik: menampilkan jadwal yang sudah memiliki dokumentasi (relasi 1-to-1).
     */
    public function index(): View
    {
        $jadwals = Jadwal::whereHas('dokumentasi')
            ->with('dokumentasi')
            ->orderByDesc('tanggal_pelaksanaan')
            ->get();

        return view('dokumentasi.index', compact('jadwals'));
    }

    /**
     * Detail dokumentasi berdasarkan id_jadwal.
     */
    public function show(string $id_jadwal): View
    {
        $jadwal = Jadwal::with('dokumentasi')
            ->where('id_jadwal', $id_jadwal)
            ->firstOrFail();

        return view('dokumentasi.show', compact('jadwal'));
    }

    /**
     * Dashboard CRUD dokumentasi untuk admin komunitas.
     */
    public function kelola(Request $request): View
    {
        $this->ensureAdminKomunitas($request);

        $jadwals = Jadwal::with('dokumentasi')
            ->orderByDesc('tanggal_pelaksanaan')
            ->get();

        return view('dokumentasi.kelola', compact('jadwals'));
    }

    /**
     * Form buat dokumentasi (hanya jika jadwal statusnya 'Selesai' & belum punya dokumentasi).
     */
    public function create(Request $request, Jadwal $jadwal): View|RedirectResponse
    {
        $this->ensureAdminKomunitas($request);

        if (! $jadwal->sudahTerlaksana()) {
            return redirect()
                ->route('komunitas.dokumentasi.index')
                ->with('error', 'Dokumentasi hanya bisa dibuat jika status pelaksanaan jadwal sudah terlaksana (Selesai).');
        }

        if ($jadwal->dokumentasi()->exists()) {
            return redirect()
                ->route('komunitas.dokumentasi.edit', $jadwal->dokumentasi)
                ->with('info', 'Jadwal ini sudah memiliki dokumentasi. Silakan edit dokumentasi yang ada.');
        }

        return view('dokumentasi.create', compact('jadwal'));
    }

    /**
     * Simpan dokumentasi baru.
     */
    public function store(Request $request, Jadwal $jadwal): RedirectResponse
    {
        $idAdminKomunitas = $this->ensureAdminKomunitas($request);

        if (! $jadwal->sudahTerlaksana()) {
            return redirect()
                ->route('komunitas.dokumentasi.index')
                ->with('error', 'Dokumentasi tidak dapat dibuat karena status jadwal belum terlaksana.');
        }

        if ($jadwal->dokumentasi()->exists()) {
            return redirect()
                ->route('komunitas.dokumentasi.index')
                ->with('error', 'Setiap jadwal hanya boleh memiliki satu dokumentasi.');
        }

        $validated = $request->validate([
            'judul_dokumentasi' => ['required', 'string', 'max:150'],
            'link_gdrive'       => ['required', 'url', 'max:500'],
            'deskripsi'         => ['nullable', 'string'],
        ]);

        Dokumentasi::create([
            'judul_dokumentasi' => $validated['judul_dokumentasi'],
            'link_gdrive'       => $validated['link_gdrive'],
            'deskripsi'         => $validated['deskripsi'] ?? null,
            'tanggal_unggah'    => now(),
            'id_jadwal'         => $jadwal->id_jadwal,
            'id_komunitas'      => $idAdminKomunitas,
        ]);

        // Catat id_komunitas (ID admin) yang menginput dokumentasi pada jadwal
        $jadwal->update([
            'id_komunitas' => $idAdminKomunitas,
        ]);

        return redirect()
            ->route('komunitas.dokumentasi.index')
            ->with('sukses', 'Dokumentasi berhasil ditambahkan.');
    }

    /**
     * Form edit dokumentasi.
     */
    public function edit(Request $request, Dokumentasi $dokumentasi): View
    {
        $this->ensureAdminKomunitas($request);

        $jadwal = $dokumentasi->jadwal;

        return view('dokumentasi.edit', compact('dokumentasi', 'jadwal'));
    }

    /**
     * Update dokumentasi.
     */
    public function update(Request $request, Dokumentasi $dokumentasi): RedirectResponse
    {
        $this->ensureAdminKomunitas($request);

        $validated = $request->validate([
            'judul_dokumentasi' => ['required', 'string', 'max:150'],
            'link_gdrive'       => ['required', 'url', 'max:500'],
            'deskripsi'         => ['nullable', 'string'],
        ]);

        $dokumentasi->update([
            'judul_dokumentasi' => $validated['judul_dokumentasi'],
            'link_gdrive'       => $validated['link_gdrive'],
            'deskripsi'         => $validated['deskripsi'] ?? null,
        ]);

        return redirect()
            ->route('komunitas.dokumentasi.index')
            ->with('sukses', 'Dokumentasi berhasil diperbarui.');
    }

    /**
     * Hapus dokumentasi.
     */
    public function destroy(Request $request, Dokumentasi $dokumentasi): RedirectResponse
    {
        $this->ensureAdminKomunitas($request);

        $dokumentasi->delete();

        return redirect()
            ->route('komunitas.dokumentasi.index')
            ->with('sukses', 'Dokumentasi berhasil dihapus.');
    }

    /**
     * Pastikan user terautentikasi sebagai admin komunitas dengan id_komunitas valid.
     */
    private function ensureAdminKomunitas(Request $request): string
    {
        $idKomunitas = $request->user()?->id_komunitas;
        abort_if(empty($idKomunitas), 403);

        return $idKomunitas;
    }
}