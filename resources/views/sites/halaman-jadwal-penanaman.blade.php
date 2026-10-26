<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Jadwal Penanaman</title>
</head>


<body>
    <table>
    <tr>
        <td>
            @include('components.menubar')
        </td>
        <td>
            <div class="container">
                @foreach ($jadwals as $jadwal )
                    @include('components.jadwal-container')
                @endforeach
            </div>
        </td>
    </table>

    <table>
        @foreach($jadwals as $jadwal)
        <tr>
            @include('components.detail-jadwal') <br>
        </tr>
        @endforeach
        <tr>
            @include('components.formulir-jadwal')
        </tr>
    </table>

    

</body>
</html>