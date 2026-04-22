$(document).ready(function () {

    // =====================================================
    // OPEN DETAIL MODAL
    // =====================================================

    //jika  fungsi .btn-detail di klik maka jalan kan function ini
    $(document).on('click', '.btn-detail', function () {

        let id = $(this).data('id');

        $('#modalDetailPengajuan').modal('show');

        // loading state (dan ini harusnya ga pakai ga sih)
        $('#produkContainer').html(`
            <tr>
                <td colspan="4" class="text-center">
                    Loading data...
                </td>
            </tr>
        `);

        // reset status dan button ketika detail itu di buka. sumpaya ga nimpa sama detail sebelumnya
        $('#statusContainer').html('');
        $('#actionButtons').show();

        //ini untuk logic js minta data ke backend tanpa reload halaman dan akan di kembalikan ke js lagi
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

                //jika status ada dan bukan pending button tampilin
                if (response.status && response.status.toLowerCase() !== 'pending') {
                    console.log('Hiding actionButtons');
                    $('#actionButtons').attr('style', 'display: none !important');
                    console.log('After hide, display:', $('#actionButtons').attr('style'));
                } 
                //jika status kosong tampilkan tombol
                else if (!response.status) {
                    // Jika status null/undefined, treat sebagai Pending
                    console.log('Status null/undefined, showing actionButtons');
                    $('#actionButtons').attr('style', 'display: flex');
                } 
                //jika status pending tampilkan tombol
                else {
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

                //jika produk kosong tampilkan info ini
                if (!response.detail.length) {

                    html = `
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Tidak ada produk
                            </td>
                        </tr>
                    `;

                } else {

                    //jika ada produk maka looping pe produk untuk ditampil
                    response.detail.forEach(function (item) {

                        const namaProduk =
                            item.produk?.produk_name ?? '-';

                        const hargaModal =
                            Number(item.harga_modal || 0)
                                .toLocaleString('id-ID');

                        // ini nanti hapus yang disabel dann read nlye dan harga jual buat kaya harga modal
                        const disabled =
                            response.status && response.status.toLowerCase() !== 'pending'
                                ? 'disabled'
                                : '';

                        const readonly =
                            response.status && response.status.toLowerCase() !== 'pending'
                                ? 'readonly'
                                : '';

                        // Debug individual item status
                        console.log('Item:', namaProduk, '| Detail Status:', item.status, '| Pengajuan Status:', response.status);

                        // Visual indicator based on status
                        let checkboxHTML = '';
                        
                        if (response.status && response.status.toLowerCase() === 'pending') {
                            // Pending: clickable custom checkbox with icon
                            checkboxHTML = `
                                <i class="bi bi-square custom-checkbox" 
                                   data-id="${item.pengajuan_detail_id}" 
                                   style="font-size:24px; cursor:pointer; color:#999;" 
                                   title="Klik untuk memilih produk">
                                </i>
                            `;
                        } else if (response.status && response.status.toLowerCase() !== 'pending') {
                            // Final status: show visual indicator
                            if (item.status === 'Approved') {
                                checkboxHTML = `<i class="bi bi-check-circle-fill text-success" style="font-size:24px;" title="Approved"></i>`;
                            } else {
                                checkboxHTML = `<i class="bi bi-x-circle text-muted" style="font-size:24px;" title="Not Approved"></i>`;
                            }
                        }

                        html += `
                            <tr>
                                <td class="text-center align-middle" style="vertical-align:middle;">
                                    ${checkboxHTML}
                                </td>

                                <td class="align-middle">${namaProduk}</td>

                                <td class="align-middle">Rp ${hargaModal}</td>
                                
                                <td class="align-middle">
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

                // ===============================
                // HISTORY LIST
                // ===============================
                let historyHTML = '';

                if (!response.history || response.history.length === 0) {
                    historyHTML = `
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada riwayat
                            </td>
                        </tr>
                    `;
                } else {
                    response.history.forEach(function (item) {
                        const statusBadge = item.status === 'Approved'
                            ? '<span class="badge badge-success">Approved</span>'
                            : item.status === 'Rejected'
                            ? '<span class="badge badge-danger">Rejected</span>'
                            : '<span class="badge badge-warning">Waiting for Approval</span>';

                        historyHTML += `
                            <tr>
                                <td>${item.tanggal}</td>
                                <td>${statusBadge}</td>
                                <td>${item.reason}</td>
                            </tr>
                        `;
                    });
                }

                $('#historyContainer').html(historyHTML);
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
    // TOGGLE CUSTOM CHECKBOX (Icon-based)
    // =====================================================
    $(document).on('click', '.custom-checkbox', function() {
        if ($(this).hasClass('checked')) {
            // Uncheck
            $(this).removeClass('checked bi-check-square-fill text-success');
            $(this).addClass('bi-square');
            $(this).css('color', '#999');
        } else {
            // Check
            $(this).removeClass('bi-square');
            $(this).addClass('checked bi-check-square-fill text-success');
            $(this).css('color', '');
        }
    });


    // =====================================================
    // APPROVE PRODUK
    // =====================================================
    $('#btnApproveSelected').click(function () {

        // Cek apakah ada checkbox yang dicentang
        if ($('.custom-checkbox.checked').length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Produk',
                text: 'Silakan centang minimal 1 produk untuk disetujui',
                confirmButtonColor: '#9B8CFF'
            });
            return;
        }

        // Validasi harga jual untuk produk yang dicentang
        let hasEmptyPrice = false;
        $('.custom-checkbox.checked').each(function () {
            let row = $(this).closest('tr');
            let hargaJual = row.find('.harga-jual').val();
            
            if (!hargaJual || hargaJual <= 0) {
                hasEmptyPrice = true;
                return false;
            }
        });

        if (hasEmptyPrice) {
            Swal.fire({
                icon: 'warning',
                title: 'Harga Jual Belum Diisi',
                text: 'Silakan isi harga jual untuk semua produk yang dipilih',
                confirmButtonColor: '#9B8CFF'
            });
            return;
        }

        let pengajuanId = $('#selectedPengajuanId').val();
        let approvedData = [];

        $('.custom-checkbox.checked').each(function () {
            let row = $(this).closest('tr');
            let detailId = $(this).data('id');
            let hargaJual = row.find('.harga-jual').val();

            approvedData.push({
                detail_id: detailId,
                harga_jual: hargaJual
            });
        });

        // Konfirmasi approve
        Swal.fire({
            icon: 'question',
            title: 'Konfirmasi Approve',
            text: `Anda yakin ingin menyetujui ${approvedData.length} produk?`,
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#9B8CFF',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (!result.isConfirmed) return;

            $.ajax({
                url: '/penjual/pengajuan/approve',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    pengajuan_id: pengajuanId,
                    approved_data: approvedData
                },

                success: function (res) {

                    if (res.success === false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message,
                            confirmButtonColor: '#9B8CFF'
                        });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        confirmButtonColor: '#9B8CFF'
                    }).then(() => {
                        $('#modalDetailPengajuan').modal('hide');
                        location.reload();
                    });

                },

                error: function (xhr) {
                    console.error('Approve error:', xhr);
                    let errorMessage = 'Gagal approve pengajuan';
                    
                    if (xhr.responseJSON?.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON?.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\\n');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage,
                        confirmButtonColor: '#9B8CFF'
                    });
                }
            });
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
            Swal.fire({
                icon: 'warning',
                title: 'Alasan Wajib Diisi',
                text: 'Silakan masukkan alasan penolakan',
                confirmButtonColor: '#9B8CFF'
            });
            return;
        }

        if (reason.length < 10) {
            Swal.fire({
                icon: 'warning',
                title: 'Alasan Terlalu Singkat',
                text: 'Silakan masukkan alasan minimal 10 karakter',
                confirmButtonColor: '#9B8CFF'
            });
            return;
        }

        // Konfirmasi reject
        Swal.fire({
            icon: 'warning',
            title: 'Konfirmasi Penolakan',
            text: 'Anda yakin ingin menolak pengajuan ini? Semua produk akan ditolak.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (!result.isConfirmed) return;

            $.ajax({
                url: '/penjual/pengajuan/reject',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    pengajuan_id: $('#selectedPengajuanId').val(),
                    reason: reason
                },

                success: function (res) {

                    if (res.success === false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message,
                            confirmButtonColor: '#9B8CFF'
                        });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        confirmButtonColor: '#9B8CFF'
                    }).then(() => {
                        $('.modal').modal('hide');
                        $('#rejectReason').val(''); // reset form
                        location.reload();
                    });

                },

                error: function (xhr) {
                    console.error('Error response:', xhr);
                    let errorMessage = 'Gagal menolak pengajuan';
                    
                    if (xhr.responseJSON?.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON?.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage,
                        confirmButtonColor: '#9B8CFF'
                    });
                }
            });
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
