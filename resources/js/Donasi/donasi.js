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
const overlayBukti = document.getElementById("modal-overlay");
const panelUtama = document.getElementById("main-panel");

function openModal() {
    overlayBukti.classList.remove("hidden");
    overlayBukti.classList.add("flex");
    panelUtama.classList.add("blur-sm", "opacity-50");
}
function closeModal() {
    overlayBukti.classList.add("hidden");
    overlayBukti.classList.remove("flex");
    panelUtama.classList.remove("blur-sm", "opacity-50");
}

// timer mundur
let jam = 23,
    menit = 59,
    detik = 53;
const elTimer = document.getElementById("countdown-timer");
const timerBukti = setInterval(function () {
    if (detik > 0) {
        detik--;
    } else if (menit > 0) {
        menit--;
        detik = 59;
    } else if (jam > 0) {
        jam--;
        menit = 59;
        detik = 59;
    } else {
        clearInterval(timerBukti);
        elTimer.textContent = "Waktu Habis";
        return;
    }

    elTimer.textContent =
        String(jam).padStart(2, "0") +
        ":" +
        String(menit).padStart(2, "0") +
        ":" +
        String(detik).padStart(2, "0");
}, 1000);
