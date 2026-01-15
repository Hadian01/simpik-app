{{-- MODAL FILTER --}}
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">

            <div class="modal-header" style="border-bottom: 1px solid #ddd;">
                <h5 class="modal-title">Filter Riwayat</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formFilter">

                    {{-- Filter Tanggal --}}
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="date" name="tanggal_dari" class="form-control" placeholder="Dari">
                            </div>
                            <div class="col-6">
                                <input type="date" name="tanggal_sampai" class="form-control" placeholder="Sampai">
                            </div>
                        </div>
                    </div>

                    {{-- Filter Toko --}}
                    <div class="form-group">
                        <label>Toko</label>
                        <select name="toko" class="form-control">
                            <option value="">Semua Toko</option>
                            <option value="toko_maju">Toko Maju</option>
                            <option value="toko_sederhana">Toko Sederhana</option>
                        </select>
                    </div>

                    {{-- Filter Produk --}}
                    <div class="form-group">
                        <label>Produk</label>
                        <select name="produk" class="form-control">
                            <option value="">Semua Produk</option>
                            <option value="risol">Risol</option>
                            <option value="tahu">Tahu</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn" style="background-color: #9B8CFF; color: white;">Terapkan Filter</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#formFilter').submit(function(e) {
        e.preventDefault();

        // Ambil data filter
        const filterData = $(this).serialize();
        console.log('Filter data:', filterData);

        // NANTI: Kirim AJAX request ke backend
        /*
        $.ajax({
            url: '/penitip/riwayat/filter',
            method: 'GET',
            data: filterData,
            success: function(response) {
                // Update tabel dengan data filtered
            }
        });
        */

        alert('Filter diterapkan! (Dummy)');
        $('#modalFilter').modal('hide');
    });
});
</script>
