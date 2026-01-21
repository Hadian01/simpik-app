@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Riwayat Pengajuan Penitip</h2>

    {{-- Search & Filter --}}
    @include('components.penitip.search_filter')

    {{-- DATA DUMMY --}}
    @php
$pengajuan_list = [
    [
        'no' => 1,
        'submission_date' => '2025-09-18',
        'name' => 'HADIAN NELVI',
        'produk' => 'RISOL',
        'harga_jual' => 2000,
        'harga_real' => 1800,
        'status' => 'waiting',
    ],
    [
        'no' => 2,
        'submission_date' => '2025-09-17',
        'name' => 'DIAN PUTRI',
        'produk' => 'DONAT',
        'harga_jual' => 3000,
        'harga_real' => 2200,
        'status' => 'approved',
    ],
    [
        'no' => 3,
        'submission_date' => '2025-09-16',
        'name' => 'RIZKY RAMADHAN',
        'produk' => 'RISOL',
        'harga_jual' => 2500,
        'harga_real' => 1800,
        'status' => 'rejected',
    ],
    [
        'no' => 4,
        'submission_date' => '2025-09-15',
        'name' => 'SITI AMINAH',
        'produk' => 'TAHU ISI',
        'harga_jual' => 2000,
        'harga_real' => 1500,
        'status' => 'approved',
    ],
    [
        'no' => 5,
        'submission_date' => '2025-09-14',
        'name' => 'ANDI PRATAMA',
        'produk' => 'DONAT',
        'harga_jual' => 2800,
        'harga_real' => 2100,
        'status' => 'waiting',
    ],
];
@endphp
    @endphp

    {{-- TABEL --}}
    <div class="card" style="border-radius:8px;">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tablePenitip">
                <thead style="background:#CFC7FF;">
                    <tr>
                        <th>NO</th>
                        <th>SUBMISSION DATE</th>
                        <th>NAME</th>
                        <th>PRODUK</th>
                        <th>HARGA JUAL</th>
                        <th>HARGA REAL</th>
                        <th>STATUS</th>
                        <th>DETAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan_list as $item)
                    <tr>
                        <td>{{ $item['no'] }}</td>
                        <td>{{ $item['submission_date'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['produk'] }}</td>
                        <td>Rp {{ number_format($item['harga_jual'],0,',','.') }}</td>
                        <td>Rp {{ number_format($item['harga_real'],0,',','.') }}</td>
                        <td>
                            @switch($item['status'])

                                @case('approved')
                                    <span class="badge badge-success px-3 py-2" style="font-size:12px;">
                                        Approved
                                    </span>
                                    @break

                                @case('waiting')
                                    <span class="badge badge-warning px-3 py-2" style="font-size:12px;">
                                        Waiting Approval
                                    </span>
                                    @break

                                @case('rejected')
                                    <span class="badge badge-danger px-3 py-2" style="font-size:12px;">
                                        Rejected
                                    </span>
                                    @break

                            @endswitch
                        </td>

                        <td class="text-center">
                            <button class="btn btn-link btn-detail p-0"
                                    data-item="{{ json_encode($item) }}"
                                    data-toggle="modal"
                                    data-target="#modalDetailPengajuan">
                                <i class="bi bi-eye" style="font-size:18px;"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ============================
    MODAL SECTION (WAJIB DI SINI)
============================ --}}

{{-- MODAL DETAIL --}}
@include('components.penjual.modal_detail_pengajuan')

{{-- MODAL CONFIRM APPROVE --}}
@include('components.penjual.modal_confirm_approve')

{{-- MODAL REJECT --}}
@include('components.penjual.modal_reject_reason')

@endsection

{{-- ============================
    SCRIPT KHUSUS HALAMAN INI
============================ --}}
@push('scripts')
<script src="{{ asset('js/penjual/pengajuan.js') }}"></script>
@endpush
