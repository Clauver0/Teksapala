{{-- Isi detail jadwal. Pemakaian: @include('jadwal.komponen.isi-detail', ['jadwal' => $jadwal]) --}}
<article class="jadwal-detail">
    @if ($jadwal->gambar_url)
        <img class="jadwal-detail-sampul" src="{{ $jadwal->gambar_url }}" alt="Sampul kegiatan {{ $jadwal->judul }}">
    @endif

    <div class="jadwal-detail-isi">
        <h2 class="jadwal-detail-judul">{{ $jadwal->judul }}</h2>

        <dl class="dok-meta">
            @if ($jadwal->tanggal_pelaksanaan)
                <div>
                    <dt>Tanggal</dt>
                    <dd>
                        <time datetime="{{ $jadwal->tanggal_pelaksanaan->toDateString() }}">
                            {{ $jadwal->tanggal_pelaksanaan->translatedFormat('d F Y') }}
                        </time>
                    </dd>
                </div>
            @endif
            @if ($jadwal->lokasi_pelaksanaan)
                <div>
                    <dt>Lokasi</dt>
                    <dd>{{ $jadwal->lokasi_pelaksanaan }}</dd>
                </div>
            @endif
            <div>
                <dt>Status</dt>
                <dd>{{ $jadwal->status_pelaksanaan ?? '-' }}</dd>
            </div>
        </dl>

        <h3 class="dok-section-label">Deskripsi</h3>
        <p class="dok-deskripsi">{{ $jadwal->deskripsi }}</p>

        @if ($jadwal->jadwalTanaman->isNotEmpty())
            <section class="jadwal-tanaman">
                <h3 class="dok-section-label">Tanaman yang akan ditanam</h3>
                <ul>
                    @foreach ($jadwal->jadwalTanaman as $jt)
                        <li class="jadwal-tanaman-item">
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

        <div class="jadwal-statistik">
            <div class="jadwal-stat">
                <p>Donasi</p>
                <strong>Rp {{ number_format($jadwal->total_donasi, 0, ',', '.') }}</strong>
            </div>
            <div class="jadwal-stat">
                <p>Peserta</p>
                <strong>{{ number_format($jadwal->jumlah_peserta ?? 0, 0, ',', '.') }}</strong>
            </div>
            <a href="{{ route('donasi.create', $jadwal) }}" class="jadwal-tombol-donasi">Donasi sekarang</a>
        </div>
    </div>
</article>
