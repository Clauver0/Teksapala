document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalHapus");
    if (!modal) return;

    const pesan = document.getElementById("modalPesan");
    let formTarget = null;

    document.querySelectorAll(".btn-hapus").forEach((btn) => {
        btn.addEventListener("click", () => {
            formTarget = btn.closest("form");
            pesan.textContent =
                'Apakah Anda yakin ingin menghapus jurnal "' +
                btn.dataset.judul +
                '"?';
            modal.classList.add("tampil");
        });
    });

    document.getElementById("btnBatalHapus").addEventListener("click", () => {
        modal.classList.remove("tampil");
        formTarget = null;
    });

    document.getElementById("btnYaHapus").addEventListener("click", () => {
        if (formTarget) formTarget.submit();
    });

    // klik area gelap = tutup
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("tampil");
            formTarget = null;
        }
    });
});
