{{-- MODAL ADD PRODUK KE TOKO --}}
<div class="modal fade" id="modalAddProdukToko" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:12px;">

            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk ke Toko</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form id="formAddProdukToko">

                    <div class="form-group">
                        <label class="small mb-1">Pilih Produk Milik Anda</label>
                        <select class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            <option value="1">Donat Coklat</option>
                            <option value="2">Pastel Ayam</option>
                            <option value="3">Risoles Mayo</option>
                        </select>
                        <small class="text-muted">
                            Produk ini akan diajukan untuk dijual di toko
                        </small>
                    </div>

                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn" style="background:#9B8CFF;color:white">
                            Ajukan Produk
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT DUMMY --}}
<script>
$(document).ready(function(){
    $('#formAddProdukToko').submit(function(e){
        e.preventDefault();
        alert('Produk berhasil diajukan (dummy)');
        $('#modalAddProdukToko').modal('hide');
    });
});
</script>
