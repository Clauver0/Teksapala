<?php

namespace App\Http\Controllers;

use App\Models\DetailDonasi;
use App\Http\Requests\StoreDetailDonasiRequest;
use App\Http\Requests\UpdateDetailDonasiRequest;

class DetailDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailDonasis = DetailDonasi::all();
        return view('donasi.detail-index', compact('detailDonasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donasi.detail-create');
    }

    
    public function store(StoreDetailDonasiRequest $request)
    {
       DetailDonasi::create($request->validated());
        return redirect()->back()->with('selesai', 'Detail donasi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailDonasi $detailDonasi)
    {
        return view('donasi.detail-show', compact('detailDonasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailDonasi $detailDonasi)
    {
        return view('donasi.detail-edit', compact('detailDonasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailDonasiRequest $request, DetailDonasi $detailDonasi)
    {
        $detailDonasi->update($request->validated());
        return redirect()->back()->with('success', 'Detail donasi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailDonasi $detailDonasi)
    {
       $detailDonasi->delete();
        return redirect()->back()->with('success', 'Detail donasi berhasil dihapus!');
    }
}
