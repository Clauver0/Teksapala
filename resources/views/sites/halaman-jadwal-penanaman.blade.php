<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['public/css/menubar.css', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <title>Jadwal Penanaman</title>
</head>
<body>
    @include('components.formulir-jadwal')
</body>
</html>