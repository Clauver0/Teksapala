<?php
namespace App\Http\Controllers;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class JurnalController extends Controller
{
// ==========================BAGIAN MENCARI JURNAL ( MENU EDIT)===================================
    public function index(Request $request){
   $data = Jurnal::latest('id_jurnal');

    if ($request->filled('cari')) {
        $data->where('judul_jurnal', 'like', '%' . $request->cari . '%');
    }

    $data1 = $data->get();

    return view('Jurnal.Jurnal-kelola', [
        'data1' => $data1,
        'Pesan' => $data1->isEmpty() ? 'Data jurnal tidak ditemukan' : null,
    ]);
}
//==================================================================================================
    

//=======================BAGIAN UNTUK MENAMPILKAN HALAMAN JURNAL INPUT============================
    public function create()
    {
           return view('Jurnal.Jurnal-input');
    }




public function store(Request $request)
{
    $data = $request->validate([
        'judul_jurnal'   => 'required|string|max:100',
        'jenis_tanaman'  => 'required|string|max:100',
        'deskripsi'      => 'nullable|string',
        'tanggal_jurnal' => 'required|date',
        'gambar'         => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('jurnal', 'public');
    }

    // Mengambil ID komunitas dari tabel komunitas
    $komunitas = \App\Models\Komunitas::first();

    if (!$komunitas) {
        return back()->with('error', 'Data komunitas belum tersedia.');
    }

    $data['id_komunitas'] = $komunitas->id_komunitas;

    Jurnal::create($data);

    return redirect()->route('jurnals.index')
        ->with('success', 'Jurnal berhasil ditambahkan.');
}
   


    public function show(Jurnal $jurnal)
    {
          return view('jurnals.show', compact('jurnal'));
    }

  
    // =========================BAGIAN JURNAL EDIT
    public function edit(Jurnal $jurnal)
    {
        return view('Jurnal.Jurnal-edit', compact('jurnal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
         $data = $request->validate([
        'judul_jurnal'   => 'required|string|max:100',
        'jenis_tanaman'  => 'required|string|max:100',
        'deskripsi'      => 'nullable|string',
        'tanggal_jurnal' => 'required|date',
        'gambar'         => 'nullable|image|max:2048',
    ]);

       if ($request->hasFile('gambar')) {
            if ($jurnal->gambar) {
                Storage::disk('public')->delete($jurnal->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jurnal', 'public');
        }
        $jurnal->update($data);

        return redirect()
            ->route('jurnals.index')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurnal $jurnal)
    {
 if ($jurnal->gambar) {
            Storage::disk('public')->delete($jurnal->gambar);
        }
    $jurnal->delete();

    return redirect()->route('jurnals.index');
}
    

}  
