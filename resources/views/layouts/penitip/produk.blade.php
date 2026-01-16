@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header dengan Tombol Add Product --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Produk</h2>
        <button type="button" class="btn" style="background-color: #9B8CFF; color: white; padding: 8px 20px; border-radius: 8px;" data-toggle="modal" data-target="#modalTambahProduk">
            <strong>+</strong> Add Product
        </button>
    </div>

    {{-- DATA DUMMY PRODUK --}}
    @php
    $produk_list = [
        ['id' => 1, 'nama' => 'Kue Lapis', 'harga' => 15000, 'gambar' => null, 'is_active' => true],
        ['id' => 2, 'nama' => 'Brownies Coklat', 'harga' => 25000, 'gambar' => null, 'is_active' => true],
        ['id' => 3, 'nama' => 'Roti Tawar', 'harga' => 12000, 'gambar' => null, 'is_active' => false],
        ['id' => 4, 'nama' => 'Donat Premium', 'harga' => 8000, 'gambar' => null, 'is_active' => true],
        ['id' => 5, 'nama' => 'Kue Bolu Pandan', 'harga' => 18000, 'gambar' => null, 'is_active' => true],
        ['id' => 6, 'nama' => 'Kue Cubit', 'harga' => 5000, 'gambar' => null, 'is_active' => false],
    ];
    @endphp

    {{-- Grid Produk --}}
    <div class="row">
        @foreach($produk_list as $produk)
            @include('components.penitip.card_produk', $produk)
        @endforeach
    </div>

</div>

{{-- INCLUDE MODAL --}}
@include('layouts.penitip.add_produk')

@endsection

{{-- CSS External --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

{{-- JS External --}}
@push('scripts')
<script src="{{ asset('js/toggle_produk.js') }}"></script>
@endpush
