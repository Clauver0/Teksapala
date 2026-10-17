<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>

    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>

<body>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="profile-header">
        <a href="{{ route('profil') }}" class="back-btn">← Kembali</a>

        <img id="headerPreview"
             src="{{ $user->header_img ? asset('storage/' . $user->header_img) : asset('img/background.png') }}"
             alt="Header">

        <label for="headerInput" class="edit-header-btn">📷</label>
        <input id="headerInput" type="file" name="header_img" accept="image/*" hidden>
    </div>

    <div class="profile-info">
        <div class="profile-photo-wrapper">
            <img id="profilePreview"
                 src="{{ $user->profile_img ? asset('storage/' . $user->profile_img) : asset('img/default-profile.png') }}"
                 class="profile-photo" alt="Profile">

            <label for="profileInput" class="edit-profile-btn">📷</label>
            <input id="profileInput" type="file" name="profile_img" accept="image/*" hidden>
        </div>

        <div class="name-edit-section">
            <label>Display Name</label>
            <input type="text" name="display_name" class="display-input"
                   value="{{ old('display_name', $user->display_name) }}">
        </div>

        <p class="username">{{ $user->username }}</p>
    </div>

    <div class="save-section">
        <button type="submit" class="save-btn">Simpan Perubahan</button>
    </div>
</form>
<script>
    const headerInput = document.getElementById('headerInput');
    const headerPreview = document.getElementById('headerPreview');

    headerInput.addEventListener('change', function () {

        const file = this.files[0];

        if(file){
            headerPreview.src = URL.createObjectURL(file);
        }

    });

    const profileInput = document.getElementById('profileInput');
    const profilePreview = document.getElementById('profilePreview');

    profileInput.addEventListener('change', function () {

        const file = this.files[0];

        if(file){
            profilePreview.src = URL.createObjectURL(file);
        }

    });
</script>
</body>
</html>