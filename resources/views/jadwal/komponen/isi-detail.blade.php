{{-- Isi detail jadwal. Pemakaian: @include('jadwal.komponen.isi-detail', ['jadwal' => $jadwal]) --}}
<div class="header">
    <img src="{{ $jadwal->gambar }}" alt="Sampul kegiatan {{ $jadwal->judul }}">
</div>

<div class="kontainer-isi">
    <h1>{{ $jadwal->judul }}</h1>
    @if ($jadwal->lokasi_pelaksanaan)
        <p class="lokasi-pelaksanaan">{{ $jadwal->lokasi_pelaksanaan }}</p>
    @endif
    <p>{{ $jadwal->deskripsi }}</p>

    @if ($jadwal->jadwalTanaman->isNotEmpty())
        <section class="kontainer-tanaman">
            <h2>Tanaman yang akan ditanam</h2>
            <ul>
                @foreach ($jadwal->jadwalTanaman as $jt)
                    <li class="item-tanaman">
                        <img src="{{ $jt->tanaman->gambar }}" alt="{{ $jt->tanaman->nama_tanaman }}" width="64" height="64" loading="lazy">
                        <div>
                            <strong>{{ $jt->tanaman->nama_tanaman }}</strong>
                            <span>Rp {{ number_format($jt->harga, 0, ',', '.') }} / bibit</span>
                            <progress max="{{ $jt->kouta }}" value="{{ $jt->terdonasi }}"></progress>
                            <small>{{ $jt->terdonasi }} dari {{ $jt->kouta }} bibit terdonasi</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <div class="kontainer-statistik">
        <div class="kontainer-jumlah-terdonasi">
            <p>Donasi</p>
            <strong>Rp {{ number_format($jadwal->total_donasi, 0, ',', '.') }}</strong>
        </div>

        <div class="kontainer-jumlah-peserta">
            <p>Peserta</p>
            <strong>{{ number_format($jadwal->jumlah_peserta ?? 0, 0, ',', '.') }}</strong>
        </div>

        <a href="{{ route('donasi.create', $jadwal) }}" class="tombol-donasi">Donasi sekarang</a>

        @if ($jadwal->tanggal_pelaksanaan)
            <p class="waktu-pelaksanaan">
                Dilaksanakan pada:<br>
                <time datetime="{{ $jadwal->tanggal_pelaksanaan->toDateString() }}">
                    {{ $jadwal->tanggal_pelaksanaan->translatedFormat('d F Y') }}
                </time>
            </p>
        @endif
    </div>
</div>
