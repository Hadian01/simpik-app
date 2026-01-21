$(document).ready(function () {

    $('#btnApproveSelected').click(function () {
        if ($('.produk-check:checked').length === 0) {
            alert('Pilih minimal 1 produk.');
            return;
        }
        $('#modalConfirmApprove').modal('show');
    });

    $('#btnConfirmApprove').click(function () {
        let approved = [];
        $('.produk-check:checked').each(function () {
            approved.push($(this).val());
        });

        console.log('Approved:', approved);
        alert('Produk berhasil disetujui!');
        $('.modal').modal('hide');
    });

    $('#btnRejectOpen').click(function () {
        $('#modalReject').modal('show');
    });

    $('#btnSubmitReject').click(function () {
        const reason = $('#rejectReason').val().trim();
        if (!reason) {
            alert('Alasan wajib diisi.');
            return;
        }

        console.log('Reject reason:', reason);
        alert('Pengajuan ditolak.');
        $('.modal').modal('hide');
    });

});
