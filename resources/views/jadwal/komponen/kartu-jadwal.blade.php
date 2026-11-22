{{-- Kartu satu jadwal. Pemakaian: @include('jadwal.komponen.kartu-jadwal', ['jadwal' => $jadwal]) --}}
@php
    $status = $jadwal->status_pelaksanaan ?? '-';
    $slugStatus = \Illuminate\Support\Str::slug($jadwal->status_pelaksanaan ?? '');
@endphp

<article class="jadwal-kartu"
    @if ($jadwal->gambar_url)
        style="background-image: url('{{ $jadwal->gambar_url }}');"
    @endif>
    <a href="{{ route('jadwal.show', $jadwal) }}" class="jadwal-kartu-tautan" aria-label="Lihat detail {{ $jadwal->judul }}"></a>

    <div class="jadwal-kartu-overlay">
        <h2 class="jadwal-kartu-judul">{{ $jadwal->judul }}</h2>

        <p class="jadwal-kartu-meta">
            <span class="jadwal-status" data-status="{{ $slugStatus }}">{{ $status }}</span>
            @if ($jadwal->tanggal_pelaksanaan)
                <time datetime="{{ $jadwal->tanggal_pelaksanaan->toDateString() }}">
                    {{ $jadwal->tanggal_pelaksanaan->translatedFormat('d F Y') }}
                </time>
            @endif
        </p>

        @if ($jadwal->lokasi_pelaksanaan)
            <p class="jadwal-kartu-lokasi">{{ $jadwal->lokasi_pelaksanaan }}</p>
        @endif
    </div>

    @if (Auth::guard('komunitas')->check() && Auth::guard('komunitas')->user()->can('update', $jadwal))
        @include('jadwal.komponen.menu-kebab', ['jadwal' => $jadwal])
    @endif
</article>
