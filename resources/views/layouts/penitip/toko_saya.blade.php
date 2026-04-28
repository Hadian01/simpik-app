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
            </ul>

            {{-- ALERT SUCCESS PADA SAAT MENAMBAHKAN PRODUK HARIAN --}}
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
                                {{-- Ini untuk judul Pada card list produk --}}
                                <h5 class="mb-3">Produk {{ $toko['nama_toko'] }}</h5>

                                <div class="row">
                                    @forelse ($produk_display as $produk)
                                        @include('components.penitip.list_produk', [
                                            'id' => $produk->produk_id,
                                            'nama' => $produk->produk_name,
                                            'gambar' => $produk->foto_produk,
                                        ])
                                    @empty
                                        <div class="col-12 text-center text-muted py-4">
                                            <p>Belum ada produk yang disetujui di toko ini</p>
                                        </div>
                                    @endforelse
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
                                        <th>HARGA MODAL</th>
                                        <th>PENDAPATAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($riwayat_list as $item)
                                        <tr>
                                            <td>{{ $item['no'] }}</td>
                                            <td>{{ $item['submission_date'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['nama_toko'] }}</td>
                                            <td>{{ $item['stock'] }}</td>
                                            <td>{{ $item['stock_terjual'] }}</td>
                                            <td>{{ $item['harga_modal'] }}</td>
                                            <td>{{ $item['pendapatan'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                Belum ada data riwayat
                                            </td>
                                        </tr>
                                    @endforelse
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

                        <div class="d-flex" style="gap: 0.5rem;">

                            <button class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;padding: 8px 16px;" data-toggle="modal" data-target="#modalFilterRiwayat">

                                <i class="bi bi-funnel"></i> Filter

                            </button>

                            <button class="btn btn-sm" style="background:#9B8CFF;color:white;padding: 8px 16px;" data-toggle="modal"
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
                                        <th>HARGA MODAL</th>
                                        <th>STOCK</th>
                                        <th>VALIDASI STOCK</th>
                                        <th>VALIDASI FOTO</th>
                                        <th>SISA STOCK</th>
                                        <th>STOCK TERJUAL</th>
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
                                                Rp {{ number_format($item['harga_modal'], 0, ',', '.') }}
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
                                            <td class="text-center">
                                                @if(isset($item['stock_terjual']) && $item['stock_terjual'] !== null)
                                                    {{ $item['stock_terjual'] }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
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
                                                @if(isset($item['sisa_stock']) && $item['sisa_stock'] !== null)
                                                    Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="12" class="text-center text-muted py-4">
                                                Belum ada data riwayat
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

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
                @include('components.penitip.modal_filter', [
                    'produk_toko' => $produk_toko,
                ])

                {{-- MODAL VIEW FOTO --}}
                <div class="modal fade" id="modalViewFoto" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="border-radius:12px;">
                            <div class="modal-header">
                                <h5 id="modalFotoTitle">Foto</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalFotoImage" src="" class="img-fluid rounded"
                                    style="max-height:500px;border:1px solid #ddd;">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CSS TAB ACTIVE --}}
                <style>
                    table.dataTable {
                        width: 100% !important;
                    }

                    table.dataTable thead th {
                        white-space: nowrap;
                    }

                    /* Styling untuk tabel Riwayat Penjualan agar tidak ada scroll horizontal */
                    #tableRiwayatPengajuan {
                        font-size: 13px;
                    }

                    #tableRiwayatPengajuan thead th,
                    #tableRiwayatPengajuan tbody td {
                        padding: 8px 4px !important;
                        vertical-align: middle;
                    }

                    #tableRiwayatPengajuan thead th {
                        font-size: 12px;
                        font-weight: 600;
                        text-align: center;
                    }

                    #tableRiwayatPengajuan tbody td {
                        font-size: 13px;
                    }

                    /* Atur width kolom-kolom */
                    #tableRiwayatPengajuan th:nth-child(1),
                    #tableRiwayatPengajuan td:nth-child(1) {
                        width: 40px;
                        text-align: center;
                    }

                    #tableRiwayatPengajuan th:nth-child(2),
                    #tableRiwayatPengajuan td:nth-child(2) {
                        width: 90px;
                    }

                    #tableRiwayatPengajuan th:nth-child(3),
                    #tableRiwayatPengajuan td:nth-child(3) {
                        width: 100px;
                    }

                    #tableRiwayatPengajuan th:nth-child(4),
                    #tableRiwayatPengajuan td:nth-child(4),
                    #tableRiwayatPengajuan th:nth-child(5),
                    #tableRiwayatPengajuan td:nth-child(5),
                    #tableRiwayatPengajuan th:nth-child(12),
                    #tableRiwayatPengajuan td:nth-child(12) {
                        width: 80px;
                        text-align: right;
                    }

                    #tableRiwayatPengajuan th:nth-child(6),
                    #tableRiwayatPengajuan td:nth-child(6),
                    #tableRiwayatPengajuan th:nth-child(7),
                    #tableRiwayatPengajuan td:nth-child(7),
                    #tableRiwayatPengajuan th:nth-child(9),
                    #tableRiwayatPengajuan td:nth-child(9),
                    #tableRiwayatPengajuan th:nth-child(10),
                    #tableRiwayatPengajuan td:nth-child(10) {
                        width: 60px;
                        text-align: center;
                    }

                    #tableRiwayatPengajuan th:nth-child(8),
                    #tableRiwayatPengajuan td:nth-child(8),
                    #tableRiwayatPengajuan th:nth-child(11),
                    #tableRiwayatPengajuan td:nth-child(11) {
                        width: 70px;
                        text-align: center;
                    }

                    /* Untuk link foto, buat text lebih kecil */
                    #tableRiwayatPengajuan .btn-view-foto {
                        font-size: 12px;
                        padding: 2px 6px;
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
                    $(document).ready(function() {

                        /*
                        ================================
                        AUTO SWITCH TAB FROM URL
                        Check query parameter and switch tab
                        ================================
                        */
                        const urlParams = new URLSearchParams(window.location.search);
                        const tabParam = urlParams.get('tab');

                        if (tabParam) {
                            const tabElement = document.getElementById(tabParam + '-tab');
                            if (tabElement) {
                                $(tabElement).tab('show');
                            }
                        }

                        /*
                        ================================
                        LAZY INIT DATATABLES
                        Initialize only when tab is shown
                        ================================
                        */

                        let tableRiwayat = null;
                        let tableRiwayatPengajuan = null;

                        // Initialize Dashboard table when tab is shown
                        $('a[href="#dashboard"]').on('shown.bs.tab', function (e) {
                            if (tableRiwayat === null) {
                                tableRiwayat = $('#tableRiwayat').DataTable({
                                    responsive: true,
                                     dom:
                                        "<'row mb-3'<'col-md-6'l><'col-md-6 d-flex justify-content-end align-items-center'fB>>" +
                                        "<'row'<'col-12'tr>>" +
                                        "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
                                        lengthMenu: [
                                            [5, 8, 10, 15, 25, 50],
                                            ['5 ', '8', '10', '15', '25', '50']
                                        ],
                                        pageLength: 10,
                                    buttons: [{
                                        text: '<i class="bi bi-funnel"></i> Filter',
                                        className: 'btn btn-outline-secondary btn-sm ml-2',
                                        action: function() {
                                            $('#modalFilter').modal('show');
                                        }
                                    }],
                                    language: {
                                        emptyTable: "Belum ada data riwayat",
                                        zeroRecords: "Tidak ada data yang cocok dengan pencarian"
                                    },
                                    columnDefs: [{
                                        targets: '_all',
                                        defaultContent: '-'
                                    }]
                                });
                            } else {
                                tableRiwayat.columns.adjust().responsive.recalc();
                            }
                        });

                        // Initialize Riwayat Penjualan table when tab is shown
                        $('a[href="#riwayat"]').on('shown.bs.tab', function (e) {
                            if (tableRiwayatPengajuan === null) {
                                tableRiwayatPengajuan = $('#tableRiwayatPengajuan').DataTable({
                                    responsive: true,
                                    language: {
                                        emptyTable: "Belum ada data riwayat penjualan",
                                        zeroRecords: "Tidak ada data yang cocok dengan pencarian"
                                    },
                                    columnDefs: [{
                                        targets: '_all',
                                        defaultContent: '-'
                                    }]
                                });
                            } else {
                                tableRiwayatPengajuan.columns.adjust().responsive.recalc();
                            }
                        });


                        /*
                        ================================
                        FILTER STATE
                        ================================
                        */

                        let filterState = {

                            tableRiwayat: {
                                active: false,
                                start: null,
                                end: null,
                                produk: null
                            },

                            tableRiwayatPengajuan: {
                                active: false,
                                start: null,
                                end: null,
                                produk: null
                            }

                        };


                        /*
                        ================================
                        DATE PARSER
                        FORMAT TABLE: dd-mm-yyyy
                        ================================
                        */

                        function parseTanggal(str) {

                            if (!str) return null;

                            if (str.includes('-')) {

                                let p = str.split('-');

                                if (p.length === 3) {

                                    // gunakan jam 12 supaya aman timezone
                                    return new Date(
                                        parseInt(p[2]),
                                        parseInt(p[1]) - 1,
                                        parseInt(p[0]),
                                        12, 0, 0
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

                            let tableId = settings.nTable.id;

                            if (!filterState[tableId])
                                return true;

                            let state = filterState[tableId];

                            if (!state.active)
                                return true;

                            let rowDate = parseTanggal(data[1]);
                            let produk = data[2];

                            if (!rowDate)
                                return true;

                            if (state.start && rowDate < state.start)
                                return false;

                            if (state.end && rowDate > state.end)
                                return false;

                            if (state.produk &&
                                produk.toLowerCase() !== state.produk.toLowerCase())
                                return false;

                            return true;

                        });


                        /*
                        ================================
                        APPLY FILTER
                        ================================
                        */

                        function applyFilter(form) {

                            let tableId = form.data('table');

                            if (!tableId) return;

                            let dari = form.find('[name="tanggal_dari"]').val();
                            let sampai = form.find('[name="tanggal_sampai"]').val();
                            let produk = form.find('[name="produk"]').val();

                            filterState[tableId] = {

                                active: true,

                                start: dari ?
                                    new Date(dari + 'T00:00:00') :
                                    null,

                                end: sampai ?
                                    new Date(sampai + 'T23:59:59') :
                                    null,

                                produk: produk

                            };

                            // Only draw if table is initialized
                            if ($.fn.DataTable.isDataTable('#' + tableId)) {
                                $('#' + tableId).DataTable().draw();
                            }

                            form.closest('.modal').modal('hide');

                        }


                        /*
                        ================================
                        RESET FILTER
                        ================================
                        */

                        function resetFilter(form) {

                            let tableId = form.data('table');

                            filterState[tableId] = {

                                active: false,
                                start: null,
                                end: null,
                                produk: null

                            };

                            form[0].reset();

                            // Only draw if table is initialized
                            if ($.fn.DataTable.isDataTable('#' + tableId)) {
                                $('#' + tableId).DataTable().draw();
                            }

                        }


                        /*
                        ================================
                        FORM SUBMIT
                        ================================
                        */

                        $('#formFilter,#formFilterRiwayat').on('submit', function(e) {

                            e.preventDefault();

                            applyFilter($(this));

                        });


                        /*
                        ================================
                        RESET BUTTON
                        ================================
                        */

                        $('#resetFilterDashboard').click(function() {

                            resetFilter($('#formFilter'));

                        });


                        $('#resetFilterRiwayat').click(function() {

                            resetFilter($('#formFilterRiwayat'));

                        });


                        /*
                        ================================
                        VIEW FOTO HANDLER
                        ================================
                        */

                        $(document).on('click', '.btn-view-foto', function() {

                            const foto = $(this).data('foto');
                            const title = $(this).data('title');

                            $('#modalFotoTitle').text(title);
                            $('#modalFotoImage').attr('src', foto);

                            $('#modalViewFoto').modal('show');

                        });

                    });
                </script>
            @endpush
