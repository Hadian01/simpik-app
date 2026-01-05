{{-- MODAL TAMBAH PRODUK --}}
<div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px;">

            {{-- Header --}}
            <div class="modal-header" style="border-bottom: 1px solid #ddd;">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form id="formTambahProduk">

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label class="small mb-1">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Tart Tarik" required>
                    </div>

                    {{-- Tipe Produk --}}
                    <div class="mb-3">
                        <label class="small mb-1">Tipe Produk</label>
                        <select name="tipe_produk" class="form-control" required>
                            <option value="">Aktif</option>
                            <option value="kue">Kue</option>
                            <option value="roti">Roti</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-3">
                        <label class="small mb-1">Keterangan</label>
                        <select name="keterangan" class="form-control" required>
                            <option value="">Aktif</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    {{-- Harga Modal & Harga Jual --}}
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small mb-1">Harga Modal</label>
                            <input type="number" name="harga_modal" class="form-control" placeholder="8.000" required>
                        </div>
                        <div class="col-6">
                            <label class="small mb-1">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" placeholder="RP 10.000" required>
                        </div>
                    </div>

                    {{-- Info Text --}}
                    <div class="mb-4">
                        <small class="text-muted">
                            *on yang diri tidak baru membrukan setingan<br>
                            pelajari da bank<br><br>
                            • Harga Jual Min/Max: 20% Melalani dari 50%<br>
                            dari 50%<br>
                            • Harga Keunrung masi Rp 0.000
                        </small>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="text-center">
                        <button type="submit" class="btn" style="background-color: #9B8CFF; color: white; padding: 10px 40px; border-radius: 8px;">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#formTambahProduk').submit(function(e) {
            e.preventDefault();
            alert('Produk berhasil ditambahkan! (Masih dummy)');
            $('#modalTambahProduk').modal('hide');
        });
    });
</script>
