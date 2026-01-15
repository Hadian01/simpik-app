@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Riwayat Penjualan</h2>

    {{-- Search & Filter --}}
    @include('components.penitip.search_filter')

    {{-- DATA DUMMY STATISTIK --}}
    @php
    $statistik = [
        ['title' => 'Total Terjual', 'value' => '500', 'bg_color' => '#CFC7FF'],
        ['title' => 'Total Dititip', 'value' => '600', 'bg_color' => '#CFC7FF'],
        ['title' => 'Total Pendapatan', 'value' => 'Rp 2.000.000', 'bg_color' => '#CFC7FF'],
    ];
    @endphp

    {{-- Card Statistik --}}
    <div class="row">
        @foreach($statistik as $stat)
            @include('components.penitip.card_dashboard', $stat)
        @endforeach
    </div>

    {{-- DATA DUMMY RIWAYAT --}}
    @php
    $riwayat_list = [
        ['no' => 1, 'submission_date' => '01-09-2025', 'name' => 'RISOL', 'nama_toko' => 'TOKO MAJU', 'stock' => 35, 'stock_terjual' => 30, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 40.000'],
        ['no' => 2, 'submission_date' => '01-09-2025', 'name' => 'TAHU', 'nama_toko' => 'TOKO MAJU', 'stock' => 35, 'stock_terjual' => 26, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 39.00'],
        ['no' => 3, 'submission_date' => '01-09-2025', 'name' => 'TAHU', 'nama_toko' => 'TOKO SEDERHANA', 'stock' => 35, 'stock_terjual' => 26, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 39.00'],
        ['no' => 4, 'submission_date' => '01-09-2025', 'name' => 'TAHU', 'nama_toko' => 'TOKO SEDERHANA', 'stock' => 35, 'stock_terjual' => 26, 'cogs' => 'RP 1.800', 'pendapatan' => 'RP 39.00'],
    ];

    // Untuk pagination dummy
    $total_data = 20;
    $per_page = 10;
    $current_page = 1;
    @endphp

    {{-- Tabel Riwayat --}}
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

{{-- MODAL FILTER --}}
@include('components.penitip.modal_filter')

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
