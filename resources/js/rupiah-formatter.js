/**
 * Global Rupiah Formatter
 *
 * Fungsi:
 * - Memformat angka menjadi format Indonesia: 123.456.789
 * - Menghapus separator sebelum form dikirim
 * - Bekerja pada input dengan atribut [data-rupiah]
 */

function formatRupiahValue(value) {
    const numericValue = String(value ?? '').replace(/\D/g, '');

    if (numericValue === '') {
        return '';
    }

    return new Intl.NumberFormat('id-ID').format(Number(numericValue));
}

function initializeRupiahFormatter() {
    const inputs = document.querySelectorAll('[data-rupiah]');

    inputs.forEach((input) => {

        // Hindari event listener ganda
        if (input.dataset.rupiahInitialized === 'true') {
            return;
        }

        input.dataset.rupiahInitialized = 'true';

        // Format nilai awal
        input.value = formatRupiahValue(input.value);

        // Format saat mengetik
        input.addEventListener('input', function () {
            const cursorPosition = this.selectionStart;
            const oldLength = this.value.length;

            this.value = formatRupiahValue(this.value);

            const newLength = this.value.length;
            const lengthDifference = newLength - oldLength;

            const newCursorPosition = Math.max(
                0,
                cursorPosition + lengthDifference
            );

            this.setSelectionRange(
                newCursorPosition,
                newCursorPosition
            );
        });
    });
}

// Jalankan ketika halaman selesai dimuat
document.addEventListener('DOMContentLoaded', function () {
    initializeRupiahFormatter();
});

// Hapus format sebelum form dikirim
document.addEventListener('submit', function (event) {
    const form = event.target;

    form.querySelectorAll('[data-rupiah]').forEach((input) => {
        input.value = input.value.replace(/\./g, '');
    });
});