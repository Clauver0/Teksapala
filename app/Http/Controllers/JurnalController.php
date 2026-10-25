<?php
namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
    $data = Jurnal::latest();

    if ($request->filled('cari')) {
        $data->where('judul_jurnal', 'like', '%' . $request->cari . '%');
    }

    $data1 = $data->get();

    return view('Jurnal.Jurnal-kelola', [
        'data1' => $data1,
        'Pesan' => $data1->isEmpty() ? 'Data jurnal tidak ditemukan' : null,
    ]);
}
        
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('Jurnal.Jurnal-input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'judul_jurnal'   => 'required|string|max:100',
        'jenis_tanaman'  => 'required|string|max:100',
        'deskripsi'      => 'nullable|string',
        'tanggal_jurnal' => 'required|date',
        'gambar'         => 'required|image|max:2048',
    ]);

    $data['gambar'] = $request->file('gambar')->store('jurnal', 'public');
    $data['id_komunitas'] = \Illuminate\Support\Facades\Auth::guard('komunitas')->user()->id_komunitas;

    Jurnal::create($data);

    return redirect()->route('jurnals.index')->with('success', 'Jurnal berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Jurnal $jurnal)
    {
          return view('jurnals.show', compact('jurnal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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
        'gambar'         => 'required|image|max:2048',
    ]);

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

    $jurnal->delete();

    return redirect()->route('jurnals.index');
}
    

}  
