<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// testing menubar
Route::get('/iwak',function(){
    return view('sites.halamanDokumentasi');
    
});
