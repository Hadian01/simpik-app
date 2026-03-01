$(document).ready(function () {

    // ===============================
    // LOAD DETAIL KE MODAL
    // ===============================
    $(document).on('click', '.btn-detail', function () {

        let id = $(this).data('id');

        $.ajax({
            url: '/penjual/pengajuan/' + id + '/detail',
            type: 'GET',
            success: function (response) {

                console.log('AJAX response', response);

                // Simpan ID pengajuan
                $('#selectedPengajuanId').val(response.pengajuan_id);

                // Personal Info
                $('#detailNama').text(response.penitip.name ?? '-');
                $('#detailEmail').text(response.penitip.email ?? '-');
                $('#detailAlamat').text(response.penitip.alamat ?? '-');
                $('#detailNoHP').text(response.penitip.no_hp ?? '-');

                // Produk
                let html = '';

                response.detail.forEach(function (item) {

                    html += `
                        <tr>
                            <td>
                                <input type="checkbox"
                                       class="produk-check"
                                       value="${item.pengajuan_detail_id}">
                            </td>
                            <td>${item.produk.produk_name || '-'} </td>
                            <td>Rp ${parseInt(item.harga_modal || 0).toLocaleString()}</td>
                            <td>
                                <input type="number"
                                       class="form-control form-control-sm harga-jual"
                                       value="${item.harga_jual || ''}"
                                       data-id="${item.pengajuan_detail_id}"
                                       style="width:110px;">
                            </td>
                        </tr>
                    `;
                });

                $('#produkContainer').html(html);
            },
            error: function(xhr){
                console.error('AJAX error', xhr.status, xhr.responseText);
            }
        });
    });

    // ===============================
    // APPROVE BUTTON
    // ===============================
    $('#btnApproveSelected').click(function () {

        if ($('.produk-check:checked').length === 0) {
            alert('Pilih minimal 1 produk.');
            return;
        }

        $('#modalConfirmApprove').modal('show');
    });

    $('#btnConfirmApprove').click(function () {

        let pengajuanId = $('#selectedPengajuanId').val();
        let approved = [];

        $('.produk-check:checked').each(function () {
            approved.push($(this).val());
        });

        console.log('Pengajuan ID:', pengajuanId);
        console.log('Approved Produk:', approved);

        alert('Produk berhasil disetujui!');
        $('.modal').modal('hide');
    });

    // ===============================
    // REJECT BUTTON
    // ===============================
    $('#btnRejectOpen').click(function () {
        $('#modalReject').modal('show');
    });

    $('#btnSubmitReject').click(function () {

        const reason = $('#rejectReason').val().trim();

        if (!reason) {
            alert('Alasan wajib diisi.');
            return;
        }

        let pengajuanId = $('#selectedPengajuanId').val();

        console.log('Pengajuan ID:', pengajuanId);
        console.log('Reject reason:', reason);

        alert('Pengajuan ditolak.');
        $('.modal').modal('hide');
    });

    // ===============================
    // SELECT ALL CHECKBOX
    // ===============================
    $(document).on('change', '#checkAllProduk', function () {
        $('.produk-check').prop('checked', $(this).prop('checked'));
    });

    // ===============================
    // RESET MODAL SAAT DITUTUP
    // ===============================
    $('#modalDetailPengajuan').on('hidden.bs.modal', function () {

        $('#produkContainer').html(`
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Pilih pengajuan untuk melihat detail
                </td>
            </tr>
        `);

        $('#detailNama').text('-');
        $('#detailEmail').text('-');
        $('#detailAlamat').text('-');
        $('#detailNoHP').text('-');
        $('#selectedPengajuanId').val('');
        $('#checkAllProduk').prop('checked', false);
    });

});
