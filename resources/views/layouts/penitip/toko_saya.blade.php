@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <h2 class="mb-4">{{ $toko->nama_toko }}</h2>

        {{-- TAB Navigation --}}
        <ul class="nav nav-tabs mb-4" id="tokoTab" role="tablist" style="border-bottom: 2px solid #ddd;">
            <li class="nav-item">
                <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                    style="color: #333; font-weight: 500;">
                    Detail Toko
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"
                    style="color: #333; font-weight: 500;">
                    Dashboard Pendapatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab"
                    style="color: #333; font-weight: 500;">
                    Riwayat Penjualan
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" id="produk-tab" data-toggle="tab" href="#produk" role="tab"
                    style="color: #333; font-weight: 500;">
                    Produk
                </a>
            </li> --}}
        </ul>

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>

            </div>
        @endif

        {{-- TAB Content --}}
        <div class="tab-content" id="tokoTabContent">

            {{-- TAB 1: Detail Toko --}}
            <div class="tab-pane fade show active" id="detail" role="tabpanel">

                {{-- Banner Toko --}}
                @include('components.penitip.banner_toko', [
                    'id' => $toko->penjual_id,
                    'banner' => $toko->banner ?? null,
                    'nama_toko' => $toko->nama_toko,
                    'is_active' => $toko->is_active ?? true,
                ])

                <div class="row">

                    {{-- KIRI: Info Toko --}}
                    <div class="col-md-6 mb-4">
                        @include('components.penitip.detail_toko', [
                            'id' => $toko->penjual_id,
                            'nama_toko' => $toko->nama_toko,
                            'pemilik' => $toko->nama_pemilik,
                            'alamat' => $toko->alamat_toko,
                            'no_hp' => $toko->no_hp,
                            'email' => optional($toko->user)->email ?? '-',
                            'start_operasional' => $toko->tanggal_join,
                            'jam_operasional' =>
                                $toko->jam_buka && $toko->jam_tutup
                                    ? $toko->jam_buka->format('H:i') . ' - ' . $toko->jam_tutup->format('H:i')
                                    : '-',
                            'deskripsi' => $toko->deskripsi_toko,
                            'is_active' => $toko->is_active ?? true,
                        ])
                    </div>

                    {{-- KANAN: Produk Toko --}}
                    <div class="col-md-6">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                            <h5 class="mb-3">Produk {{ $toko['nama_toko'] }}</h5>

                            <div class="row">
                                @foreach ($produk_toko as $produk)
                                    @include('components.penitip.list_produk', [
                                        'id' => $produk->produk_id,
                                        'nama' => $produk->produk_name,
                                        'gambar' => $produk->foto_produk,
                                        'harga' => $produk->harga_jual,
                                    ])
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- TAB 2: Dashboard Pendapatan --}}
            <div class="tab-pane fade" id="dashboard" role="tabpanel">

                {{-- Header Dashboard --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Dashboard Pendapatan</h4>
                    <small class="text-muted">Periode: {{ $dashboard['bulan'] }}</small>
                </div>

                {{-- Search & Filter --}}
                @include('components.penitip.search_filter')

                {{-- Card Statistik Dashboard --}}
                <div class="row mb-4">
                    @foreach ($statistik as $stat)
                        @include('components.penitip.card_dashboard', $stat)
                    @endforeach
                </div>

                {{-- Tabel Riwayat Detail --}}
                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;padding:8px;">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tableRiwayat">
                            <thead style="background: #CFC7FF;">
                                <tr>
                                    <th style="width: 50px;">NO</th>
                                    <th>SUBMISSION DATE</th>
                                    <th>NAME</th>
                                    <th>NAMA TOKO</th>
                                    <th>STOCK</th>
                                    <th>STOCK TERJUAL</th>
                                    <th>COGS</th>
                                    <th>PENDAPATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayat_list as $item)
                                    <tr>
                                        <td>{{ $item['no'] }}</td>
                                        <td>{{ $item['submission_date'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['nama_toko'] }}</td>
                                        <td>{{ $item['stock'] }}</td>
                                        <td>{{ $item['stock_terjual'] }}</td>
                                        <td>{{ $item['cogs'] }}</td>
                                        <td>{{ $item['pendapatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- TAB 3: Riwayat Penjualan --}}
            <div class="tab-pane fade" id="riwayat" role="tabpanel">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4>Riwayat Pengajuan {{ $toko->nama_toko }}</h4>

                    <div class="d-flex gap-2">

                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalFilterRiwayat">

                            <i class="bi bi-funnel"></i> Filter

                        </button>

                        <button class="btn text-white" style="background:#9B8CFF" data-toggle="modal"
                            data-target="#modalAddJumlahProduk">

                            <i class="bi bi-plus-lg"></i> Add

                        </button>

                    </div>

                </div>


                {{-- Card hanya untuk tabel --}}
                <div class="">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover mb-0 w-100" id="tableRiwayatPengajuan">

                            <thead class="text-center" style="background:#CFC7FF">

                                <tr>
                                    <th style="width:60px">NO</th>
                                    <th>SUBMISSION DATE</th>
                                    <th>NAME PRODUK</th>
                                    <th>HARGA JUAL</th>
                                    <th>COGS</th>
                                    <th>STOCK</th>
                                    <th>VALIDASI STOCK</th>
                                    <th>VALIDASI FOTO</th>
                                    <th>SISA STOCK</th>
                                    <th>SISA FOTO</th>
                                    <th>PENDAPATAN</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($riwayat_penjualan_list as $item)
                                    <tr>

                                        <td class="text-center">{{ $item['no'] }}</td>
                                        <td>{{ $item['submission_date'] }}</td>
                                        <td>{{ $item['name_produk'] }}</td>

                                        <td class="text-right">
                                            Rp {{ number_format($item['harga_jual'], 0, ',', '.') }}
                                        </td>

                                        <td class="text-right">
                                            Rp {{ number_format($item['cogs'], 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">{{ $item['sistem'] }}</td>
                                        <td class="text-center">{{ $item['validasi_stock'] ?? '-' }}</td>
                                        <td>
                                            @if ($item['validasi_foto'])
                                                <a href="javascript:void(0)" class="text-primary btn-view-foto"
                                                    data-foto="{{ asset('storage/stok_validasi/' . $item['validasi_foto']) }}"
                                                    data-title="Foto Validasi Stock">
                                                    Lihat Foto
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">{{ $item['sisa_stock'] ?? '-' }}</td>
                                        <td>

                                            @if ($item['sisa_foto'])
                                                <a href="javascript:void(0)" class="text-primary btn-view-foto"
                                                    data-foto="{{ asset('storage/stok_sisa/' . $item['sisa_foto']) }}"
                                                    data-title="Foto Sisa Stock">

                                                    Lihat Foto

                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">
                                            Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            Belum ada data riwayat
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>
                </div>

            </div>
            {{-- TAB PRODUK --}}
            <div class="tab-pane fade" id="produk">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Produk Toko</h4>
                    <button class="btn" style="background:#9B8CFF;color:white" data-toggle="modal"
                        data-target="#modalAddProdukToko">
                        <i class="bi bi-plus-lg"></i> Tambah Produk
                    </button>
                </div>

                {{-- PRODUK APPROVED --}}
                <h5 class="mb-3">Produk Aktif</h5>

                <div class="row mb-5">
                    @forelse($produk_toko as $produk)
                        @if ($produk->status === 'approved')
                            @include('components.penitip.card_produk', [
                                'id' => $produk->produk_id,
                                'nama' => $produk->produk_name,
                                'harga_jual' => $produk->harga_jual,
                            ])
                        @endif

                    @empty
                        <div class="col-12">
                            <p class="text-muted">Belum ada produk aktif.</p>
                        </div>
                    @endforelse
                </div>

                {{-- PRODUK PENGAJUAN --}}
                <h5 class="mb-3">Produk Pengajuan</h5>

                <div class="row">

                    @forelse($produk_toko as $produk)
                        @if (in_array($produk->status, ['pending', 'rejected']))
                            @include('components.penitip.card_produk_pengajuan', [
                                'id' => $produk->produk_id,
                                'nama' => $produk->produk_name,
                                'harga_jual' => $produk->harga_jual,
                                'status' => $produk->status,
                            ])
                        @endif

                    @empty

                        <div class="col-12">
                            <p class="text-muted">Tidak ada produk pengajuan.</p>
                        </div>
                    @endforelse

                </div>

            </div>
            <div class="modal fade" id="modalViewFoto" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <div class="modal-content" style="border-radius:12px;">

                        <div class="modal-header">

                            <h5 class="modal-title" id="modalFotoTitle">Foto</h5>

                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>

                        </div>

                        <div class="modal-body text-center">

                            <img id="modalFotoImage" src="" class="img-fluid rounded"
                                style="max-height:500px; border:1px solid #ddd;">

                        </div>

                    </div>
                </div>
            </div>



            {{-- INCLUDE MODAL ADD PRODUK --}}
            @include('components.penitip.add_new_produk')

            {{-- INCLUDE MODAL ADD JUMLAH PRODUK --}}
            @include('components.penitip.modal_add_jumlah_produk')

            {{-- INCLUDE MODAL FILTER RIWAYAT --}}
            @include('components.penitip.modal_filter_riwayat')

            {{-- MODAL FILTER --}}
            @include('components.penitip.modal_filter')


            {{-- CSS TAB ACTIVE --}}
            <style>
                table.dataTable {
                    width: 100% !important;
                }

                table.dataTable thead th {
                    white-space: nowrap;
                }

                .dataTables_wrapper .dataTables_filter {
                    float: right;
                }

                .dataTables_wrapper .dataTables_paginate {
                    float: right;
                }

                .nav-tabs .nav-link.active {
                    color: #9B8CFF !important;
                    border-bottom: 3px solid #9B8CFF !important;
                    font-weight: 600;
                }

                .nav-tabs .nav-link:hover {
                    color: #9B8CFF !important;
                }
            </style>
        @endsection


@push('scripts')
<script>

$(document).ready(function(){

let tableDashboard = $('#tableRiwayat').DataTable();
let tableRiwayat = $('#tableRiwayatPengajuan').DataTable();



/* ======================
FILTER RIWAYAT
====================== */

$('#formFilterRiwayat').submit(function(e){

e.preventDefault();

let tanggalDari = $('input[name="tanggal_dari"]').val();
let tanggalSampai = $('input[name="tanggal_sampai"]').val();
let produk = $('select[name="produk"]').val();

$.fn.dataTable.ext.search = [];

$.fn.dataTable.ext.search.push(function(settings,data){

if(settings.nTable.id !== 'tableRiwayatPengajuan'){
return true;
}

let tanggal = data[1];
let namaProduk = data[2];

if(produk && !namaProduk.toLowerCase().includes(produk.toLowerCase())){
return false;
}

if(tanggalDari && new Date(tanggal) < new Date(tanggalDari)){
return false;
}

if(tanggalSampai && new Date(tanggal) > new Date(tanggalSampai)){
return false;
}

return true;

});

tableRiwayat.draw();

$('#modalFilterRiwayat').modal('hide');

});


/* ======================
RESET RIWAYAT FILTER
====================== */

$('#resetFilterRiwayat').click(function(){

$('#formFilterRiwayat')[0].reset();

$.fn.dataTable.ext.search = [];

tableRiwayat.search('').columns().search('').draw();

});



/* ======================
FILTER DASHBOARD
====================== */

$('#formFilter').submit(function(e){

e.preventDefault();

let tanggalDari = $('input[name="tanggal_dari"]').val();
let tanggalSampai = $('input[name="tanggal_sampai"]').val();

$.fn.dataTable.ext.search.push(function(settings,data){

if(settings.nTable.id !== 'tableRiwayat'){
return true;
}

let tanggal = data[1];

if(tanggalDari && new Date(tanggal) < new Date(tanggalDari)){
return false;
}

if(tanggalSampai && new Date(tanggal) > new Date(tanggalSampai)){
return false;
}

return true;

});

tableDashboard.draw();

$('#modalFilter').modal('hide');

});


/* ======================
RESET DASHBOARD FILTER
====================== */

$('#resetFilterDashboard').click(function(){

$('#formFilter')[0].reset();

$.fn.dataTable.ext.search = [];

tableDashboard.search('').columns().search('').draw();

});



/* ======================
FIX DATATABLE TAB
====================== */

$('a[data-toggle="tab"]').on('shown.bs.tab', function () {

$($.fn.dataTable.tables(true)).DataTable().columns.adjust();

});

});

</script>
@endpush
