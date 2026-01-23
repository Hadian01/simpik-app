@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Produk</h4>
    <div class="text-center">
        @include('components.button', [
    'type' => 'button',
    'text' => 'Tambah Produk',
    'class' => 'px-5',
    'dataToggle' => 'modal',
    'dataTarget' => '#modalTambahProduk'
    ])
    </div>
</div>

@php
$produkList = [
    ['id'=>1,'nama'=>'Kue Lapis','harga'=>15000,'gambar'=>null,'is_active'=>true],
    ['id'=>2,'nama'=>'Brownies','harga'=>25000,'gambar'=>null,'is_active'=>false],
    ['id'=>3,'nama'=>'Donat','harga'=>8000,'gambar'=>null,'is_active'=>true],
    ['id'=>1,'nama'=>'Kue Lapis','harga'=>15000,'gambar'=>null,'is_active'=>true],
    ['id'=>2,'nama'=>'Brownies','harga'=>25000,'gambar'=>null,'is_active'=>false],
    ['id'=>3,'nama'=>'Donat','harga'=>8000,'gambar'=>null,'is_active'=>true],
];
@endphp

<div class="row">
    @foreach($produkList as $produk)
        @include('components.penitip.card_produk', [
            'id' => $produk['id'],
            'nama' => $produk['nama'],
            'harga' => $produk['harga'],
            'is_active' => $produk['is_active'],
            'showToggle' => true
        ])
    @endforeach
</div>

@include('layouts.penitip.add_produk')

@endsection

@push('scripts')
<script src="{{ asset('js/penitip/produk.js') }}"></script>
@endpush
