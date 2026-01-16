@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Riwayat Pengajuan Hadian Nelvi</h2>

    {{-- Search & Filter --}}
    @include('components.penitip.search_filter')

    {{-- DATA DUMMY PENGAJUAN --}}
    @php
    $pengajuan_list = [
        [
            'no' => 1,
            'submission_date' => '01-09-2025',
            'name_produk' => 'RISOL',
            'harga_jual' => 2000,
            'cogs' => 1800,
            'stock' => 38,
            'validasi_stock' => 38,
            'sisa_stock' => 2,
            'pendapatan' => 61200
        ],
        [
            'no' => 2,
            'submission_date' => '01-09-2025',
            'name_produk' => 'TAHU ISI',
            'harga_jual' => 2000,
            'cogs' => 1800,
            'stock' => 38,
            'validasi_stock' => 38,
            'sisa_stock' => 2,
            'pendapatan' => 61200
        ],
        [
            'no' => 3,
            'submission_date' => '01-09-2025',
            'name_produk' => 'DONAT',
            'harga_jual' => 2000,
            'cogs' => 1800,
            'stock' => 38,
            'validasi_stock' => 38,
            'sisa_stock' => 2,
            'pendapatan' => 61200
        ],
    ];
    @endphp

    {{-- Tabel Pengajuan --}}
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tableDetailPengajuan">
                <thead style="background: #CFC7FF;">
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>SUBMISSION DATE</th>
                        <th>NAME PRODUK</th>
                        <th>HARGA JUAL</th>
                        <th>COGS</th>
                        <th>STOCK</th>
                        <th>VALIDASI STOCK</th>
                        <th>SISA_STOCK</th>
                        <th>PENDAPATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan_list as $index => $item)
                    <tr>
                        <td>{{ $item['no'] }}</td>
                        <td>{{ $item['submission_date'] }}</td>
                        <td>{{ $item['name_produk'] }}</td>
                        <td>RP{{ number_format($item['harga_jual'], 0, ',', '.') }}</td>
                        <td>RP{{ number_format($item['cogs'], 0, ',', '.') }}</td>
                        <td>
                            <input type="number" class="form-control form-control-sm" value="{{ $item['stock'] }}" style="width: 80px;">
                        </td>
                        <td>
                            <button class="btn btn-sm" style="background: white; border: 1px solid #ddd; padding: 5px 15px; border-radius: 5px;">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-sm" style="background: white; border: 1px solid #ddd; padding: 5px 15px; border-radius: 5px;">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                        <td>RP {{ number_format($item['pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer" style="background: white; border-top: 1px solid #ddd;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing 1 to {{ count($pengajuan_list) }} of 20 entries</small>

                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item"><a class="page-link" href="#" style="background: #9B8CFF; color: white; border: none;">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>

@endsection

{{-- Script Search --}}
@push('scripts')
<script>
$(document).ready(function() {
    // Live Search
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();

        $('#tableDetailPengajuan tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
@endpush
