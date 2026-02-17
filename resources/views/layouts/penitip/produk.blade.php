@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Produk</h4>
    <button class="btn btn-primary" onclick="openTambahProduk()">
    Tambah Produk
</button>

</div>

<div class="row">
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
            'showToggle' => true
        ])
    @endforeach
</div>

@include('layouts.penitip.add_produk')

@endsection

@push('scripts')
<script src="{{ asset('js/penitip/produk.js') }}"></script>
@endpush
