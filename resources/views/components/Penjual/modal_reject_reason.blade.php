<div class="modal fade" id="modalReject" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title font-weight-bold">Tolak Pengajuan</h6>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <label class="small mb-1">Alasan Penolakan</label>
                <textarea id="rejectReason"
                          class="form-control"
                          rows="3"
                          placeholder="Masukkan alasan penolakan..."
                          required></textarea>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                    Batal
                </button>
                <button class="btn btn-danger btn-sm" id="btnSubmitReject">
                    Kirim Penolakan
                </button>
            </div>

        </div>
    </div>
</div>
