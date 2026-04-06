@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Penitip</h2>


    {{-- Tabel Penitip --}}
    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div class="table-responsive" style="padding:10px">
            <table class="table table-hover mb-0" id="tablePenitipApproved">
                <thead style="background: #CFC7FF;">
                    <tr>
                        <th style="width:50px;">NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>JOIN DATE</th>
                        <th style="width:80px;text-align:center;">DETAIL</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($penitip_approved as $index => $penitip)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penitip->penitip->name }}</td>
                        <td>{{ $penitip->penitip->user?->email ?? '-' }}</td>
                        <td>{{ $penitip->created_at ? $penitip->created_at->format('d-m-Y') : '-' }}</td>

                        <td class="text-center">
                            <a href="{{ route('penjual.detail_pengajuan_penitip',
                                ['penjual_id' => $penitip->penjual_id]) }}"
                               class="btn btn-sm btn-link p-0">

                                <i class="bi bi-eye"
                                   style="font-size:18px;color:#666;"></i>

                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    {{-- Modal Filter --}}
    <div class="modal fade" id="modalFilter" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formFilter">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Data</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Dari</label>
                            <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Sampai</label>
                            <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-purple" id="resetFilter" data-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn-purple">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {

    /*
    ================================
    INIT DATATABLE
    ================================
    */

    let tablePenitip = $('#tablePenitipApproved').DataTable({
        responsive: true,
        dom:
            "<'row mb-3'<'col-md-6'><'col-md-6 d-flex justify-content-end align-items-center'fB>>" +
            "<'row'<'col-12'tr>>" +
            "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
        buttons: [{
            text: '<i class="bi bi-funnel"></i>',
            className: 'btn btn-outline-secondary btn-sm ml-2',
            action: function() {
                $('#modalFilter').modal('show');
            }
        }]
    });

    /*
    ================================
    MOVE SEARCH INPUT
    ================================
    */

    $('#searchInput').on('keyup', function () {
        tablePenitip.search(this.value).draw();
    });


    /*
    ================================
    FILTER STATE
    ================================
    */

    let filterState = {
        active: false,
        start: null,
        end: null
    };


    /*
    ================================
    DATE PARSER
    ================================
    */

    function parseTanggal(str) {

        if (!str) return null;

        if (str.includes('-')) {

            let p = str.split('-');

            if (p.length === 3) {

                return new Date(
                    parseInt(p[2]),
                    parseInt(p[1]) - 1,
                    parseInt(p[0])
                );
            }
        }

        let fallback = new Date(str);

        return isNaN(fallback) ? null : fallback;
    }


    /*
    ================================
    GLOBAL FILTER ENGINE
    ================================
    */

    $.fn.dataTable.ext.search.push(function(settings, data) {

        if (settings.nTable.id !== 'tablePenitipApproved') return true;

        if (!filterState.active) return true;

        let rowDate = parseTanggal(data[3]);

        if (!rowDate) return true;

        if (filterState.start && rowDate < filterState.start) return false;

        if (filterState.end && rowDate > filterState.end) return false;

        return true;

    });


    /*
    ================================
    APPLY FILTER
    ================================
    */

    $('#formFilter').on('submit', function(e) {

        e.preventDefault();

        let dari   = $('#tanggal_dari').val();
        let sampai = $('#tanggal_sampai').val();

        filterState = {
            active: true,
            start: dari ? new Date(dari) : null,
            end: sampai ? new Date(sampai) : null
        };

        tablePenitip.draw();

        $('#modalFilter').modal('hide');

    });


    /*
    ================================
    RESET FILTER
    ================================
    */

    $('#resetFilter').click(function() {

        filterState = {
            active:false,
            start:null,
            end:null
        };

        $('#formFilter')[0].reset();

        tablePenitip.draw();

    });

});
</script>
@endpush
