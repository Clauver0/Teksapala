<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;      // BARU
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public const STATUS_AWAL = 'Belum dilaksanakan';

    public function index(): View
    {
        $daftarJadwal = Jadwal::tidakDiarsipkan()
            ->with('komunitas')                       // BARU: hindari query berulang kalau view menampilkan nama komunitas
            ->orderBy('tanggal_pelaksanaan')
            ->paginate(12);

        return view('jadwal.halaman-jadwal', compact('daftarJadwal'));
    }

    public function create(): View
    {
        Gate::authorize('create', Jadwal::class);     // BARU: hanya komunitas

        return view('jadwal.tambah-jadwal');
    }

    public function store(JadwalRequest $request): RedirectResponse
    {
        Gate::authorize('create', Jadwal::class);     // BARU

        $data = $request->validated();
        $data['gambar'] = $request->file('gambar')->store('gambar-jadwal', 'public');
        $data['id_komunitas'] = $this->idKomunitas($request);
        $data['status_pelaksanaan'] = self::STATUS_AWAL;

        Jadwal::create($data);

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal): View
    {
        $jadwal->load('jadwalTanaman.tanaman', 'komunitas'); // DIUBAH: + komunitas

        return view('jadwal.detail-jadwal', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal): View
    {
        Gate::authorize('update', $jadwal);           // BARU

        return view('jadwal.edit-jadwal', compact('jadwal'));
    }

    public function update(JadwalRequest $request, Jadwal $jadwal): RedirectResponse
    {
        Gate::authorize('update', $jadwal);           // BARU: wajib juga di sini, bukan hanya di edit()

        $data = $request->validated();
        unset($data['gambar']);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($jadwal->gambar);
            $data['gambar'] = $request->file('gambar')->store('gambar-jadwal', 'public');
        }

        $jadwal->update($data);

        return redirect()->route('jadwal.show', $jadwal)->with('sukses', 'Jadwal berhasil diperbarui.');
    }

    public function arsip(Jadwal $jadwal): RedirectResponse
    {
        Gate::authorize('update', $jadwal);           // BARU

        $jadwal->update(['is_archived' => true]);

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil diarsipkan.');
    }

    public function daftarArsip(Request $request): View   // DIUBAH: terima Request
    {
        Gate::authorize('create', Jadwal::class);     // BARU: halaman ini khusus komunitas

        $daftarJadwal = Jadwal::where('is_archived', true)
            ->where('id_komunitas', $this->idKomunitas($request))   // BARU: hanya arsip milik sendiri
            ->orderByDesc('tanggal_pelaksanaan')
            ->paginate(12);

        return view('jadwal.arsip-jadwal', compact('daftarJadwal'));
    }

    public function kembalikan(Jadwal $jadwal): RedirectResponse
    {
        Gate::authorize('update', $jadwal);           // BARU

        $jadwal->update(['is_archived' => false]);

        return redirect()->route('jadwal.daftar-arsip')->with('sukses', 'Jadwal berhasil dikembalikan.');
    }

    public function destroy(Jadwal $jadwal): RedirectResponse
    {
        Gate::authorize('update', $jadwal);           // BARU

        // Soft delete: file gambar sengaja tidak dihapus supaya data bisa direstore.
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil dihapus.');
    }

    /**
     * DIUBAH: id komunitas diambil dari komunitas yang sedang login.
     * Selalu dipanggil setelah Gate::authorize('create', ...), jadi user dipastikan komunitas.
     */
    private function idKomunitas(Request $request): string
    {
        return $request->user()->id_komunitas;
    }
    
}