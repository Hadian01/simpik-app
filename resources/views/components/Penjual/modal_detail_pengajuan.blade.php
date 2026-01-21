{{-- MODAL DETAIL LIST PENGAJUAN --}}
<div class="modal fade modal-right" id="modalDetailPengajuan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Detail List Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

                <hr>

                {{-- PRODUK INFO --}}
                <h6 class="font-weight-bold mb-3">Produk Information</h6>

                <table class="table table-sm">
                    <thead style="background:#F3F4F6;">
                        <tr>
                            <th width="40"></th>
                            <th>Produk</th>
                            <th>Harga Modal</th>
                            <th>Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="produk-check" value="1"></td>
                            <td>RISOL</td>
                            <td>Rp 1.800</td>
                            <td>
                                <input type="number" class="form-control form-control-sm harga-jual"
                                       value="2000" style="width:110px;">
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="produk-check" value="2"></td>
                            <td>DONAT</td>
                            <td>Rp 2.000</td>
                            <td>
                                <input type="number" class="form-control form-control-sm harga-jual"
                                       value="3000" style="width:110px;">
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-outline-danger" id="btnRejectOpen">
                    Reject
                </button>

                <button class="btn"
                        style="background:#9B8CFF;color:white"
                        id="btnApproveSelected">
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

@media (max-width:576px) {
    .modal-right .modal-dialog {
        width: 90%;
        right: -90%;
    }
}
</style>
