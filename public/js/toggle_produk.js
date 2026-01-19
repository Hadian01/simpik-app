// ========== TOGGLE PRODUK SCRIPT ==========

$(document).ready(function() {
    // Handle toggle switch
    $('.toggle-produk').on('change', function() {
        const produkId = $(this).data('id');
        const isActive = $(this).is(':checked');
        const $toggle = $(this);

        console.log('Produk ID:', produkId);
        console.log('Status:', isActive ? 'Active' : 'Inactive');

        // NANTI PAS INTEGRASI: Uncomment code di bawah
        /*
        $.ajax({
            url: '/penitip/produk/toggle/' + produkId,
            method: 'POST',
            data: {
                is_active: isActive,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Tampilkan notifikasi sukses
                alert('Status produk berhasil diubah!');
            },
            error: function(xhr) {
                // Kembalikan toggle ke posisi semula
                $toggle.prop('checked', !isActive);
                alert('Gagal mengubah status produk!');
            }
        });
        */

        // DUMMY: Alert sementara
        alert('Status produk ID: ' + produkId + ' diubah menjadi: ' + (isActive ? 'Active' : 'Inactive'));
    });
});
