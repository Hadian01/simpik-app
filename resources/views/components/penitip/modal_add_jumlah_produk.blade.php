{{--
    MODAL ADD JUMLAH PRODUK
    Untuk pengajuan stok/pemesanan produk
--}}

<div class="modal fade" id="modalAddJumlahProduk" tabindex="-1" role="dialog" aria-labelledby="modalAddJumlahProdukLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-custom">

            {{-- Header --}}
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="modalAddJumlahProdukLabel">
                    <i class="bi bi-plus-circle"></i> Add Jumlah Produk
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body modal-body-custom">
                <form id="formAddJumlahProduk">
                    @csrf

                    {{-- Pilih Produk --}}
                    <div class="form-group">
                        <label class="form-label-small">
                            Pilih Produk <span class="text-danger">*</span>
                        </label>
                        <select name="produk_id" id="selectProduk" class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            {{-- DUMMY DATA - Nanti ganti dengan loop dari database --}}
                            @php
                            $produk_options = [
                                ['id' => 1, 'nama' => 'RISOL'],
                                ['id' => 2, 'nama' => 'TAHU ISI'],
                                ['id' => 3, 'nama' => 'DONAT'],
                                ['id' => 4, 'nama' => 'KUE LAPIS'],
                            ];
                            @endphp

                            @foreach($produk_options as $produk)
                                <option value="{{ $produk['id'] }}">{{ $produk['nama'] }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Pilih produk yang ingin ditambahkan stoknya</small>
                    </div>

                    {{-- Jumlah Produk --}}
                    <div class="form-group">
                        <label class="form-label-small">
                            Jumlah Produk <span class="text-danger">*</span>
                        </label>
                        <input
                            type="number"
                            name="jumlah"
                            id="inputJumlah"
                            class="form-control"
                            placeholder="Masukkan jumlah"
                            required
                            min="1"
                            step="1"
                        >
                        <small class="text-muted">Minimal 1 unit</small>
                    </div>

                    {{-- Keterangan (Optional) --}}
                    <div class="form-group">
                        <label class="form-label-small">Keterangan (Opsional)</label>
                        <textarea
                            name="keterangan"
                            class="form-control"
                            rows="3"
                            placeholder="Tambahkan catatan jika diperlukan"
                        ></textarea>
                    </div>

                    {{-- Info Alert --}}
                    <div class="alert alert-info info-text-muted mb-4">
                        <i class="bi bi-info-circle"></i>
                        <strong>Catatan:</strong> Pengajuan akan diproses oleh admin setelah disubmit.
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary-custom px-5">
                            <i class="bi bi-send"></i> Submit Pengajuan
                        </button>
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">
                            Batal
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
