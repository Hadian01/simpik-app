// ========== TOGGLE PRODUK SCRIPT ==========

$(document).ready(function() {
    // Handle toggle switch
    $('.toggle-produk').on('change', function() {
        const produkId = $(this).data('id');
        const isActive = $(this).is(':checked');
        const $toggle = $(this);

        console.log('Produk ID:', produkId);
        console.log('Status:', isActive ? 'Active' : 'Inactive');

        $.ajax({
            url: '/penitip/update_status_produk',
            method: 'POST',
            data: {
                produk_id: produkId,
                is_active: isActive ? 1 : 0,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Status produk berhasil diubah',
                    confirmButtonColor: '#9B8CFF',
                    timer: 2000
                });
            },
            error: function(xhr) {
                // Kembalikan toggle ke posisi semula
                $toggle.prop('checked', !isActive);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengubah status produk',
                    confirmButtonColor: '#9B8CFF'
                });
            }
        });
    });
});
