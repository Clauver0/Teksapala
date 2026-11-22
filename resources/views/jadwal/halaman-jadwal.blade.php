{{-- Halaman list jadwal --}}
@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
@endpush
@section('konten')
    <header class="kepala-halaman">
        <h1 class="judul-halaman">Jadwal Penanaman</h1>
        <a href="{{ route('jadwal.daftar-arsip') }}" class="tombol-arsip">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="4" width="18" height="4" rx="1"/>
                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8"/>
                <path d="M10 12h4"/>
            </svg>
            <span>Arsip</span>
        </a>
    </header>

    <section class="daftar-jadwal">
        @forelse ($daftarJadwal as $jadwal)
            @include('jadwal.komponen.kartu-jadwal', ['jadwal' => $jadwal])
        @empty
            <p>Belum ada jadwal.</p>
        @endforelse
    </section>

    {{ $daftarJadwal->links('pagination::default') }}
@endsection

@push('scripts')
    <script src="{{ asset('js/kebab-menu.js') }}" defer></script>
@endpush