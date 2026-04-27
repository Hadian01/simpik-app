@extends('layouts.app', ['userType' => 'penitip'])

@section('title', 'Daftar Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Produk</h4>
    <div>
        <button class="btn btn-sm"
                style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;"
                data-toggle="modal"
                data-target="#modalFilterProduk">
            <i class="bi bi-funnel"></i> Filter
        </button>
        <button class="btn btn-sm ml-2"
                style="background:#9B8CFF;color:white;"
                onclick="openTambahProduk()">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </button>
    </div>
</div>

<div class="row" id="produkContainer">
    @foreach($produk as $item)
        @include('components.penitip.card_produk', [
            'id' => $item->produk_id,
            'nama' => $item->produk_name,
            'harga_modal' => $item->harga_modal,
            'harga_jual' => $item->harga_jual,
            'status_produk' => $item->status_produk,
            'produk_description' => $item->produk_description,
            'is_active' => $item->is_active,
            'produk_type' => $item->produk_type,
            'penitip_id' => $item->penitip_id,
            'showToggle' => true,
            'gambar' => $item->foto_produk,
        ])
    @endforeach
</div>

{{-- Modal Filter --}}
<div class="modal fade" id="modalFilterProduk" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formFilterProduk">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Produk</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select class="form-control" name="produk_type">
                            <option value="">Semua Jenis</option>
                            @foreach($produk_types as $type)
                                <option value="{{ $type->type }}">{{ ucfirst($type->type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="is_active">
                            <option value="">Semua Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;" id="resetFilterProduk">Reset</button>
                    <button type="submit" class="btn btn-sm" style="background:#9B8CFF;color:white;">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.penitip.add_produk')

@endsection

@push('scripts')
<script src="{{ asset('js/penitip/produk.js') }}"></script>
<script>
$(document).ready(function() {
    // Filter functionality
    $('#formFilterProduk').on('submit', function(e) {
        e.preventDefault();

        const produkType = $('[name="produk_type"]').val();
        const isActive = $('[name="is_active"]').val();

        $('.col-md-4').each(function() {
            const card = $(this);
            let show = true;

            // Filter by type
            if (produkType) {
                if (card.data('type') !== produkType) {
                    show = false;
                }
            }

            // Filter by status
            if (isActive !== '') {
                const cardActive = String(card.data('active')); // Convert to string untuk comparison
                const filterActive = String(isActive); // Pastikan string

                if (cardActive !== filterActive) {
                    show = false;
                }
            }

            card.toggle(show);
        });

        $('#modalFilterProduk').modal('hide');
    });

    // Reset filter
    $('#resetFilterProduk').on('click', function() {
        $('#formFilterProduk')[0].reset();
        $('.col-md-4').show();
        $('#modalFilterProduk').modal('hide');
    });
});
</script>
@endpush
