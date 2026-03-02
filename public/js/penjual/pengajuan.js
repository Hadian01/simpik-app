$(document).ready(function () {

    // =====================================================
    // OPEN DETAIL MODAL
    // =====================================================
    $(document).on('click', '.btn-detail', function () {

        let id = $(this).data('id');

        $('#modalDetailPengajuan').modal('show');

        // loading state
        $('#produkContainer').html(`
            <tr>
                <td colspan="4" class="text-center">
                    Loading data...
                </td>
            </tr>
        `);

        // reset badge & buttons dulu
        $('#statusContainer').html('');
        $('#actionButtons').show();

        $.ajax({
            url: '/penjual/pengajuan/' + id + '/detail',
            type: 'GET',

            success: function (response) {

                console.log(response);

                // ===============================
                // SIMPAN DATA
                // ===============================
                $('#selectedPengajuanId').val(response.pengajuan_id);
                $('#selectedStatus').val(response.status);

                // ===============================
                // STATUS BADGE
                // ===============================
                let badgeHTML = '';

                switch (response.status) {

                    case 'Approved':
                        badgeHTML =
                            `<span class="badge badge-success px-3 py-2">
                                Approved
                            </span>`;
                        break;

                    case 'Rejected':
                        badgeHTML =
                            `<span class="badge badge-danger px-3 py-2">
                                Rejected
                            </span>`;
                        break;

                    default:
                        badgeHTML =
                            `<span class="badge badge-warning px-3 py-2">
                                Waiting Approval
                            </span>`;
                }

                $('#statusContainer').html(badgeHTML);

                // ===============================
                // DEBUG STATUS
                // ===============================
                console.log('Status value:', response.status);
                console.log('Status type:', typeof response.status);
                console.log('Status toLowerCase:', response.status ? response.status.toLowerCase() : 'null/undefined');

                // ===============================
                // HIDE BUTTON JIKA SUDAH FINAL
                // ===============================
                if (response.status && response.status.toLowerCase() !== 'pending') {
                    console.log('Hiding actionButtons');
                    $('#actionButtons').attr('style', 'display: none !important');
                    console.log('After hide, display:', $('#actionButtons').attr('style'));
                } else if (!response.status) {
                    // Jika status null/undefined, treat sebagai Pending
                    console.log('Status null/undefined, showing actionButtons');
                    $('#actionButtons').attr('style', 'display: flex');
                } else {
                    console.log('Status is Pending, showing actionButtons');
                    $('#actionButtons').attr('style', 'display: flex');
                }

                // ===============================
                // PERSONAL INFO
                // ===============================
                $('#detailNama').text(response.penitip?.name ?? '-');
                $('#detailEmail').text(response.email ?? '-');
                $('#detailAlamat').text(response.penitip?.alamat ?? '-');
                $('#detailNoHP').text(response.penitip?.no_hp ?? '-');

                // ===============================
                // PRODUK LIST
                // ===============================
                let html = '';

                if (!response.detail.length) {

                    html = `
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Tidak ada produk
                            </td>
                        </tr>
                    `;

                } else {

                    response.detail.forEach(function (item) {

                        const namaProduk =
                            item.produk?.produk_name ?? '-';

                        const hargaModal =
                            Number(item.harga_modal || 0)
                                .toLocaleString('id-ID');

                        const disabled =
                            response.status !== 'Pending'
                                ? 'disabled'
                                : '';

                        const readonly =
                            response.status !== 'Pending'
                                ? 'readonly'
                                : '';

                        // Checkbox hanya tampil jika Pending
                        const checkboxHTML = response.status === 'Pending'
                            ? `<input type="checkbox" class="produk-check" value="${item.pengajuan_detail_id}">`
                            : '';

                        html += `
                            <tr>
                                <td class="text-center">
                                    ${checkboxHTML}
                                </td>

                                <td>${namaProduk}</td>

                                <td>Rp ${hargaModal}</td>

                                <td>
                                    <input type="number"
                                        class="form-control form-control-sm harga-jual"
                                        value="${item.harga_jual ?? ''}"
                                        ${readonly}
                                        style="width:110px;">
                                </td>
                            </tr>
                        `;
                    });
                }

                $('#produkContainer').html(html);
            },

            error: function (xhr) {

                console.error(xhr);

                $('#produkContainer').html(`
                    <tr>
                        <td colspan="4"
                            class="text-danger text-center">
                            Gagal mengambil data
                        </td>
                    </tr>
                `);
            }
        });
    });


    // =====================================================
    // APPROVE PRODUK
    // =====================================================
    $('#btnApproveSelected').click(function () {

        if ($('.produk-check:checked').length === 0) {
            alert('Pilih minimal 1 produk.');
            return;
        }

        let pengajuanId = $('#selectedPengajuanId').val();
        let approved = [];

        $('.produk-check:checked').each(function () {
            approved.push($(this).val());
        });

        $.ajax({
            url: '/penjual/pengajuan/approve',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                pengajuan_id: pengajuanId,
                produk_ids: approved
            },

            success: function (res) {

                alert(res.message);

                $('#modalDetailPengajuan').modal('hide');

                location.reload();
            },

            error: function (xhr) {
                console.log(xhr.responseText);
                alert('Gagal approve');
            }
        });
    });


    // =====================================================
    // OPEN REJECT MODAL
    // =====================================================
    $('#btnRejectOpen').click(function () {
        $('#modalReject').modal('show');
    });


    // =====================================================
    // SUBMIT REJECT
    // =====================================================
    $('#btnSubmitReject').click(function () {

        const reason = $('#rejectReason').val().trim();

        if (!reason) {
            alert('Alasan wajib diisi.');
            return;
        }

        $.ajax({
            url: '/penjual/pengajuan/reject',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                pengajuan_id: $('#selectedPengajuanId').val(),
                reason: reason
            },

            success: function (res) {

                alert(res.message);

                $('.modal').modal('hide');

                location.reload();
            },

            error: function (xhr) {
                console.log(xhr.responseText);
                alert('Gagal reject');
            }
        });
    });


    // =====================================================
    // RESET MODAL SAAT DITUTUP
    // =====================================================
    $('#modalDetailPengajuan').on('hidden.bs.modal', function () {

        $('#statusContainer').html('');
        $('#selectedPengajuanId').val('');
        $('#selectedStatus').val('');
        $('#actionButtons').show();

        $('#produkContainer').html(`
            <tr>
                <td colspan="4"
                    class="text-center text-muted">
                    Pilih pengajuan untuk melihat detail
                </td>
            </tr>
        `);

        $('#detailNama').text('-');
        $('#detailEmail').text('-');
        $('#detailAlamat').text('-');
        $('#detailNoHP').text('-');
    });

});
