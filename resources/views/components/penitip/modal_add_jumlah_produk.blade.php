{{-- MODAL ADD JUMLAH PRODUK --}}
<div class="modal fade" id="modalAddJumlahProduk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">

            {{-- Header --}}
            <div class="modal-header" style="border-bottom: 1px solid #ddd;">
                <h5 class="modal-title">Add Jumlah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form id="formAddJumlahProduk">

                    {{-- Pilih Produk --}}
                    <div class="form-group">
                        <label>Pilih Produk</label>
                        <select name="produk_id" class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            <option value="1">RISOL</option>
                            <option value="2">TAHU ISI</option>
                            <option value="3">DONAT</option>
                            <option value="4">KUE LAPIS</option>
                        </select>
                    </div>

                    {{-- Jumlah Produk --}}
                    <div class="form-group">
                        <label>Jumlah Produk</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah" required min="1">
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn" style="background-color: #9B8CFF; color: white; padding: 10px 40px; border-radius: 8px;">
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
    $('#formAddJumlahProduk').submit(function(e) {
        e.preventDefault();

        const produkId = $('select[name="produk_id"]').val();
        const jumlah = $('input[name="jumlah"]').val();

        console.log('Produk ID:', produkId);
        console.log('Jumlah:', jumlah);

        // NANTI PAS INTEGRASI: Uncomment code di bawah
        /*
        $.ajax({
            url: '/penitip/pengajuan/store',
            method: 'POST',
            data: {
                produk_id: produkId,
                jumlah: jumlah,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Pengajuan berhasil ditambahkan!');
                $('#modalAddJumlahProduk').modal('hide');
                location.reload();
            },
            error: function() {
                alert('Gagal menambahkan pengajuan!');
            }
        });
        */

        alert('Pengajuan ditambahkan! (Dummy)\nProduk: ' + produkId + '\nJumlah: ' + jumlah);
        $('#modalAddJumlahProduk').modal('hide');
    });
});
</script>
