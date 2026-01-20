@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- DATA DUMMY TOKO --}}
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
        'deskripsi' => 'Toko dian ini toko pertama saya di masa pandemi untuk membangkitkan perekonomian',
        'banner' => null,
        'is_active' => true,
    ];

    // Variabel $id untuk component yang membutuhkan
    $id = $toko['id'];
    $is_active = $toko['is_active'];

    $produk_toko = [
        ['id' => 1, 'nama' => 'Kue Lapis', 'gambar' => null, 'is_active' => true, 'harga' => 10000],
        ['id' => 2, 'nama' => 'Brownies', 'gambar' => null, 'is_active' => true, 'harga' => 15000],
        ['id' => 3, 'nama' => 'Roti Tawar', 'gambar' => null, 'is_active' => true, 'harga' => 10000],
    ];

    // DATA DUMMY DASHBOARD
    $dashboard = [
        'total_penjualan' => 2500000,
        'produk_terjual' => 150,
        'komisi' => 250000,
        'pendapatan_bersih' => 2250000,
        'bulan' => 'Januari 2025'
    ];

    // DATA DUMMY STATISTIK (untuk dashboard)
    $statistik = [
        ['title' => 'Total Terjual', 'value' => '500', 'bg_color' => '#CFC7FF'],
        ['title' => 'Total Dititip', 'value' => '600', 'bg_color' => '#CFC7FF'],
        ['title' => 'Total Pendapatan', 'value' => 'Rp 2.000.000', 'bg_color' => '#CFC7FF'],
    ];

    // DATA DUMMY RIWAYAT (untuk dashboard)
    $riwayat_list = [
        ['no' => 1, 'submission_date' => '01-09-2025', 'name' => 'RISOL', 'nama_toko' => 'TOKO MAJU', 'stock' => 35, 'stock_terjual' => 30, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 40.000'],
        ['no' => 2, 'submission_date' => '01-09-2025', 'name' => 'TAHU', 'nama_toko' => 'TOKO MAJU', 'stock' => 35, 'stock_terjual' => 26, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 39.00'],
        ['no' => 3, 'submission_date' => '01-09-2025', 'name' => 'TAHU', 'nama_toko' => 'TOKO SEDERHANA', 'stock' => 35, 'stock_terjual' => 26, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 39.00'],
        ['no' => 4, 'submission_date' => '01-09-2025', 'name' => 'TAHU', 'nama_toko' => 'TOKO SEDERHANA', 'stock' => 35, 'stock_terjual' => 26, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 39.00'],
    ];

    // DATA DUMMY RIWAYAT PENJUALAN (untuk tab riwayat)
    $riwayat_penjualan = [
        ['no' => 1, 'tanggal' => '2025-01-05', 'produk' => 'Kue Lapis', 'jumlah' => 10, 'total' => 100000],
        ['no' => 2, 'tanggal' => '2025-01-05', 'produk' => 'Brownies', 'jumlah' => 5, 'total' => 75000],
        ['no' => 3, 'tanggal' => '2025-01-04', 'produk' => 'Roti Tawar', 'jumlah' => 8, 'total' => 80000],
    ];

    // Untuk pagination dummy
    $total_data = 20;
    $per_page = 10;
    $current_page = 1;
    @endphp

    {{-- Header --}}
    <h2 class="mb-4">{{ $toko['nama_toko'] }}</h2>

    {{-- TAB Navigation --}}
    <ul class="nav nav-tabs mb-4" id="tokoTab" role="tablist" style="border-bottom: 2px solid #ddd;">
        <li class="nav-item">
            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" style="color: #333; font-weight: 500;">
                Detail Toko
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" style="color: #333; font-weight: 500;">
                Dashboard Pendapatan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" style="color: #333; font-weight: 500;">
                Riwayat Penjualan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="produk-tab" data-toggle="tab" href="#produk" role="tab" style="color: #333; font-weight: 500;">
                Produk
            </a>
        </li>
    </ul>

    {{-- TAB Content --}}
    <div class="tab-content" id="tokoTabContent">

        {{-- TAB 1: Detail Toko --}}
        <div class="tab-pane fade show active" id="detail" role="tabpanel">

            {{-- Banner Toko --}}
            @include('components.penitip.banner_toko', [
                'id' => $toko['id'],
                'banner' => $toko['banner'],
                'nama_toko' => $toko['nama_toko'],
                'is_active' => $toko['is_active']
            ])

            <div class="row">

                {{-- KIRI: Info Toko --}}
                <div class="col-md-6 mb-4">
                    @include('components.penitip.detail_toko', [
                        'id' => $toko['id'],
                        'nama_toko' => $toko['nama_toko'],
                        'pemilik' => $toko['pemilik'],
                        'alamat' => $toko['alamat'],
                        'no_hp' => $toko['no_hp'],
                        'email' => $toko['email'],
                        'start_operasional' => $toko['start_operasional'],
                        'jam_operasional' => $toko['jam_operasional'],
                        'deskripsi' => $toko['deskripsi'],
                        'is_active' => $toko['is_active']
                    ])
                </div>

                {{-- KANAN: Produk Toko --}}
                <div class="col-md-6">
                    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                        <h5 class="mb-3">Produk {{ $toko['nama_toko'] }}</h5>

                        <div class="row">
                            @foreach($produk_toko as $produk)
                                @include('components.penitip.list_produk', [
                                    'id' => $produk['id'],
                                    'nama' => $produk['nama'],
                                    'gambar' => $produk['gambar'],
                                    'is_active' => $produk['is_active'],
                                    'harga' => $produk['harga']
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
                @foreach($statistik as $stat)
                    @include('components.penitip.card_dashboard', $stat)
                @endforeach
            </div>

            {{-- Tabel Riwayat Detail --}}
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
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
                            @foreach($riwayat_list as $item)
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

                {{-- Pagination --}}
                <div class="card-footer" style="background: white; border-top: 1px solid #ddd;">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Showing 1 to {{ count($riwayat_list) }} of {{ $total_data }} entries</small>

                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item"><a class="page-link" href="#" style="background: #9B8CFF; color: white; border: none;">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">10</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

        {{-- TAB 3: Riwayat Penjualan --}}
        <div class="tab-pane fade" id="riwayat" role="tabpanel">

            {{-- Header dengan Search, Filter & Add Button --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Riwayat Pengajuan {{ $toko['nama_toko'] }}</h4>

                <div class="d-flex align-items-center gap-2">
                    {{-- Search --}}
                    <div class="input-group" style="width: 250px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="background: white; border-right: none;">
                                <i class="bi bi-search"></i>
                            </span>
                        </div>
                        <input type="text" id="searchRiwayat" class="form-control" placeholder="Search" style="border-left: none;">
                    </div>

                    {{-- Filter Button --}}
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalFilterRiwayat">
                        <i class="bi bi-funnel"></i> Filter
                    </button>

                    {{-- Add Button --}}
                    <button type="button" class="btn" style="background-color: #9B8CFF; color: white;" data-toggle="modal" data-target="#modalAddJumlahProduk">
                        <i class="bi bi-plus-lg"></i> Add
                    </button>
                </div>
            </div>

            {{-- DATA DUMMY RIWAYAT PENGAJUAN --}}
            @php
            $riwayat_pengajuan = [
                [
                    'no' => 1,
                    'submission_date' => '01-09-2025',
                    'name_produk' => 'RISOL',
                    'harga_jual' => 2000,
                    'cogs' => 1800,
                    'sistem' => 38,
                    'validasi_stock' => 36,
                    'sisa_stock' => 2,
                    'pendapatan' => 10000
                ],
                [
                    'no' => 2,
                    'submission_date' => '02-09-2025',
                    'name_produk' => 'TAHU ISI',
                    'harga_jual' => 2000,
                    'cogs' => 1800,
                    'sistem' => 38,
                    'validasi_stock' => 38,
                    'sisa_stock' => 7,
                    'pendapatan' => 10000
                ],
                [
                    'no' => 3,
                    'submission_date' => '01-09-2025',
                    'name_produk' => 'DONAT',
                    'harga_jual' => 3000,
                    'cogs' => 1600,
                    'sistem' => 38,
                    'validasi_stock' => 36,
                    'sisa_stock' => 2,
                    'pendapatan' => 10000
                ],
            ];
            @endphp

            {{-- Tabel Riwayat --}}
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="tableRiwayatPengajuan">
                        <thead style="background: #CFC7FF;">
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>SUBMISSION DATE</th>
                                <th>NAME PRODUK</th>
                                <th>HARGA JUAL</th>
                                <th>COGS</th>
                                <th>SISTEM</th>
                                <th>VALIDASI STOCK</th>
                                <th>SISA STOCK</th>
                                <th>PENDAPATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat_pengajuan as $item)
                            <tr>
                                <td>{{ $item['no'] }}</td>
                                <td>{{ $item['submission_date'] }}</td>
                                <td>{{ $item['name_produk'] }}</td>
                                <td>RP {{ number_format($item['harga_jual'], 0, ',', '.') }}</td>
                                <td>RP {{ number_format($item['cogs'], 0, ',', '.') }}</td>
                                <td>{{ $item['sistem'] }}</td>
                                <td>{{ $item['validasi_stock'] }}</td>
                                <td>{{ $item['sisa_stock'] }}</td>
                                <td>RP {{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="card-footer" style="background: white; border-top: 1px solid #ddd;">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Showing 1 to {{ count($riwayat_pengajuan) }} of 20 entries</small>

                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item"><a class="page-link" href="#" style="background: #9B8CFF; color: white; border: none;">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">10</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                {{-- TAB PRODUK  --}}
                <div class="modal fade" id="Produk" tabindex="-1">
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
        </div>
        </div>
            {{-- TAB PRODUK--}}
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
        
{{-- INCLUDE MODAL ADD JUMLAH PRODUK --}}
@include('components.penitip.add_new_produk')

{{-- INCLUDE MODAL ADD JUMLAH PRODUK --}}
@include('components.penitip.modal_add_jumlah_produk')

{{-- INCLUDE MODAL FILTER RIWAYAT --}}
@include('components.penitip.modal_filter_riwayat')


{{-- Script Search Riwayat --}}
<script>
$(document).ready(function() {
    // Live Search untuk Tab Riwayat
    $('#searchRiwayat').on('keyup', function() {
        const value = $(this).val().toLowerCase();

        $('#tableRiwayatPengajuan tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>

    </div>
</div>

{{-- MODAL FILTER --}}
@include('components.penitip.modal_filter')

{{-- CSS untuk Tab Active --}}
<style>
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

{{-- JS untuk Search & Filter --}}
@push('scripts')
<script>
$(document).ready(function() {
    // Live Search
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();

        $('#tableRiwayat tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
@endpush
