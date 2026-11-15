{{-- Kartu satu jadwal. Pemakaian: @include('jadwal.komponen.kartu-jadwal', ['jadwal' => $jadwal]) --}}
<article class="kontainer">
    <div class="kontainer-gambar">
        <img src="{{ $jadwal->gambar }}" alt="Sampul kegiatan {{ $jadwal->judul }}" loading="lazy">
    </div>

    <div class="kontainer-informasi">
        <h3 class="judul">
            {{-- Link "stretched": seluruh kartu bisa diklik tanpa menumpuk <a> di dalam <a> --}}
            <a href="{{ route('jadwal.show', $jadwal) }}" class="tautan-kartu">{{ $jadwal->judul }}</a>
        </h3>

        @if ($jadwal->tanggal_pelaksanaan)
            <time class="waktu-pelaksanaan" datetime="{{ $jadwal->tanggal_pelaksanaan->toDateString() }}">
                {{ $jadwal->tanggal_pelaksanaan->translatedFormat('d F Y') }}
            </time>
        @endif

        @if ($jadwal->lokasi_pelaksanaan)
            <span class="lokasi-pelaksanaan">{{ $jadwal->lokasi_pelaksanaan }}</span>
        @endif

        <span class="status-pelaksanaan" data-status="{{ \Illuminate\Support\Str::slug($jadwal->status_pelaksanaan ?? '') }}">{{ $jadwal->status_pelaksanaan ?? '-' }}</span>
    </div>

    @include('jadwal.komponen.menu-kebab', ['jadwal' => $jadwal])
</article>
