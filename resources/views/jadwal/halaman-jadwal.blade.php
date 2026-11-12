<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Jadwal Penanaman</title>
    
    <!-- Bootstrap CSS (via CDN / Vite / NPM) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/halaman-jadwal.css') }}">
</head>
<body>

    <!-- Menubar Component -->
    @include('jadwal.components.header')

    <main class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8">
                
                <!-- Filter / Header Tambahan jika diperlukan -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0">Jadwal Penanaman</h5>
                    <button class="btn btn-outline-secondary btn-sm">Filter Donasi ▾</button>
                </div>

                <!-- List Item Jadwal -->
                @include('jadwal.components.card-item', [
                    'title' => 'Penanaman Bibit Bakau Di Pantai Cemara',
                    'status' => 'SEDANG BERJALAN',
                    'statusClass' => 'sedang-berjalan',
                    'date' => '13 JAN 2027',
                    'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800'
                ])

                @include('jadwal.components.card-item', [
                    'title' => 'Penanaman Di Lahan Preservasi',
                    'status' => 'DITUNDA',
                    'statusClass' => 'ditunda',
                    'date' => '1 APR 2026',
                    'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800'
                ])

                @include('jadwal.components.card-item', [
                    'title' => 'Penanaman Bersama Komunitas Sakura',
                    'status' => 'SELESAI',
                    'statusClass' => 'selesai',
                    'date' => '2 JAN 2026',
                    'endDate' => '2 MAR 2026',
                    'image' => 'https://images.unsplash.com/photo-1522383225653-ed111181a951?w=800'
                ])

                @include('jadwal.components.card-item', [
                    'title' => 'Penanaman Di Kaliurang',
                    'status' => 'SELESAI',
                    'statusClass' => 'selesai',
                    'date' => '2 JAN 2026',
                    'endDate' => '2 MAR 2026',
                    'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800'
                ])

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>