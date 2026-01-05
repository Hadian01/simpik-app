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

    {{-- Grid Produk --}}
    <div class="row">

        {{-- Card Produk 1 --}}
        <div class="col-md-4 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative;">

                {{-- Toggle Active/Inactive --}}
                <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                    <label class="switch mb-0">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                {{-- Link ke Detail Produk --}}
                <a href="{{ route('penitip.detail_produk') }}" style="text-decoration: none; color: inherit;">
                    {{-- Gambar Produk --}}
                    <div style="width: 100%; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                        <strong style="color: #999; font-size: 18px;">Produk</strong>
                    </div>

                    {{-- Info Produk --}}
                    <div class="card-body">
                        <div class="row small">
                            <div class="col-6">
                                <strong>Nama Produk</strong><br>
                                <strong>Harga</strong>
                            </div>
                            <div class="col-6 text-right">
                                Dian Toko<br>
                                Rp 1.800
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Card Produk 2 --}}
        <div class="col-md-4 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative;">

                <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                    <label class="switch mb-0">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <a href="{{ route('penitip.detail_produk') }}" style="text-decoration: none; color: inherit;">
                    <div style="width: 100%; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                        <strong style="color: #999; font-size: 18px;">Produk</strong>
                    </div>

                    <div class="card-body">
                        <div class="row small">
                            <div class="col-6">
                                <strong>Nama Produk</strong><br>
                                <strong>Harga</strong>
                            </div>
                            <div class="col-6 text-right">
                                Dian Toko<br>
                                Rp 1.800
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Card Produk 3 --}}
        <div class="col-md-4 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative;">

                <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                    <label class="switch mb-0">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <a href="{{ route('penitip.detail_produk') }}" style="text-decoration: none; color: inherit;">
                    <div style="width: 100%; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                        <strong style="color: #999; font-size: 18px;">Produk</strong>
                    </div>

                    <div class="card-body">
                        <div class="row small">
                            <div class="col-6">
                                <strong>Nama Produk</strong><br>
                                <strong>Harga</strong>
                            </div>
                            <div class="col-6 text-right">
                                Dian Toko<br>
                                Rp 1.800
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>

{{-- INCLUDE MODAL --}}
@include('penitip.add_produk')

{{-- CSS TOGGLE SWITCH --}}
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #4CAF50;
}

input:checked + .slider:before {
    transform: translateX(26px);
}
</style>

@endsection
