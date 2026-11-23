<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
</head>
<body>
<div class="container">
    @include('components.menubar')

    <div class="main-content">

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <!-- Header -->
        <div class="profile-header">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>

            <img src="{{ $user->header_img ? asset('storage/' . $user->header_img) : asset('img/background.png') }}"
                 alt="Header Image" width="100%" height="250">
        </div>

        <!-- Info profil -->
        <div class="profile-info">
            <div class="profile-photo-wrapper">
                @if($user->profile_img)
                    <img src="{{ asset('storage/' . $user->profile_img) }}"
                         alt="Profile Image" class="profile-photo">
                @else
                    <div class="profile-placeholder">👤</div>
                @endif

                <a href="{{ route('profil.edit') }}" class="edit-profile-btn">✏️</a>
            </div>

            <h1 class="display-name">{{ $user->display_name ?? $user->nama_komunitas ?? 'Belum Mengatur Nama' }}</h1>
            <p class="username">{{ $user->username }}</p>
        </div>

        @php
            $donations = $user->donations ?? collect();
        @endphp

        <!-- Riwayat Donasi User -->
        <div class="profile-divider"><span>Riwayat Donasi</span></div>
        <div class="donation-section">
            @forelse($donations as $donation)
                @php
                    $status = $donation->status_verifikasi ?? 'Pending';
                    $namaTampil = $user->display_name ?: ($user->nama_lengkap ?: ($user->nama_komunitas ?? ($user->username ?? '-')));

                    $detailItems = $donation->relationLoaded('detailDonasis')
                        ? $donation->detailDonasis->map(function ($detail) {
                            $namaTanaman = $detail->jadwalTanaman?->tanaman?->nama_tanaman ?? 'Tanaman';
                            $jadwalInfo = $detail->jadwalTanaman?->jadwal?->judul
                                ?? $detail->jadwalTanaman?->jadwal?->lokasi_pelaksanaan
                                ?? '-';
                            return [
                                'nama_tanaman' => $namaTanaman,
                                'jumlah'       => (int) $detail->jumlah_tanaman,
                                'jadwal'       => $jadwalInfo,
                            ];
                        })->values()
                        : collect();

                    $itemRingkasan = $detailItems->map(fn ($i) => "{$i['nama_tanaman']} ({$i['jumlah']})");
                    $buktiUrl = $donation->bukti_donasi ? asset('storage/' . $donation->bukti_donasi) : '';
                @endphp

                <div class="donation-card">
                    <div class="donation-card-top">
                        <div>
                            <div class="donation-nominal">
                                Rp {{ number_format((float) $donation->nominal_donasi, 0, ',', '.') }}
                            </div>
                            <div class="donation-meta">
                                {{ $donation->metode_donasi }} &bull;
                                {{ \Carbon\Carbon::parse($donation->waktu_donasi)->translatedFormat('d M Y H:i') }}
                            </div>
                        </div>

                        @if($status === 'Terverifikasi')
                            <span class="verif-badge verif-verified">✓ Terverifikasi</span>
                        @elseif($status === 'Ditolak')
                            <span class="verif-badge verif-rejected">✕ Ditolak</span>
                        @else
                            <span class="verif-badge verif-pending">⏳ Belum Terverifikasi (Pending)</span>
                        @endif
                    </div>

                    @if($itemRingkasan->isNotEmpty())
                        <div class="donation-items">
                            <strong>Tanaman:</strong> {{ $itemRingkasan->implode(', ') }}
                        </div>
                    @else
                        <div class="donation-items">
                            <strong>Jenis:</strong> Donasi Sukarela
                        </div>
                    @endif

                    <div class="donation-card-actions">
                        <button type="button"
                                class="btn-detail-popup js-open-donation-modal"
                                data-id="{{ $donation->id_donasi }}"
                                data-donatur="{{ $namaTampil }}"
                                data-nominal="Rp {{ number_format((float) $donation->nominal_donasi, 0, ',', '.') }}"
                                data-metode="{{ $donation->metode_donasi }}"
                                data-waktu="{{ \Carbon\Carbon::parse($donation->waktu_donasi)->translatedFormat('d F Y H:i') }}"
                                data-status="{{ $status }}"
                                data-bukti="{{ $buktiUrl }}"
                                data-items='@json($detailItems)'>
                            Detail
                        </button>
                    </div>
                </div>
            @empty
                <p class="donation-empty">Belum ada riwayat donasi.</p>
            @endforelse
        </div>

        <!-- Pop-up Modal Detail Donasi User -->
        <div class="don-modal-backdrop" id="donationDetailModal" role="dialog" aria-modal="true" aria-labelledby="donModalTitle" aria-hidden="true">
            <div class="don-modal-card">
                <div class="don-modal-header">
                    <h2 class="don-modal-title" id="donModalTitle">Rincian Donasi</h2>
                    <button type="button" class="don-modal-close" id="closeDonationModal" aria-label="Tutup pop-up">&times;</button>
                </div>

                <div class="don-modal-body">
                    <dl class="don-modal-meta">
                        <div>
                            <dt>ID Donasi</dt>
                            <dd id="modalDonId">-</dd>
                        </div>
                        <div>
                            <dt>Donatur</dt>
                            <dd id="modalDonDonatur">-</dd>
                        </div>
                        <div>
                            <dt>Nominal</dt>
                            <dd><strong id="modalDonNominal">-</strong></dd>
                        </div>
                        <div>
                            <dt>Metode</dt>
                            <dd id="modalDonMetode">-</dd>
                        </div>
                        <div>
                            <dt>Waktu</dt>
                            <dd id="modalDonWaktu">-</dd>
                        </div>
                        <div>
                            <dt>Status</dt>
                            <dd id="modalDonStatus">-</dd>
                        </div>
                    </dl>

                    <div class="don-modal-section">
                        <h3>Jadwal &amp; Tanaman yang Didonasikan</h3>
                        <ul class="don-modal-items" id="modalDonItems"></ul>
                    </div>

                    <div class="don-modal-section">
                        <h3>Foto Bukti Pembayaran</h3>
                        <div id="modalDonBuktiWrap"></div>
                    </div>
                </div>

                <div class="don-modal-footer">
                    <button type="button" class="don-modal-btn-close" id="closeDonationModalFooter">Tutup</button>
                </div>
            </div>
        </div>

        <script>
        (() => {
            const modal = document.getElementById('donationDetailModal');
            const closeBtn = document.getElementById('closeDonationModal');
            const closeFooterBtn = document.getElementById('closeDonationModalFooter');

            const elId = document.getElementById('modalDonId');
            const elDonatur = document.getElementById('modalDonDonatur');
            const elNominal = document.getElementById('modalDonNominal');
            const elMetode = document.getElementById('modalDonMetode');
            const elWaktu = document.getElementById('modalDonWaktu');
            const elStatus = document.getElementById('modalDonStatus');
            const elItems = document.getElementById('modalDonItems');
            const elBuktiWrap = document.getElementById('modalDonBuktiWrap');

            function formatStatusLabel(status) {
                if (status === 'Terverifikasi') return '✓ Terverifikasi';
                if (status === 'Ditolak') return '✕ Ditolak';
                return '⏳ Belum Terverifikasi (Pending)';
            }

            function openModal(btn) {
                const data = btn.dataset;

                elId.textContent = data.id || '-';
                elDonatur.textContent = data.donatur || '-';
                elNominal.textContent = data.nominal || '-';
                elMetode.textContent = data.metode || '-';
                elWaktu.textContent = data.waktu || '-';
                elStatus.textContent = formatStatusLabel(data.status || 'Pending');

                let items = [];
                try {
                    items = JSON.parse(data.items || '[]');
                } catch (err) {
                    items = [];
                }

                elItems.innerHTML = '';
                if (Array.isArray(items) && items.length > 0) {
                    items.forEach((item) => {
                        const li = document.createElement('li');
                        li.innerHTML = `<strong>${item.nama_tanaman}</strong> — ${item.jumlah} pohon <em>(Jadwal: ${item.jadwal})</em>`;
                        elItems.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.className = 'don-modal-empty';
                    li.textContent = 'Donasi sukarela (tidak terikat item tanaman tertentu).';
                    elItems.appendChild(li);
                }

                elBuktiWrap.innerHTML = '';
                if (data.bukti) {
                    const img = document.createElement('img');
                    img.src = data.bukti;
                    img.alt = `Bukti donasi ${data.id || ''}`;
                    img.className = 'don-modal-bukti-img';
                    elBuktiWrap.appendChild(img);
                } else {
                    const p = document.createElement('p');
                    p.className = 'don-modal-empty';
                    p.textContent = 'Tidak ada file bukti donasi.';
                    elBuktiWrap.appendChild(p);
                }

                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
                closeBtn.focus();
            }

            function closeModal() {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
            }

            document.querySelectorAll('.js-open-donation-modal').forEach((btn) => {
                btn.addEventListener('click', () => openModal(btn));
            });

            closeBtn.addEventListener('click', closeModal);
            closeFooterBtn.addEventListener('click', closeModal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                    closeModal();
                }
            });
        })();
        </script>

    </div>
</div>
</body>
</html>