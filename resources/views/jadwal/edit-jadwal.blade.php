@extends('layouts.app')

@section('konten')
    <h1>Edit jadwal</h1>
    @include('jadwal.komponen.form-jadwal', ['jadwal' => $jadwal])
@endsection
