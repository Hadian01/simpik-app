{{-- MODAL FILTER RIWAYAT PENGAJUAN --}}
<div class="modal fade" id="modalFilterRiwayat" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">

            <div class="modal-header" style="border-bottom: 1px solid #ddd;">
                <h5 class="modal-title">Filter Riwayat Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formFilterRiwayat">

                    {{-- Filter Tanggal --}}
                    <div class="form-group">
                        <label>Tanggal Pengajuan</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="date" name="tanggal_dari" class="form-control">
                            </div>
                            <div class="col-6">
                                <input type="date" name="tanggal_sampai" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- Filter Produk --}}
                    <div class="form-group">
                        <label>Produk</label>
                        <select name="produk" class="form-control">
                            <option value="">Semua Produk</option>
                            <option value="risol">RISOL</option>
                            <option value="tahu">TAHU ISI</option>
                            <option value="donat">DONAT</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn" style="background-color: #9B8CFF; color: white;">Terapkan Filter</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#formFilterRiwayat').submit(function(e) {
        e.preventDefault();

        const filterData = $(this).serialize();
        console.log('Filter:', filterData);

        // NANTI: AJAX request
        alert('Filter diterapkan! (Dummy)');
        $('#modalFilterRiwayat').modal('hide');
    });
});
</script>
