<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran dengan Bank - Teksapala</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/Donasi-bulanan.css'])
</head>

<body >

    <div class="bank-overlay" id="modalBank">
    <div class="bank-card">
        <div class="bank-header">Pembayaran dengan Bank</div>

        <div class="bank-body">
            @foreach ($banks as $namaBank => $rekening)
                <div class="bank-group">
                    <h4>Nomor Rekening Virtual {{ $namaBank }}</h4>

                    @foreach ($rekening as $jenis => $nomor)
                        <div class="bank-row">
                            <span class="bank-jenis">{{ $jenis }}</span>
                            <span class="bank-nomor">: {{ $nomor }}</span>
                            <a href="#" class="bank-salin" data-nomor="{{ $nomor }}">Salin</a>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="bank-actions">
                <a href="#" class="bank-kembali" id="tutupBank">Kembali</a>
            </div>
        </div>
    </div>
</div>

<script>
    const modalBank = document.getElementById('modalBank');

    function bukaBank()  { modalBank.classList.add('show'); }
    function tutupBank() { modalBank.classList.remove('show'); }

    document.getElementById('tutupBank').addEventListener('click', function (e) {
        e.preventDefault();
        tutupBank();
    });

    // klik area gelap di luar card juga menutup
    modalBank.addEventListener('click', function (e) {
        if (e.target === modalBank) tutupBank();
    });

    document.querySelectorAll('.bank-salin').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            navigator.clipboard.writeText(el.dataset.nomor).then(function () {
                const teks = el.textContent;
                el.textContent = 'Tersalin!';
                setTimeout(function () { el.textContent = teks; }, 1500);
            });
        });
    });
</script>
</body>
</html>