{{-- MODAL JOIN PENITIP --}}
<div class="modal fade" id="modalJoin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius:12px;">

            <div class="modal-header">
                <h5 class="modal-title">Join Sebagai Penitip</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formJoin">

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small mb-1">Nama</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="small mb-1">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small mb-1">No HP</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="small mb-1">Alamat</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small mb-1">Alasan</label>
                        <textarea class="form-control" rows="3" required></textarea>
                    </div>

                    {{-- PRODUK --}}
                    <div class="mb-4">
                        <h6>Pilih Produk</h6>
                        <table class="table table-sm">
                            <tr>
                                <td><input type="checkbox" checked> RISOL</td>
                                <td>Rp 2.000</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"> DONAT</td>
                                <td>Rp 3.000</td>
                            </tr>
                        </table>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="btn"
                            style="background:#9B8CFF;color:white">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#formJoin').submit(function(e) {
        e.preventDefault();

        alert('Pengajuan berhasil dikirim! Status: Menunggu Approval');

        $('#modalJoin').modal('hide');

        // Toggle button TANPA reload
        $('#btnJoinPenitip').hide();
        $('#btnStatusPengajuan').show();
    });
});
</script>
