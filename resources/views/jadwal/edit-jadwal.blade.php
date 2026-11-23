@extends('layouts.app')

@section('judul-halaman', 'Sunting Jadwal - Teksapala')

@section('kepala')
    <header class="dok-panel-header">
        <a class="dok-back" href="{{ route('jadwal.show', $jadwal) }}" aria-label="Kembali ke detail jadwal">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1>Sunting Jadwal</h1>
    </header>
@endsection

@section('konten')
    @include('jadwal.komponen.form-jadwal', ['jadwal' => $jadwal])
@endsection
