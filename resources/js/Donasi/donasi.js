document.addEventListener("click", function (e) {
    const tombol = e.target.closest(".qty-btn");
    if (!tombol) return;

    const angka = tombol.parentElement.querySelector(".qty-angka");
    let nilai = parseInt(angka.textContent);

    if (tombol.classList.contains("qty-plus")) {
        const sisa = parseInt(tombol.closest(".item-tanaman").dataset.sisa);
        if (nilai < sisa) nilai++;
    } else if (nilai > 0) {
        nilai--; // tidak boleh kurang dari 0
    }

    angka.textContent = nilai;
});
