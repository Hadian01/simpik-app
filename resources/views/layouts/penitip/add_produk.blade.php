<div class="modal fade" id="modalTambahProduk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="formTambahProduk">

                    {{-- TIPE PRODUK --}}
                    <div class="form-group">
                        <label>Tipe Produk</label>
                        <select class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="minuman">Minuman</option>
                            <option value="kue_basah">Kue Basah</option>
                            <option value="kue_kering">Kue Kering</option>
                        </select>
                    </div>

                    {{-- PRODUK --}}
                    <div class="form-group">
                        <label>Produk</label>
                        <select class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="kue">Kue</option>
                            <option value="roti">Roti</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>

                    {{-- HARGA --}}
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

                    {{-- STATUS PRODUK (BARU) --}}
                    <div class="form-group">
                        <label>Status Produk</label>
                        <select class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>

                    {{-- ACTION --}}
                    <div class="text-center mt-4">
                        @include('components.button', [
                            'type' => 'submit',
                            'text' => 'Simpan',
                            'class' => 'px-5'
                        ])
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
