<div class="modal fade" id="modalTambahProduk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalProdukTitle">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="formProduk">

                    {{-- TIPE PRODUK --}}
                    <div class="form-group">
                        <label>Tipe Produk</label>
                        <select class="form-control" id="tipeProduk" required>
                            <option value="">-- Pilih --</option>
                            <option value="minuman">Minuman</option>
                            <option value="kue_basah">Kue Basah</option>
                            <option value="kue_kering">Kue Kering</option>
                        </select>
                    </div>

                    {{-- PRODUK --}}
                    <div class="form-group">
                        <label>Produk</label>
                        <select class="form-control" id="namaProduk" required>
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
                            <input type="number" class="form-control" id="hargaModal" required>
                        </div>
                        <div class="form-group col">
                            <label>Harga Jual</label>
                            <input type="number" class="form-control" id="hargaJual" required>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">
                        <label>Status Produk</label>
                        <select class="form-control" id="statusProduk" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5" id="btnSubmitProduk">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script>
function openTambahProduk() {
    document.getElementById('modalProdukTitle').innerText = 'Tambah Produk';
    document.getElementById('btnSubmitProduk').innerText = 'Simpan';

    document.getElementById('formProduk').reset();

    $('#modalTambahProduk').modal('show');
}

function openEditProduk(data) {
    document.getElementById('modalProdukTitle').innerText = 'Edit Produk';
    document.getElementById('btnSubmitProduk').innerText = 'Update';

    document.getElementById('tipeProduk').value = data.tipe;
    document.getElementById('namaProduk').value = data.nama;
    document.getElementById('hargaModal').value = data.modal;
    document.getElementById('hargaJual').value = data.jual;
    document.getElementById('statusProduk').value = data.status;

    $('#modalTambahProduk').modal('show');
}

document.getElementById('formProduk').addEventListener('submit', function(e) {
    e.preventDefault();

    $('#modalTambahProduk').modal('hide');

    alert('Data produk berhasil disimpan (UI only)');
});
</script>
