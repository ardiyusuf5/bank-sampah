document.addEventListener('DOMContentLoaded', function () {
    const inputDisplay = document.getElementById('harga_display');
    const inputReal = document.getElementById('harga_real');

    if (inputDisplay && inputReal) {
        inputDisplay.addEventListener('input', function () {
            // Ambil angka murni tanpa titik/karakter lain
            let rawValue = this.value.replace(/\D/g, '');

            // Simpan angka murni ke hidden input (dikirim ke database)
            inputReal.value = rawValue;

            // Tampilkan format ribuan titik di layar pengguna
            if (rawValue) {
                this.value = new Intl.NumberFormat('id-ID').format(rawValue);
            } else {
                this.value = '';
            }
        });
    }
});
