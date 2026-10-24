<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller{
    public function tampilkanJadwal(){
        $jadwals = Jadwal::all();
        return view('sites.halaman-jadwal-penanaman', compact('jadwals'));
    }
}

?>