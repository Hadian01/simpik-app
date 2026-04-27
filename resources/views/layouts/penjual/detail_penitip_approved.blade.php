@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <h2 class="mb-4">
            Riwayat Pengajuan {{ $penitipName }}
        </h2>

        {{-- TABLE --}}
        <div class="card" style="border:1px solid #ddd;border-radius:8px;overflow:hidden;">
            <div class="table-responsive" style="padding: 10px">

                <table class="table table-hover mb-0" id="tableDetailPengajuan">

                    <thead style="background:#CFC7FF;">
                        <tr>
                            <th style="width:50px;">NO</th>
                            <th>SUBMISSION DATE</th>
                            <th>NAME PRODUK</th>
                            <th>HARGA JUAL</th>
                            <th>HARGA MODAL</th>
                            <th>STOCK</th>
                            <th>VALIDASI STOCK</th>
                            <th>FOTO VALIDASI</th>
                            <th>SISA STOCK</th>
                            <th>FOTO SISA</th>
                            <th>PENDAPATAN PENITIP</th>
                            <th>PENDAPATAN TOKO</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($detail_penitip_approved as $index => $item)
                            <tr>

                                <td>{{ $index + 1 }}</td>

                                <td>{{ $item->created_at ?? '-' }}</td>

                                <td>{{ $item->produk?->produk_name ?? '-' }}</td>

                                <td>
                                    RP{{ number_format($item->harga_jual, 0, ',', '.') }}
                                </td>

                                <td>
                                    RP{{ number_format($item->harga_modal, 0, ',', '.') }}
                                </td>

                                {{-- STOCK --}}
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="{{ $item->stock_qty }}"
                                        style="width:80px;" readonly>
                                </td>

                                {{-- VALIDASI STOCK --}}
                                <td>

                                    @if ($item->stock)
                                        <input type="text" class="form-control form-control-sm"
                                            value="{{ $item->stock }}" style="width:80px;" readonly>
                                    @else
                                        <button class="btn btn-sm btn-edit-stock"
                                            style="background:white;border:1px solid #ddd;padding:5px 15px;border-radius:5px;"
                                            data-type="validasi" data-stock-id="{{ $item->stock_id }}"
                                            data-row="{{ $index + 1 }}"
                                            data-produk="{{ $item->produk?->produk_name ?? '-' }}"
                                            data-stock="{{ $item->stock_qty }}">
                                            <i class="bi bi-pencil"></i> Validasi
                                        </button>
                                    @endif

                                </td>

                                {{-- FOTO VALIDASI --}}
                                <td>

                                    @if ($item->validasi_foto)
                                        <a href="javascript:void(0)" class="text-primary btn-view-foto"
                                            data-foto="{{ asset('storage/stok_validasi/' . $item->validasi_foto) }}"
                                            data-title="Foto Validasi Stock">
                                            Lihat Foto
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                </td>

                                {{-- SISA STOCK --}}
                                <td>

                                    @if ($item->stock)
                                        @if ($item->sisa_stock !== null)
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ $item->sisa_stock }}" style="width:80px;" readonly>
                                        @else
                                            <button class="btn btn-sm btn-edit-stock"
                                                style="background:white;border:1px solid #ddd;padding:5px 15px;border-radius:5px;"
                                                data-type="sisa" data-stock-id="{{ $item->stock_id }}"
                                                data-row="{{ $index + 1 }}"
                                                data-produk="{{ $item->produk?->produk_name }}"
                                                data-stock="{{ $item->stock }}">
                                                <i class="bi bi-pencil"></i> Input
                                            </button>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                </td>

                                {{-- FOTO SISA --}}
                                <td>

                                    @if ($item->sisa_foto)
                                        <a href="javascript:void(0)" class="text-primary btn-view-foto"
                                            data-foto="{{ asset('storage/stok_sisa/' . $item->sisa_foto) }}"
                                            data-title="Foto Sisa Stock">
                                            Lihat Foto
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                </td>

                                {{-- PENDAPATAN PENITIP --}}
                                <td>

                                    @if ($item->stock && $item->sisa_stock !== null)
                                        @php
                                            $terjual = $item->stock - $item->sisa_stock;
                                            $pendapatan_penitip = $terjual * $item->harga_modal;
                                        @endphp
                                        RP {{ number_format($pendapatan_penitip, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                </td>

                                {{-- PENDAPATAN TOKO --}}
                                <td>

                                    @if ($item->stock && $item->sisa_stock !== null)
                                        @php
                                            $terjual = $item->stock - $item->sisa_stock;
                                            $margin = $item->harga_jual - $item->harga_modal;
                                            $pendapatan_toko = $terjual * $margin;
                                        @endphp
                                        RP {{ number_format($pendapatan_toko, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="12" class="text-center text-muted py-4">
                                    Tidak ada data pengajuan untuk penitip ini
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>


    {{-- MODAL VALIDASI STOCK --}}
    <div class="modal fade" id="modalValidasiStock" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">

            <div class="modal-content" style="border-radius:12px;border:none;box-shadow:0 10px 40px rgba(0,0,0,0.15);">

                <div class="modal-header" style="border-bottom:1px solid #e5e7eb;padding:20px 30px;">

                    <h5 class="modal-title" id="modalValidasiTitle">
                        Validasi Stock
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>

                </div>


                <div class="modal-body" style="padding:30px;">

                    <form id="formValidasiStock">

                        <input type="hidden" id="stockType">
                        <input type="hidden" id="stockId">
                        <input type="hidden" id="rowId">
                        <input type="hidden" id="productName">
                        <input type="hidden" id="originalStock">


                        <div class="form-group mb-4">

                            <label>Jumlah Stock</label>

                            <input type="number" class="form-control" id="jumlahStock" min="0"
                                placeholder="Masukkan jumlah stock" required>

                        </div>


                        <div class="form-group mb-3">

                            <label>Upload Foto</label>

                            <input type="file" class="form-control-file" id="uploadFoto" accept="image/*"
                                style="border:2px solid #e5e7eb;border-radius:8px;padding:12px;cursor:pointer;">

                            <small class="text-muted">
                                Format: JPG, PNG, JPEG (Max 2MB)
                            </small>

                        </div>


                        <div id="previewContainer" style="display:none;text-align:center;">

                            <img id="previewImage"
                                style="max-width:100%;max-height:200px;border-radius:8px;border:2px solid #e5e7eb;">

                        </div>

                    </form>

                </div>


                <div class="modal-footer">

                    <button class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;" data-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-sm" style="background:#9B8CFF;color:white;" id="btnSubmitStock">
                        Submit
                    </button>

                </div>

            </div>
        </div>
    </div>


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

@endsection



@push('scripts')
    <script>
        $(document).ready(function() {


            let tableDetail = $('#tableDetailPengajuan').DataTable({
                responsive: true,
                language: {
                    emptyTable: "Tidak ada data pengajuan untuk penitip ini",
                    zeroRecords: "Tidak ada data yang cocok dengan pencarian"
                },
                columnDefs: [{
                    targets: '_all',
                    defaultContent: '-'
                }]
            });


            $('#searchInput').on('keyup', function() {
                tableDetail.search(this.value).draw();
            });



            $(document).on('click', '.btn-edit-stock', function() {

                const type = $(this).data('type');
                const stockId = $(this).data('stock-id');
                const rowId = $(this).data('row');
                const productName = $(this).data('produk');
                const originalStock = $(this).data('stock');

                if (type === 'validasi') {
                    $('#modalValidasiTitle').text('Validasi Stock - ' + productName);
                } else {
                    $('#modalValidasiTitle').text('Validasi sisa stock - ' + productName);
                }

                $('#stockType').val(type);
                $('#stockId').val(stockId);
                $('#rowId').val(rowId);
                $('#productName').val(productName);
                $('#originalStock').val(originalStock);

                $('#jumlahStock').attr('placeholder', 'Stock saat ini: ' + originalStock);

                $('#formValidasiStock')[0].reset();
                $('#previewContainer').hide();
                $('#previewImage').attr('src', '');

                $('#modalValidasiStock').modal('show');

            });



            $('#uploadFoto').on('change', function(e) {

                const file = e.target.files[0];

                if (file) {

                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file maksimal 2MB',
                            confirmButtonColor: '#9B8CFF'
                        });
                        $(this).val('');
                        return;
                    }

                    if (!file.type.match('image.*')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format Salah',
                            text: 'File harus berupa gambar',
                            confirmButtonColor: '#9B8CFF'
                        });
                        $(this).val('');
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result);
                        $('#previewContainer').show();
                    }

                    reader.readAsDataURL(file);
                }

            });


            $(document).on('click', '.btn-view-foto', function() {

                const foto = $(this).data('foto');
                const title = $(this).data('title');

                $('#modalFotoTitle').text(title);
                $('#modalFotoImage').attr('src', foto);

                $('#modalViewFoto').modal('show');

            });



            $('#btnSubmitStock').on('click', function() {

                const type = $('#stockType').val();
                const stockId = $('#stockId').val();
                const jumlahStock = $('#jumlahStock').val();
                const originalStock = $('#originalStock').val();
                const foto = $('#uploadFoto')[0].files[0];

                if (!stockId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Stock ID tidak ditemukan',
                        confirmButtonColor: '#9B8CFF'
                    });
                    return;
                }

                if (!jumlahStock) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Belum Lengkap',
                        text: 'Silakan input jumlah stock',
                        confirmButtonColor: '#9B8CFF'
                    });
                    return;
                }

                // Validasi sisa stock tidak boleh lebih dari validasi stock
                if (type === 'sisa' && parseInt(jumlahStock) > parseInt(originalStock)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Tidak Valid',
                        text: 'Sisa stock tidak boleh lebih dari validasi stock (' + originalStock + ')',
                        confirmButtonColor: '#9B8CFF'
                    });
                    return;
                }

                const formData = new FormData();

                formData.append('_token', '{{ csrf_token() }}');
                formData.append('stock_id', stockId);

                if (type === 'validasi') {
                    formData.append('validated_stock', jumlahStock);
                } else {
                    formData.append('sisa_stock', jumlahStock);
                }

                if (foto) {
                    formData.append('foto', foto);
                }

                const url = type === 'validasi' ?
                    '{{ route('penjual.update_validated_stock') }}' :
                    '{{ route('penjual.update_sisa_stock') }}';


                $.ajax({

                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            confirmButtonColor: '#9B8CFF'
                        }).then(() => {
                            $('#modalValidasiStock').modal('hide');
                            location.reload();
                        });

                    },

                    error: function(xhr) {

                        console.error(xhr);

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal menyimpan data',
                            confirmButtonColor: '#9B8CFF'
                        });

                    }

                });

            });


        });
    </script>
@endpush
