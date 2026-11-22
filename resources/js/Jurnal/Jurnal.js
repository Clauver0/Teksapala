(function () {
    var modal = document.getElementById("modalHapus");
    if (!modal) return;

    var pesan = document.getElementById("modalPesan");
    var formTarget = null;

    function tutup() {
        modal.classList.remove("tampil");
        formTarget = null;
    }

    document.addEventListener("click", function (e) {
        var btn = e.target.closest(".btn-hapus");
        if (!btn) return;
        e.preventDefault();
        formTarget = btn.closest("form");
        pesan.textContent =
            'Apakah Anda yakin ingin menghapus jurnal "' +
            btn.dataset.judul +
            '"?';
        modal.classList.add("tampil");
    });

    document.getElementById("btnBatalHapus").addEventListener("click", tutup);

    document
        .getElementById("btnYaHapus")
        .addEventListener("click", function () {
            if (formTarget) formTarget.submit();
        });

    modal.addEventListener("click", function (e) {
        if (e.target === modal) tutup();
    });
})();
