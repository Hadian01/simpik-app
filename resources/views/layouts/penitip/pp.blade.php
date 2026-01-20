@extends('layouts.app')

@section('content')

<div class="container-fluid">

@php
$toko = [
    'id' => 1,
    'nama_toko' => 'Toko Hadian Nelvi',
    'pemilik' => 'Hadian Nelvi',
    'alamat' => 'Marina, Kota Batam',
    'no_hp' => '082145687458',
    'email' => 'hadianelvi82@gmai.com',
    'start_operasional' => '2020-09-15',
    'jam_operasional' => 'Every Day, 05.00 - 12.00',
    'deskripsi' => 'Toko dian ini toko pertama saya di masa pandemi',
    'banner' => null,
    'is_active' => true,
];

$produk_toko = [
    ['id'=>1,'nama'=>'Kue Lapis','gambar'=>null,'is_active'=>true,'harga'=>10000],
    ['id'=>2,'nama'=>'Brownies','gambar'=>null,'is_active'=>true,'harga'=>15000],
    ['id'=>3,'nama'=>'Roti Tawar','gambar'=>null,'is_active'=>true,'harga'=>10000],
];

$statistik = [
    ['title'=>'Total Terjual','value'=>'500','bg_color'=>'#CFC7FF'],
    ['title'=>'Total Dititip','value'=>'600','bg_color'=>'#CFC7FF'],
    ['title'=>'Total Pendapatan','value'=>'Rp 2.000.000','bg_color'=>'#CFC7FF'],
];
@endphp

<h2 class="mb-4">{{ $toko['nama_toko'] }}</h2>

{{-- NAV TAB --}}
<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#detail">Detail Toko</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#dashboard">Dashboard Pendapatan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#riwayat">Riwayat Penjualan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#produk">Produk</a>
    </li>
</ul>

{{-- TAB CONTENT --}}
<div class="tab-content">

{{-- TAB DETAIL --}}
<div class="tab-pane fade show active" id="detail">
    @include('components.penitip.banner_toko', $toko)

    <div class="row">
        <div class="col-md-6">
            @include('components.penitip.detail_toko', $toko)
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h5>Produk {{ $toko['nama_toko'] }}</h5>
                <div class="row">
                    @foreach($produk_toko as $produk)
                        @include('components.penitip.card_produk', $produk)
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TAB DASHBOARD --}}
<div class="tab-pane fade" id="dashboard">
    <div class="row">
        @foreach($statistik as $stat)
            @include('components.penitip.card_dashboard', $stat)
        @endforeach
    </div>
</div>

{{-- TAB RIWAYAT --}}
<div class="tab-pane fade" id="riwayat">
    <div class="card p-3">
        <h5>Riwayat Penjualan</h5>
        <p class="text-muted">Data riwayat tetap seperti sebelumnya</p>
    </div>
</div>

{{-- TAB PRODUK (INI YANG KEMARIN KAMU BELUM PUNYA) --}}
<div class="tab-pane fade" id="produk">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Produk yang Dijual</h4>
        <button class="btn"
                style="background:#9B8CFF;color:white"
                data-toggle="modal"
                data-target="#modalAddProdukToko">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </button>
    </div>

    <div class="row">
        @foreach($produk_toko as $produk)
            @include('components.penitip.card_produk', $produk)
        @endforeach
    </div>

</div>

</div>
</div>

{{-- MODAL ADD PRODUK --}}
<div class="modal fade" id="modalAddProdukToko" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk ke Toko</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Pilih Produk Milik Anda</label>
                        <select class="form-control">
                            <option>Donat Coklat</option>
                            <option>Pastel Ayam</option>
                            <option>Risoles Mayo</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn" style="background:#9B8CFF;color:white">Ajukan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
