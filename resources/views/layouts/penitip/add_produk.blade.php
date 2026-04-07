<!-- =========================
CSRF TOKEN
========================= -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- =========================
MODAL PRODUK
========================= -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdukTitle">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form id="formProduk">

                    <!-- hidden id -->
                    <input type="hidden" id="produkId" name="produk_id">

                    <!-- TIPE -->
                    <div class="form-group">
                        <label>Tipe Produk <span class="text-danger">*</span></label>
                        <select class="form-control"
                                id="tipeProduk"
                                name="produk_type"
                                required>

                            <option value="">-- Pilih --</option>

                            @foreach($produk_types as $type)
                                <option value="{{ $type->type }}">
                                    {{ \Illuminate\Support\Str::title($type->type) }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- NAMA -->
                    <div class="form-group">
                        <label>Nama Produk <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control"
                               id="namaProduk"
                               name="produk_name"
                               required>
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="form-group">
                        <label>Deskripsi Produk <span class="text-danger">*</span></label>
                        <textarea class="form-control"
                                  id="deskripsiProduk"
                                  name="produk_description"
                                  rows="3"
                                  required></textarea>
                    </div>

                    <!-- HARGA -->
                    <div class="form-row">

                        <div class="form-group col">
                            <label>Harga Modal <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   id="hargaModal"
                                   name="harga_modal"
                                   oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                   required>
                        </div>

                        <div class="form-group col">
                            <label>Harga Jual <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   id="hargaJual"
                                   name="harga_jual"
                                   oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status Produk</label>

                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                class="custom-control-input"
                                id="statusProduk"
                                name="is_active"
                                checked>

                            <label class="custom-control-label" for="statusProduk">
                                Aktif
                            </label>
                        </div>

                    </div>

                    <!-- FOTO -->
                    <div class="form-group mb-3">
                        <label>Upload Foto Produk</label>

                        <div class="mb-2">
                            <img id="previewFotoProduk"
                                 src=""
                                 style="width:150px;height:150px;object-fit:cover;border:1px solid #ddd;display:none;">
                        </div>

                        <input type="file"
                               class="form-control"
                               id="uploadFoto"
                               name="upload_foto"
                               accept="image/*">
                    </div>

                    <!-- BUTTON -->
                    <div class="text-center mt-4">
                        <button type="submit"
                                class="btn btn-sm px-5" style="background:#9B8CFF;color:white;"
                                id="btnSubmitProduk">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>

let mode = 'add';

$(document).ready(function(){

    console.log("✅ jQuery Loaded");

    // =============================
    // SUBMIT FORM
    // =============================
    $('#formProduk').submit(function(e){

        e.preventDefault();

        // ambil value
        let produkId   = $('#produkId').val();
        let tipeProduk = $('#tipeProduk').val();
        let namaProduk = $('#namaProduk').val();
        let deskripsi  = $('#deskripsiProduk').val();
        let hargaModal = $('#hargaModal').val();
        let hargaJual  = $('#hargaJual').val();
        let penitipId  = 1;

        console.log("MODE:", mode);

        console.log({
            produkId,
            tipeProduk,
            namaProduk,
            deskripsi,
            hargaModal,
            hargaJual
        });

        let url = (mode === 'add')
            ? '/penitip/add_produk'
            : '/penitip/edit_produk';

        let formData = new FormData();

        formData.append('produk_id', produkId);
        formData.append('produk_type', tipeProduk);
        formData.append('produk_name', namaProduk);
        formData.append('produk_description', deskripsi);
        formData.append('harga_modal', hargaModal);
        formData.append('harga_jual', hargaJual);
        formData.append('penitip_id', penitipId);
        
        // Status produk (checkbox)
        let isActive = $('#statusProduk').is(':checked') ? 1 : 0;
        if (isActive) {
            formData.append('is_active', '1');
        }

        // =============================
        // FILE FOTO
        // =============================
        let uploadFoto = $('#uploadFoto')[0].files[0];

        if(uploadFoto){
            formData.append('upload_foto', uploadFoto);
        }

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({

            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,

            beforeSend: function(){
                $('#btnSubmitProduk').text('Processing...');
            },

            success: function(res){

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: res.message,
                    confirmButtonColor: '#9B8CFF',
                    timer: 2000
                });

                $('#modalTambahProduk').modal('hide');
                $('#formProduk')[0].reset();
                $('#uploadFoto').val('');

                $('#btnSubmitProduk').text('Simpan');

                setTimeout(function(){
                    location.reload();
                }, 1500);
            },

            error: function(err){
                console.log(err.responseText);
                
                let errorMsg = 'Terjadi error!';
                if (err.responseJSON && err.responseJSON.message) {
                    errorMsg = err.responseJSON.message;
                } else if (err.responseJSON && err.responseJSON.errors) {
                    errorMsg = Object.values(err.responseJSON.errors).flat().join('<br>');
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: errorMsg,
                    confirmButtonColor: '#9B8CFF'
                });
                
                $('#btnSubmitProduk').text('Simpan');
            }

        });

    });

    // =============================
    // PREVIEW FOTO SAAT PILIH FILE
    // =============================
    $('#uploadFoto').change(function(e){
        
        let file = e.target.files[0];
        
        if(file){
            let reader = new FileReader();
            
            reader.onload = function(e){
                $('#previewFotoProduk')
                    .attr('src', e.target.result)
                    .show();
            };
            
            reader.readAsDataURL(file);
        } else {
            $('#previewFotoProduk').hide();
        }
    });

});


// =============================
// OPEN TAMBAH PRODUK
// =============================
function openTambahProduk(){

    mode = 'add';

    $('#modalProdukTitle').text('Tambah Produk');
    $('#btnSubmitProduk').text('Simpan');

    $('#formProduk')[0].reset();
    $('#produkId').val('');
    $('#uploadFoto').val('');

    $('#previewFotoProduk').hide();

    $('#modalTambahProduk').modal('show');
}


// =============================
// OPEN EDIT PRODUK
// =============================
function openEditProduk(data){

    mode = 'edit';

    $('#modalProdukTitle').text('Edit Produk');
    $('#btnSubmitProduk').text('Update');

    $('#produkId').val(data.produk_id);
    $('#tipeProduk').val(data.produk_type);
    $('#namaProduk').val(data.produk_name);
    $('#deskripsiProduk').val(data.produk_description);
    $('#hargaModal').val(data.harga_modal);
    $('#hargaJual').val(data.harga_jual);

    $('#statusProduk').prop('checked', data.is_active);

    // ========================
    // PREVIEW FOTO
    // ========================
    if(data.foto_produk){

        $('#previewFotoProduk')
            .attr('src', '/storage/' + data.foto_produk)
            .show();

    }else{

        $('#previewFotoProduk').hide();

    }

    $('#modalTambahProduk').modal('show');
}


// ===============================
// HAPUS PRODUK
// ===============================
function hapusProduk(id)
{
    Swal.fire({
        title: 'Hapus Produk?',
        text: 'Produk yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#9B8CFF',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('/penitip/delete_produk/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonColor: '#9B8CFF'
                }).then(() => {
                    window.location.href = "/penitip/produk";
                });
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus produk',
                    confirmButtonColor: '#9B8CFF'
                });
            });
        }
    });
}

</script>
@endpush
