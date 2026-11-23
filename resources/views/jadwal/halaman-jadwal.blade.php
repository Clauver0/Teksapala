{{-- Halaman list jadwal --}}
@extends('layouts.app')

@section('judul-halaman', 'Jadwal Penanaman - Teksapala')

@section('kepala')
    <header class="dok-panel-header">
        <a class="dok-back" href="{{ route('beranda') }}" aria-label="Kembali ke beranda">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1>Jadwal Penanaman</h1>
        @auth('komunitas')
            <a href="{{ route('jadwal.daftar-arsip') }}" class="jadwal-tautan-header">Arsip</a>
        @endauth
    </header>
@endsection

@section('konten')
    <section class="daftar-jadwal">
        @forelse ($daftarJadwal as $jadwal)
            @include('jadwal.komponen.kartu-jadwal', ['jadwal' => $jadwal])
        @empty
            <p class="dok-empty">Belum ada jadwal.</p>
        @endforelse
    </section>

    {{ $daftarJadwal->links('pagination::default') }}
@endsection

@auth('komunitas')
    @section('kaki')
        <footer class="dok-panel-footer">
            <a href="{{ route('jadwal.create') }}" class="btn-kelola-dok">Tambah Jadwal</a>
        </footer>
    @endsection
@endauth

@push('scripts')
    <script src="{{ asset('js/kebab-menu.js') }}" defer></script>
@endpush
