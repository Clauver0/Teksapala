function hitungTambah(a,b){
    return a+b;
}

document.addEventListener('DOMContentLoaded', () =>{
    const hasil = hitungTambah (5,10);

    const elemenHasil = document.getElementById('hasil-perhitungan');

    if(elemenHasil){
        elemenHasil.textContent = hasil;
    }
});