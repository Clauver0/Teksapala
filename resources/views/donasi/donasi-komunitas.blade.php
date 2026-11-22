<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VERIFIKASI DONASI</title>
     <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/Donasi-bulanan.css', 'resources/js/Donasi/donasi.js'])
   <link rel="stylesheet" href="{{ asset('css/kirim-bukti-donasi.css') }}">
</head>
<body>
     <div class="donasi">
        @include('components.menubar')
        <img src="/icons/Donasi-welpapaer.jpeg" alt="donasi" class="donasi-img">
    </div>

    <div class="card" id="main-panel">
        <div class="card-header">VERIFIKASI DONASI</div>
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="list-pendonasi">
            @forelse ($donasis as $d)
                <div class="row-donasi">
                    <span class="nama">{{ $d->nama_donatur ?? '-' }}</span>

                    <span class="tanggal">
                        {{ \Carbon\Carbon::parse($d->waktu_donasi)->format('d/m/Y') }}
                    </span>

                    <span class="nominal">
                        Donasi: Rp {{ number_format($d->nominal_donasi, 0, ',', '.') }}
                    </span>

                    @if ($d->status_verifikasi === 'Terverifikasi')
                        <span class="badge badge-ok">terverifikasi</span>
                    @elseif ($d->status_verifikasi === 'Ditolak')
                        <span class="badge badge-tolak">ditolak</span>
                    @else
                        <span class="badge badge-pending">belum terverifikasi</span>
                    @endif

                    <span class="aksi">
                        <a href="{{ asset('storage/' . $d->bukti_donasi) }}" target="_blank">Bukti</a>

                        @if ($d->status_verifikasi === 'Pending')
                            <form method="POST" action="{{ route('donasi.verifikasi.update', $d->id_donasi) }}">
                                @csrf
                                @method('PATCH')
                                <button class="btn-terima" name="status_verifikasi" value="Terverifikasi">Terverifikasi</button>
                                <button class="btn-tolak" name="status_verifikasi" value="Ditolak">Tolak</button>
                            </form>
                        @endif
                    </span>
                </div>
            @empty
                <p>Belum ada data donasi.</p>
            @endforelse
        </div>
    </div> {{-- penutup .card --}}
    
</body>
</html>