<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    @vite(['resources/css/beranda.css'])
</head>
<body class="beranda-layout" style="background-image: url('{{ asset('icons/begroundberanda.jpeg') }}');">

<div class="sidebar">
    @include('components.menubar')
</div>

<div class="hehe-content">
    <h1 class="hehe-quote">
        "Donasi Anda, Menyelamatkan<br>Bumi."
    </h1>
</div>

<div class="kartu-donasi">
    <!-- CARD DONASI -->
    <div class="dashboard-card">
        <div class="card-header-bar card-header-donasi">Donasi</div>
        <div class="card-body-content">
            <div class="stat-row">
                <span class="stat-label">Total</span>
                <span class="stat-value-large">
                    Rp {{ number_format($totalDonasi ?? 0, 2, ',', '.') }}
                </span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Partisipan</span>
                <span class="stat-value-large">{{ $jumlahPartisipan ?? 0 }}</span>
                <img src="{{ asset('icons/donatur.png') }}" class="stat-label" alt="Partisipan">
            </div>
            <hr class="card-divider">
            <div class="stat-label label-spacing">Peringkat</div>
            <table class="ranking-table">
                @forelse($peringkat ?? [] as $item)
                    <tr>
                        <td>{{ $item['rank'] }}. {{ $item['nama'] }}</td>
                        <td class="text-right">
                            @if($item['is_you'])
                                <b>Rp {{ number_format($item['nominal'], 2, ',', '.') }}</b>
                            @else
                                Rp {{ number_format($item['nominal'], 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Belum ada data peringkat donatur.</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    <!-- CARD JEJAK -->
    <div class="dashboard-card">
        <div class="card-header-bar card-header-jejak">Jejak</div>
        <div class="card-body-content">
            <div class="stat-row">
                <span class="stat-label">Tertanam</span>
                <span class="stat-value-large">{{ $totalTertanam ?? 0 }}</span>
                <img src="{{ asset('icons/tanaman.png') }}" class="stat-label" alt="Tertanam">
            </div>
            <div class="stat-row">
                <span class="stat-label">Penyerapan CO₂</span>
                <span class="stat-value-large font-small">
                    {{ number_format($penyerapanCo2 ?? 0, 2, ',', '.') }} Ton
                </span>
                <img src="{{ asset('icons/wind.png') }}" class="stat-label" alt="Penyerapan CO₂">
            </div>
            <div class="stat-row margin-top-sm">
                <span class="stat-label">Dokumentasi</span>
                <a href="{{ \Illuminate\Support\Facades\Route::has('dokumentasi.index') ? route('dokumentasi.index') : '#' }}"
                   class="link-details">&gt;&gt; details</a>
            </div>
        </div>
    </div>

    <!-- CARD JADWAL -->
    <div class="dashboard-card">
        <div class="card-header-bar card-header-jadwal">Jadwal</div>
        <div class="card-body-content">
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Tanaman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals ?? [] as $jadwal)
                        <tr>
                            <td>{{ $jadwal['tanggal'] }}</td>
                            <td>{{ $jadwal['lokasi'] }}</td>
                            <td>{{ $jadwal['tanaman'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Belum ada jadwal penanaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>