@extends('layouts.app', ['userType' => 'penjual'])

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <h2 class="mb-4">Riwayat Pengajuan Penitip</h2>


        {{-- TABLE --}}
        <div class="card" style="border-radius:8px;">

            <div class="table-responsive" style="padding: 10px;">

                <table class="table table-hover mb-0 w-100" id="tablePenitip">

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

                        @foreach ($pengajuan as $index => $item)
                            <tr>

                                <td>{{ $index + 1 }}</td>
                                <td data-order="{{ $item->created_at }}">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                </td>

                                <td>{{ $item->penitip->name ?? '-' }}</td>

                                <td>{{ $item->detail_count }}</td>

                                <td>{{ $item->approved_count }}</td>

                                <td>

                                    @switch($item->status)
                                        @case('Approved')
                                            <span class="badge badge-success px-3 py-2">
                                                Approved
                                            </span>
                                        @break

                                        @case('Pending')
                                            <span class="badge badge-warning px-3 py-2">
                                                Waiting Approval
                                            </span>
                                        @break

                                        @case('Rejected')
                                            <span class="badge badge-danger px-3 py-2">
                                                Rejected
                                            </span>
                                        @break
                                    @endswitch

                                </td>

                                <td class="text-center">

                                    <button class="btn btn-link btn-detail p-0" data-id="{{ $item->pengajuan_id }}"
                                        data-toggle="modal" data-target="#modalDetailPengajuan">

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


    {{-- =========================
MODAL FILTER
========================= --}}

    <div class="modal fade" id="modalFilter" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <form id="formFilterPengajuan">

                    <div class="modal-header">

                        <h5 class="modal-title">Filter Data</h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>

                    </div>

                    <div class="modal-body">


                        <div class="form-group">

                            <label>Tanggal Dari</label>

                            <input type="date" name="tanggal_dari" class="form-control">

                        </div>


                        <div class="form-group">

                            <label>Tanggal Sampai</label>

                            <input type="date" name="tanggal_sampai" class="form-control">

                        </div>


                        <div class="form-group">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="">Semua</option>

                                <option value="Approved">Approved</option>

                                <option value="Pending">Pending</option>

                                <option value="Rejected">Rejected</option>

                            </select>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;" id="resetFilterPengajuan">

                            Reset

                        </button>

                        <button type="submit" class="btn btn-sm" style="background:#9B8CFF;color:white;">

                            Apply Filter

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>


    {{-- =========================
MODALS EXISTING
========================= --}}

    @include('components.penjual.modal_detail_pengajuan')

    @include('components.penjual.modal_confirm_approve')

    @include('components.penjual.modal_reject_reason')
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {


            /*
            =========================================
            INIT DATATABLE
            SEARCH + FILTER BUTTON TOOLBAR
            =========================================
            */

            let table = $('#tablePenitip').DataTable({

                responsive: true,

                order: [
                    [1, 'desc']
                ],

                dom: "<'row mb-3'<'col-md-6'l><'col-md-6 d-flex justify-content-end align-items-center'fB>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",

                buttons: [{
                    text: '<i class="bi bi-funnel"></i>',
                    className: 'btn btn-outline-secondary btn-sm ml-2',
                    action: function() {
                        $('#modalFilter').modal('show');
                    }
                }],

                language: {
                    emptyTable: "Belum ada pengajuan penitip",
                    zeroRecords: "Tidak ada pengajuan yang cocok dengan pencarian"
                },

                columnDefs: [{
                    targets: '_all',
                    defaultContent: '-'
                }]

            });


            /*
            =========================================
            FILTER STATE
            =========================================
            */

            let filterState = {

                active: false,
                start: null,
                end: null,
                status: null

            };



            /*
            =========================================
            SAFE DATE PARSER
            FORMAT TABLE: dd-mm-yyyy
            =========================================
            */

            function parseTanggal(str) {

                if (!str) return null;

                let parts = str.split('-');

                if (parts.length === 3) {

                    let day = parseInt(parts[0]);
                    let month = parseInt(parts[1]) - 1;
                    let year = parseInt(parts[2]);

                    return new Date(year, month, day);

                }

                return null;

            }



            /*
            =========================================
            DATATABLE GLOBAL FILTER ENGINE
            =========================================
            */

            $.fn.dataTable.ext.search.push(function(settings, data) {

                if (settings.nTable.id !== 'tablePenitip')
                    return true;

                if (!filterState.active)
                    return true;

                let rowDate = parseTanggal(data[1]);

                let rowStatus = data[5];

                if (filterState.start && rowDate < filterState.start)
                    return false;

                if (filterState.end && rowDate > filterState.end)
                    return false;

                if (filterState.status &&
                    rowStatus.toLowerCase().indexOf(filterState.status.toLowerCase()) === -1)
                    return false;

                return true;

            });



            /*
            =========================================
            APPLY FILTER
            =========================================
            */

            $('#formFilterPengajuan').submit(function(e) {

                e.preventDefault();

                let dari = $('[name="tanggal_dari"]').val();
                let sampai = $('[name="tanggal_sampai"]').val();
                let status = $('[name="status"]').val();

                filterState = {

                    active: true,

                    start: dari ? new Date(dari + 'T00:00:00') : null,
                    end: sampai ? new Date(sampai + 'T23:59:59') : null,

                    status: status

                };

                table.draw();

                $('#modalFilter').modal('hide');

            });



            /*
            =========================================
            RESET FILTER
            =========================================
            */

            $('#resetFilterPengajuan').click(function() {

                filterState = {

                    active: false,
                    start: null,
                    end: null,
                    status: null

                };

                $('#formFilterPengajuan')[0].reset();

                table.draw();

            });


        });
    </script>

    <script src="{{ asset('js/penjual/pengajuan.js') }}"></script>
@endpush
