$(document).ready(function () {

    // Toggle produk (dummy)
    $('.toggle-produk').on('change', function () {
        const id = $(this).data('id');
        const status = $(this).is(':checked');

        console.log('Toggle produk:', id, status);
        alert('Status produk berubah (dummy)');
    });

    // Submit tambah produk (dummy)
    $('#formTambahProduk').on('submit', function (e) {
        e.preventDefault();
        alert('Produk berhasil ditambahkan (dummy)');
        $('#modalTambahProduk').modal('hide');
    });

});
