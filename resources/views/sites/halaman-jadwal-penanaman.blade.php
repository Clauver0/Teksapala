<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Penanaman</title>
</head>
<body>
    <!-- @include('components.formulir-jadwal') -->
     <div class="container">
        @foreach ($jadwals as $jadwal )
            @include('components.jadwal-container')
        @endforeach
        
     </div>
</body>
</html>