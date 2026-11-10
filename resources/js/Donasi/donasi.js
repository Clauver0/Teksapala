/* ===== Tombol jumlah (+ / -) ===== */
document.addEventListener("click", function (e) {
    const tombol = e.target.closest(".qty-btn");
    if (!tombol) return;

    const angka = tombol.parentElement.querySelector(".qty-angka");
    let nilai = parseInt(angka.textContent);

    if (tombol.classList.contains("qty-plus")) {
        const sisa = parseInt(tombol.closest(".item-tanaman").dataset.sisa);
        if (nilai < sisa) nilai++;
    } else if (nilai > 0) {
        nilai--;
    }

    angka.textContent = nilai;
});

/* ===== Modal bukti pembayaran ===== */
const overlayBukti = document.getElementById("modal-overlay");
const panelUtama = document.getElementById("main-panel");

function openModal() {
    if (!overlayBukti) return;
    overlayBukti.classList.add("active");
    panelUtama?.classList.add("blur-effect");
}

function closeModal() {
    if (!overlayBukti) return;
    overlayBukti.classList.remove("active");
    panelUtama?.classList.remove("blur-effect");
}

window.openModal = openModal;
window.closeModal = closeModal;

/* ===== Helper modal Bank & QRIS (class "show") ===== */
function pasangModal(idModal, idTombolLanjut) {
    const modal = document.getElementById(idModal);
    if (!modal) return { buka() {}, tutup() {} };

    const buka = () => modal.classList.add("show");
    const tutup = () => modal.classList.remove("show");

    // Lanjutkan -> tutup modal ini, buka modal bukti
    document.getElementById(idTombolLanjut)?.addEventListener("click", (e) => {
        e.preventDefault();
        tutup();
        openModal();
    });

    // klik area gelap di luar kartu -> hanya tutup
    modal.addEventListener("click", (e) => {
        if (e.target === modal) tutup();
    });

    return { buka, tutup };
}

const bank = pasangModal("modalBank", "lanjutBank");
const qris = pasangModal("modalQRIS", "lanjutQris");

window.bukaBank = bank.buka;
window.tutupBank = bank.tutup;
window.bukaQris = qris.buka;
window.tutupQris = qris.tutup;

/* ===== Salin nomor rekening ===== */
document.querySelectorAll(".bank-salin").forEach(function (el) {
    el.addEventListener("click", function (e) {
        e.preventDefault();
        navigator.clipboard.writeText(el.dataset.nomor).then(function () {
            const teks = el.textContent;
            el.textContent = "Tersalin!";
            setTimeout(() => (el.textContent = teks), 1500);
        });
    });
});

/* ===== Timer mundur ===== */
const elTimer = document.getElementById("countdown-timer");

if (elTimer) {
    let jam = 23,
        menit = 59,
        detik = 53;

    const timerBukti = setInterval(function () {
        if (detik > 0) detik--;
        else if (menit > 0) {
            menit--;
            detik = 59;
        } else if (jam > 0) {
            jam--;
            menit = 59;
            detik = 59;
        } else {
            clearInterval(timerBukti);
            elTimer.textContent = "Waktu Habis";
            elTimer.style.color = "#dc2626";
            return;
        }

        elTimer.textContent =
            String(jam).padStart(2, "0") +
            ":" +
            String(menit).padStart(2, "0") +
            ":" +
            String(detik).padStart(2, "0");
    }, 1000);
}
