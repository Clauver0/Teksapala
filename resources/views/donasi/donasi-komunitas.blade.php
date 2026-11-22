<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi - Admin Komunitas</title>
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokumentasi.css') }}">
    <style>
        .donasi-table-wrap {
            background: #ffffff;
            border-radius: 12px;
            padding: 16px;
            overflow-x: auto;
            box-shadow: 0 2px 10px rgba(89, 64, 25, 0.08);
        }
        .donasi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .donasi-table th,
        .donasi-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5dfd5;
            text-align: left;
            vertical-align: middle;
        }
        .donasi-table th {
            background: #f6f1e9;
            color: #594019;
            font-weight: 700;
        }
        .badge-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
        }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-verified { background: #dcfce7; color: #166534; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        .aksi-group {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }
    </style>
</head>
<body class="dok-layout"
      style="background-image: url('{{ asset('img/background-riwayat.png') }}');">

<div class="sidebar">
    @include('components.menubar')
</div>

<main class="dok-panel">
    <header class="dok-panel-header">
        <a class="dok-back" href="{{ route('beranda') }}">Kembali</a>
        <h1>Riwayat Donasi User</h1>
    </header>

    <div class="dok-panel-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="donasi-table-wrap">
            <table class="donasi-table">
                <thead>
                    <tr>
                        <th>Display Name</th>
                        <th>Nominal</th>
                        <th>Metode</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donasis as $donasi)
                        @php
                            $namaTampil = $donasi->donatur?->display_name
                                ?: ($donasi->donatur?->nama_lengkap ?: ($donasi->donatur?->username ?? '-'));

                            $jadwalList = $donasi->detailDonasis
                                ->map(fn ($d) => $d->jadwalTanaman?->jadwal?->judul
                                    ?? $d->jadwalTanaman?->jadwal?->lokasi_pelaksanaan)
                                ->filter()
                                ->unique()
                                ->values();
                        @endphp
                        <tr>
                            <td><strong>{{ $namaTampil }}</strong></td>
                            <td>Rp {{ number_format((float) $donasi->nominal_donasi, 0, ',', '.') }}</td>
                            <td>{{ $donasi->metode_donasi }}</td>
                            <td>
                                @if ($jadwalList->isNotEmpty())
                                    {{ $jadwalList->implode(', ') }}
                                @else
                                    <em>Donasi Sukarela</em>
                                @endif
                            </td>
                            <td>
                                @if ($donasi->status_verifikasi === 'Terverifikasi')
                                    <span class="badge-status badge-verified">Terverifikasi</span>
                                @elseif ($donasi->status_verifikasi === 'Ditolak')
                                    <span class="badge-status badge-rejected">Ditolak</span>
                                @else
                                    <span class="badge-status badge-pending">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="aksi-group">
                                    <a href="{{ route('komunitas.donasi.detail', $donasi->id_donasi) }}"
                                       class="btn-action btn-detail">
                                        Detail
                                    </a>

                                    @if ($donasi->status_verifikasi !== 'Terverifikasi')
                                        <form action="{{ route('komunitas.donasi.verifikasi', $donasi->id_donasi) }}"
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status_verifikasi" value="Terverifikasi">
                                            <button type="submit" class="btn-action btn-create">
                                                Verifikasi
                                            </button>
                                        </form>
                                    @endif

                                    @if ($donasi->status_verifikasi !== 'Ditolak')
                                        <form action="{{ route('komunitas.donasi.verifikasi', $donasi->id_donasi) }}"
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status_verifikasi" value="Ditolak">
                                            <button type="submit" class="btn-action btn-delete">
                                                Tolak
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="dok-empty">Belum ada data riwayat donasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>