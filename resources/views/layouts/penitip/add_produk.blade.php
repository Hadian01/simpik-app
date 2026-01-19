<div class="modal fade" id="modalTambahProduk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="formTambahProduk">

                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tipe Produk</label>
                        <select class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option>Kue</option>
                            <option>Roti</option>
                            <option>Snack</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label>Harga Modal</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label>Harga Jual</label>
                            <input type="number" class="form-control" required>
                        </div>
                    </div>

                    <small class="text-muted d-block mb-3">
                        • Harga jual minimal 20% dari harga modal<br>
                        • Harga jual maksimal 50% dari harga modal
                    </small>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
