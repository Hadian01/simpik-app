@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Riwayat Pengajuan Penitip</h2>

    {{-- Search & Filter --}}
    @include('components.penitip.search_filter')

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
                        <th>PRODUK DISETUJUI</th>
                        <th>STATUS</th>
                        <th>DETAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->penitip->name }}</td>
                        <td>{{ $item->detail_count }}</td>
                        <td>{{ $item->approved_count }}</td>
                        <td>
                            @switch($item->status)

                                @case('Approved')
                                    <span class="badge badge-success px-3 py-2" style="font-size:12px;">
                                        Approved
                                    </span>
                                    @break

                                @case('Pending')
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
                                    data-id="{{ $item->pengajuan_id }}"
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
