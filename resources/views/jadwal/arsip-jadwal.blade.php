{{-- Halaman arsip: jadwal yang sudah diarsipkan. Dikembalikan lewat menu kebab ("Kembalikan"). --}}
@extends('layouts.app')

@section('judul-halaman', 'Arsip Jadwal')

@section('konten')
    <header class="kepala-halaman">
        <h1 class="judul-halaman">Arsip Jadwal</h1>
        <a href="{{ route('jadwal.index') }}" class="tombol-arsip">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M15 6l-6 6 6 6"/>
            </svg>
            <span>Kembali</span>
        </a>
    </header>

    <section class="daftar-jadwal">
        @forelse ($daftarJadwal as $jadwal)
            @include('jadwal.komponen.kartu-jadwal', ['jadwal' => $jadwal])
        @empty
            <p>Belum ada jadwal yang diarsipkan.</p>
        @endforelse
    </section>

    {{ $daftarJadwal->links('pagination::default') }}
@endsection

@push('scripts')
    <script src="{{ asset('js/kebab-menu.js') }}" defer></script>
@endpush