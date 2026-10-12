<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Document</title>
</head>
<body>
    <div class="main-layout" style="display: flex;">
        @include('components.menubar')

        <main style="padding: 20px; flex-grow: 1;">
            <h1>selamat datang di website kami!</h1>
            <p>Ini adalah area konten utama.</p>
        </main>
    </div>
</body>
</html>