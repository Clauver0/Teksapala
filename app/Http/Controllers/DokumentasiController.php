<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;

class DokumentasiController extends Controller{
    public function tampilkanDokumentasi(){
        $dokumentasis = Dokumentasi::all();
        return view('sites.halaman-dokumentasi', compact('dokumentasis'));
    }
}

?>