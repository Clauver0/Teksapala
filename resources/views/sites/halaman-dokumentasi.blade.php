<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['public/css/menubar.css', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <title>Document</title>
</head>
<body>
    <div class="main-layout" style="display: flex;">
        @include('components.menubar')

    </div>
</body>
</html>