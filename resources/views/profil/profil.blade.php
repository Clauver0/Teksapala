<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
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

            <h1 class="display-name">{{ $user->display_name ?? 'Belum Mengatur Nama' }}</h1>
            <p class="username">{{ $user->username }}</p>
        </div>

        {{-- Riwayat donasi: aktifkan lagi setelah model Donasi & tabelnya dibuat
        <div class="profile-divider"><span>Riwayat Donasi</span></div>
        <div class="donation-section">
            @forelse($user->donations as $donation)
                ...
            @empty
                <p>Belum ada riwayat donasi.</p>
            @endforelse
        </div>
        --}}

    </div>
</div>
</body>
</html>