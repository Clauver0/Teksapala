@extends('layouts.app')

@section('konten')
    @include('jadwal.komponen.form-jadwal', ['idKomunitas' => $id_komunitas])
@endsection
