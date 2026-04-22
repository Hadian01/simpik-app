{{-- MODAL DETAIL LIST PENGAJUAN --}}
<div class="modal fade modal-right" id="modalDetailPengajuan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">
                    Detail List Pengajuan
                </h5>

                <div class="px-4 pt-2" id="statusContainer"></div>

                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body px-4">

                {{-- PERSONAL INFO --}}
                <h6 class="font-weight-bold mb-3">Personal Information</h6>

                <table class="table table-borderless table-sm">
                    <tr><td width="110">Nama</td><td id="detailNama">-</td></tr>
                    <tr><td>Email</td><td id="detailEmail">-</td></tr>
                    <tr><td>Alamat</td><td id="detailAlamat">-</td></tr>
                    <tr><td>No HP</td><td id="detailNoHP">-</td></tr>
                </table>

                {{-- REJECT REASON --}}
                <div id="rejectReasonContainer" style="display:none;">
                    <hr>
                    <h6 class="font-weight-bold text-danger">
                        Reject Reason
                    </h6>

                    <div class="alert alert-danger" id="detailRejectReason">
                        -
                    </div>
                </div>

                <hr>

                {{-- PRODUK --}}
                <h6 class="font-weight-bold mb-3">Produk Information</h6>

                <table class="table table-sm">
                    <thead style="background:#F3F4F6;">
                        <tr>
                            <th width="60" class="text-center">Pilih</th>
                            <th>Produk</th>
                            <th>Harga Modal</th>
                            <th>Harga Jual</th>
                        </tr>
                    </thead>

                    <!--ini boleh di hapus ga -->
                    <!-- <tbody id="produkContainer">
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Pilih pengajuan untuk melihat detail
                            </td>
                        </tr>
                    </tbody> -->
                </table>

                {{-- HISTORY --}}
                <hr>

                <h6 class="font-weight-bold mb-3">History Pengajuan</h6>

                <table class="table table-sm">
                    <thead style="background:#F3F4F6;">
                        <tr>
                            <th width="130">Tanggal</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>

                    <tbody id="historyContainer">
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada riwayat
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" id="selectedPengajuanId">
                <input type="hidden" id="selectedStatus">

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer d-flex justify-content-between"
                 id="actionButtons">

                <button class="btn btn-outline-danger" id="btnRejectOpen">
                    Reject
                </button>

                <button class="btn btn-sm" style="background:#9B8CFF;color:white;" id="btnApproveSelected">
                    Setujui Produk Terpilih
                </button>

            </div>

        </div>
    </div>
</div>

<style>
.modal-right .modal-dialog {
    position: fixed;
    margin: 0;
    width: 450px;
    height: 100%;
    right: -450px;
    transition: right .3s ease-out;
}

.modal-right.show .modal-dialog {
    right: 0;
}

.modal-right .modal-content {
    height: 100%;
    border-radius: 0;
    border: none;
    overflow-y: auto;
}

.table td, .table th {
    vertical-align: middle;
}

@media (max-width:576px) {
    .modal-right .modal-dialog {
        width: 90%;
        right: -90%;
    }
}
</style>
