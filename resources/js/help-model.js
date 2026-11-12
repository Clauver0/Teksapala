// Daftarkan fungsi ke window agar terbaca oleh atribut onclick di HTML
window.openHelpModal = function() {
    const modal = document.getElementById('helpModal');
    if (modal) {
        modal.style.display = 'flex';
    }
};

window.closeHelpModal = function() {
    const modal = document.getElementById('helpModal');
    if (modal) {
        modal.style.display = 'none';
    }
};

// Menutup modal jika area gelap di luar kotak diklik
window.addEventListener('click', function(event) {
    const modal = document.getElementById('helpModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Menutup modal dengan tombol Esc
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') window.closeHelpModal();
});