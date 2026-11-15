{{-- Halaman detail jadwal --}}
@extends('layouts.app')

@section('konten')
    @include('jadwal.komponen.isi-detail', ['jadwal' => $jadwal])
@endsection
