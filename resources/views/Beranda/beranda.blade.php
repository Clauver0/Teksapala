<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/menubar.css') }}">
    @vite(['resources/css/beranda.css'])
</head>
<body class="beranda-layout" style="background-image: url('{{ asset('icons/begroundberanda.jpg') }}');">

<div class="sidebar">
    <button class="sidebar-top-btn">&lt;&lt;</button>
    @include('components.menubar')
</div>

<div class="hehe-content">
    <h1 class="hehe-quote">
        "Donasi Anda, Menyelamatkan Bumi."
    </h1>
</div>

<div class="dashboard-panel">
    <!-- CARD DONASI -->
    <div class="dashboard-card">
        <div class="card-header-bar card-header-donasi">Donasi</div>
        <div class="card-body-content">
            <div class="stat-row">
                <span class="stat-label">Total</span>
                <span class="stat-value-large">Rp 700.000,00</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Partisipan</span>
                <span class="stat-value-large">366</span>
            </div>
            <hr class="card-divider">
            <div class="stat-label label-spacing">Peringkat</div>
            <table class="ranking-table">
                <tr>
                    <td>1. You</td>
                    <td class="text-right"><b>Rp 200.000,00</b></td>
                </tr>
                <tr>
                    <td>2. Joko Purnomo</td>
                    <td class="text-right">Rp 170.000,00</td>
                </tr>
                <tr>
                    <td>3. Levi Ackerman</td>
                    <td class="text-right">Rp 100.000,00</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- CARD JEJAK -->
    <div class="dashboard-card">
        <div class="card-header-bar card-header-jejak">Jejak</div>
        <div class="card-body-content">
            <div class="stat-row">
                <span class="stat-label">Tertanam</span>
                <span class="stat-value-large">133</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">Penyerapan CO₂</span>
                <span class="stat-value-large font-small">2,6 Ton</span>
            </div>
            <div class="stat-row margin-top-sm">
                <span class="stat-label">Dokumentasi</span>
                <a href="#" class="link-details">&gt;&gt; details</a>
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
                    <tr>
                        <td>12 May 2027</td>
                        <td>Bandung</td>
                        <td>Pinus</td>
                    </tr>
                    <tr>
                        <td>2 Nov 2027</td>
                        <td>Drini Beach</td>
                        <td>Mangrove</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>