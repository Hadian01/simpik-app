$(document).ready(function () {

    $('.toggle-produk').on('change', function () {

        const id = $(this).data('id');
        const status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/penitip/update_status_produk',
            method: 'POST',
            data: {
                produk_id: id,
                is_active: status,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                console.log(response.message);
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    confirmButtonColor: '#9B8CFF',
                    timer: 1500,
                    showConfirmButton: false
                });
            },
            error: function(){
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal update status',
                    confirmButtonColor: '#9B8CFF'
                });
            }
        });

    });

});
