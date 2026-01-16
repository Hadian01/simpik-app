{{-- MODAL DETAIL LIST PENGAJUAN (Slide from Right) --}}
<div class="modal fade modal-right" id="modalDetailPengajuan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {{-- Header --}}
            <div class="modal-header" style="border-bottom: 1px solid #ddd; background: white;">
                <h5 class="modal-title" style="font-weight: 600;">Detail List Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body" style="padding: 30px; background: white;">

                {{-- Personal Information --}}
                <div class="mb-4">
                    <h6 class="mb-3" style="font-weight: 600; color: #333;">Personal Information</h6>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 100px; color: #666;">Nama</td>
                            <td id="detailNama" style="font-weight: 500;">-</td>
                        </tr>
                        <tr>
                            <td style="color: #666;">Email</td>
                            <td id="detailEmail" style="font-weight: 500;">-</td>
                        </tr>
                        <tr>
                            <td style="color: #666;">Alamat</td>
                            <td id="detailAlamat" style="font-weight: 500;">-</td>
                        </tr>
                        <tr>
                            <td style="color: #666;">No HP</td>
                            <td id="detailNoHP" style="font-weight: 500;">-</td>
                        </tr>
                    </table>
                </div>

                {{-- Produk Information --}}
                <div>
                    <h6 class="mb-3" style="font-weight: 600; color: #333;">Produk Information</h6>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 120px; color: #666;">Nama Produk</td>
                            <td id="detailNamaProduk" style="font-weight: 500;">-</td>
                        </tr>
                        <tr>
                            <td style="color: #666;">Harga Modal</td>
                            <td id="detailHargaModal" style="font-weight: 500;">-</td>
                        </tr>
                        <tr>
                            <td style="color: #666;">Harga Jual</td>
                            <td>
                                <input type="text" id="detailHargaJual" class="form-control form-control-sm" style="width: 150px; border: 1px solid #ddd;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #666;">Foto Produk</td>
                            <td>
                                <div style="width: 180px; height: 120px; border: 1px solid #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: #f9f9f9;">
                                    <i class="bi bi-image" style="font-size: 40px; color: #ccc;"></i>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

            {{-- Footer --}}
            <div class="modal-footer" style="border-top: 1px solid #ddd; padding: 20px 30px; background: white;">
                <button type="button" class="btn btn-outline-secondary px-4" id="btnTolak">Tolak</button>
                <button type="button" class="btn px-4" style="background-color: #9B8CFF; color: white;" id="btnTerima">Terima</button>
            </div>

        </div>
    </div>
</div>

{{-- Custom CSS untuk Modal Slide dari Kanan --}}
<style>
    /* Modal slide dari kanan */
    .modal-right .modal-dialog {
        position: fixed;
        margin: 0;
        width: 450px;
        height: 100%;
        right: -450px;
        transition: right 0.3s ease-out;
    }

    .modal-right.show .modal-dialog {
        right: 0;
    }

    .modal-right .modal-content {
        height: 100%;
        overflow-y: auto;
        border-radius: 0;
        border: none;
    }

    /* Backdrop tetap ada */
    .modal-right .modal-backdrop {
        background: rgba(0, 0, 0, 0.5);
    }

    /* Mobile responsive */
    @media (max-width: 576px) {
        .modal-right .modal-dialog {
            width: 90%;
            right: -90%;
        }
    }
</style>

<script>
$(document).ready(function() {
    // Button Terima
    $('#btnTerima').on('click', function() {
        // NANTI: AJAX request
        alert('Pengajuan diterima! (Dummy)');
        $('#modalDetailPengajuan').modal('hide');
    });

    // Button Tolak
    $('#btnTolak').on('click', function() {
        if (confirm('Yakin ingin menolak pengajuan ini?')) {
            // NANTI: AJAX request
            alert('Pengajuan ditolak! (Dummy)');
            $('#modalDetailPengajuan').modal('hide');
        }
    });
});
</script>
