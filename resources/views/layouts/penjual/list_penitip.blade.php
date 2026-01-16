@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Riwayat Pengajuan Penitip</h2>

    {{-- Search & Filter (Pakai Component) --}}
    @include('components.penitip.search_filter')

    {{-- DATA DUMMY PENGAJUAN PENITIP --}}
    @php
    $pengajuan_list = [
        [
            'no' => 1,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'Approved',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 2,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'Approved',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 3,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'In Progress',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 4,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'Approved',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 5,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'Rejected',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 6,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'Approved',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 7,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'Rejected',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
        [
            'no' => 8,
            'submission_date' => '2025-09-18',
            'name' => 'HADIAN NELVI',
            'produk' => 'RISOL',
            'harga_jual' => 2000,
            'harga_real' => 1800,
            'status' => 'In Progress',
            'email' => 'dini@gmail.com',
            'alamat' => 'Bengkong Indah Bengkong ga dahulu',
            'no_hp' => '087421354574',
            'harga_modal' => 1800,
            'foto_produk' => null
        ],
    ];
    @endphp

    {{-- Tabel Pengajuan --}}
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tablePenitip">
                <thead style="background: #CFC7FF;">
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>SUBMISSION DATE</th>
                        <th>NAME</th>
                        <th>PRODUK</th>
                        <th>HARGA JUAL</th>
                        <th>HARGA REAL</th>
                        <th>STATUS</th>
                        <th style="width: 80px;">DETAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan_list as $item)
                    <tr>
                        <td>{{ $item['no'] }}</td>
                        <td>{{ $item['submission_date'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['produk'] }}</td>
                        <td>RP {{ number_format($item['harga_jual'], 0, ',', '.') }}</td>
                        <td>RP {{ number_format($item['harga_real'], 0, ',', '.') }}</td>
                        <td>
                            @if($item['status'] == 'Approved')
                                <span class="badge badge-success px-3 py-2" style="font-size: 12px;">Approved</span>
                            @elseif($item['status'] == 'In Progress')
                                <span class="badge badge-warning px-3 py-2" style="font-size: 12px;">In Progress</span>
                            @else
                                <span class="badge badge-danger px-3 py-2" style="font-size: 12px;">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-link p-0 btn-detail"
                                    data-item="{{ json_encode($item) }}"
                                    data-toggle="modal"
                                    data-target="#modalDetailPengajuan">
                                <i class="bi bi-eye" style="font-size: 18px; color: #666;"></i>
                            </button>
                        </td>
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
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>

{{-- INCLUDE MODAL DETAIL PENGAJUAN --}}
@include('components.penjual.modal_detail_pengajuan')

@endsection

{{-- Script Search --}}
@push('scripts')
<script>
$(document).ready(function() {
    // Live Search
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();

        $('#tablePenitip tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Populate Modal Detail
    $('.btn-detail').on('click', function() {
        const item = JSON.parse($(this).attr('data-item'));

        $('#detailNama').text(item.name);
        $('#detailEmail').text(item.email);
        $('#detailAlamat').text(item.alamat);
        $('#detailNoHP').text(item.no_hp);
        $('#detailNamaProduk').text(item.produk);
        $('#detailHargaModal').text('Rp ' + item.harga_modal.toLocaleString('id-ID'));
        $('#detailHargaJual').val(item.harga_jual);
    });
});
</script>
@endpush
