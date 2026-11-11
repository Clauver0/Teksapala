<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/halaman-jadwal.css') }}">
</head>
<body>

    @include('jadwal.components.header')

    <main class="container my-5">
        <div class="card p-4 mx-auto" style="max-width: 600px;">
            <h4 class="fw-bold mb-3">Formulir Jadwal Penanaman</h4>
            <!-- Form dummy dapat ditambahkan di sini -->
            <p class="text-muted">Halaman formulir penambahan / pengeditan jadwal.</p>
        </div>
    </main>

</body>
</html>