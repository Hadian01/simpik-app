<div class="modal fade" id="modalFilter" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:12px;">

            <div class="modal-header">
                <h5 class="modal-title">Filter Riwayat</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                {{-- IMPORTANT: data-table --}}
                <form id="formFilter" data-table="tableRiwayat">

                    {{-- FILTER TANGGAL --}}
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="date" name="tanggal_dari" class="form-control">
                            </div>
                            <div class="col-6">
                                <input type="date" name="tanggal_sampai" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- FILTER PRODUK --}}
                    <div class="form-group">
                        <label>Produk</label>
                        <select name="produk" class="form-control">

                            <option value="">Semua Produk</option>

                            @foreach ($produk_toko as $produk)
                                <option value="{{ strtolower($produk->produk_name) }}">
                                    {{ $produk->produk_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="d-flex justify-content-end align-items-center">

                        <button type="button" id="resetFilterDashboard" class="btn btn-light mr-2">
                            Reset
                        </button>

                        <button type="button" class="btn btn-sm mr-2" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;" data-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-sm" style="background:#9B8CFF;color:white;">
                            Terapkan Filter
                        </button>

                    </div>  

                </form>

            </div>
        </div>
    </div>
</div>
