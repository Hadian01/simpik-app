{{-- MODAL JOIN PENITIP --}}
<div class="modal fade" id="modalJoin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius:12px;">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title">Join Sebagai Penitip</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                <form id="formJoin">

                    {{-- DATA DIRI --}}
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

                    {{-- PILIH PRODUK --}}
                    <div class="mb-4">
                        <h6 class="mb-3">Pilih Produk</h6>

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center">
                                <thead style="background:#CFC7FF;">
                                    <tr>
                                        <th style="width:50px;">No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Jual</th>
                                        <th>COGS</th>
                                        <th style="width:60px;">Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>RISOL</td>
                                        <td>Rp 2.000</td>
                                        <td>Rp 1.800</td>
                                        <td>
                                            <input type="checkbox" name="produk[]" value="risol" checked>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>TAHU ISI</td>
                                        <td>Rp 2.000</td>
                                        <td>Rp 1.800</td>
                                        <td>
                                            <input type="checkbox" name="produk[]" value="tahu_isi">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="text-center">
                        <button type="submit"
                            class="btn"
                            style="background:#9B8CFF;color:white;padding:8px 30px;border-radius:8px;">
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
