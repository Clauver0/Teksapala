<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwal;

class DonasiController extends Controller
{
    public function index()
    {
        $jadwals = jadwal::all();
        return view('donasi.lihat-informasi-donasi', compact('jadwals'));
    }

    //
}
