{{-- MODAL ADD JUMLAH PRODUK --}}
<div class="modal fade" id="modalAddJumlahProduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">

            {{-- Header --}}
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="mb-1 font-weight-bold">Tambah Jumlah Produk</h5>
                    <small class="text-muted">
                        Ajukan penambahan stok produk
                    </small>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body pt-3">
                <form id="formAddJumlahProduk">
                    @csrf

                    {{-- Produk --}}
                    <div class="form-group">
                        <label class="small font-weight-medium">
                            Produk <span class="text-danger">*</span>
                        </label>
                        <select name="produk_id" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            @php
                                $produk_options = [
                                    ['id' => 1, 'nama' => 'Risol'],
                                    ['id' => 2, 'nama' => 'Tahu Isi'],
                                    ['id' => 3, 'nama' => 'Donat'],
                                    ['id' => 4, 'nama' => 'Kue Lapis'],
                                ];
                            @endphp
                            @foreach($produk_options as $produk)
                                <option value="{{ $produk['id'] }}">
                                    {{ $produk['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah --}}
                    <div class="form-group">
                        <label class="small font-weight-medium">
                            Jumlah <span class="text-danger">*</span>
                        </label>
                        <input
                            type="number"
                            name="jumlah"
                            class="form-control"
                            placeholder="Contoh: 20"
                            min="1"
                            required
                        >
                        <small class="text-muted">
                            Minimal pengajuan 1 unit
                        </small>
                    </div>

                    {{-- Keterangan --}}
                    <div class="form-group">
                        <label class="small font-weight-medium">
                            Catatan <span class="text-muted">(opsional)</span>
                        </label>
                        <textarea
                            name="keterangan"
                            rows="3"
                            class="form-control"
                            placeholder="Contoh: untuk stok akhir pekan"
                        ></textarea>
                    </div>

                    {{-- Info ringan --}}
                    <div class="bg-light rounded p-3 mb-4 small text-muted">
                        <i class="bi bi-info-circle mr-1"></i>
                        Pengajuan akan direview oleh admin sebelum diproses.
                    </div>

                    {{-- Action --}}
                    <div class="d-flex justify-content-end">
                        <button
                            type="button"
                            class="btn btn-outline-secondary mr-2"
                            data-dismiss="modal"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="btn"
                            style="background:#9B8CFF;color:#fff;padding:8px 24px;border-radius:8px;"
                        >
                            Ajukan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
