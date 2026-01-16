{{-- MODAL JOIN PENITIP --}}
<div class="modal fade" id="modalJoin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px;">

            {{-- Header --}}
            <div class="modal-header" style="border-bottom: 1px solid #ddd;">
                <h5 class="modal-title">Join Sebagai Penitip</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form id="formJoin">
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small mb-1">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="small mb-1">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="small mb-1">No HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="small mb-1">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small mb-1">Alasan</label>
                        <textarea name="alasan" class="form-control" rows="3" required></textarea>
                    </div>

                    {{-- Tabel Produk --}}
                    <div class="mb-4">
                        <h6 class="mb-3">Pilih Produk yang Ingin Dititipkan:</h6>
                        <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <table class="table table-sm mb-0">
                                <thead style="background: #E3DFFF;">
                                    <tr>
                                        <th style="width: 50px;">NO</th>
                                        <th>NAME PRODUK</th>
                                        <th style="width: 120px;">HARGA JUAL</th>
                                        <th style="width: 120px;">COGS</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>RISOL</td>
                                        <td>RP 2000</td>
                                        <td>RP 1.800</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="produk[]" value="1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>TAHU ISI</td>
                                        <td>RP 2000</td>
                                        <td>RP 1.800</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="produk[]" value="2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>TAHU ISI</td>
                                        <td>RP 2000</td>
                                        <td>RP 1.800</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="produk[]" value="3" checked>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="text-center">
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
        $('#formJoin').submit(function(e) {
            e.preventDefault();
            alert('Form submitted! (Masih dummy)');
            $('#modalJoin').modal('hide');
        });
    });
</script>
