@extends('layouts.app', ['userType' => 'penjual'])

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Riwayat Pengajuan Hadian Nelvi</h2>

    {{-- Search & Filter --}}
    @include('components.penitip.search_filter')

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
                        <th>FOTO VALIDASI</th>
                        <th>SISA_STOCK</th>
                        <th>FOTO SISA</th>
                        <th>PENDAPATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detail_penitip_approved as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at ?? '-' }}</td>
                        <td>{{ $item->produk?->produk_name ?? '-' }}</td>
                        <td>RP{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td>RP{{ number_format($item->harga_modal, 0, ',', '.') }}</td>
                        <td>
                            <input type="text" class="form-control form-control-sm" value="{{ $item->stock_qty }}" style="width: 80px;" readonly>
                        </td>
                        <td>
                            @if($item->stock)
                                <input type="text" class="form-control form-control-sm" value="{{ $item->stock }}" style="width: 80px;" readonly>
                            @else
                                <button class="btn btn-sm btn-edit-stock"
                                        style="background: white; border: 1px solid #ddd; padding: 5px 15px; border-radius: 5px;"
                                        data-type="validasi"
                                        data-stock-id="{{ $item->stock_id }}"
                                        data-row="{{ $index + 1 }}"
                                        data-produk="{{ $item->produk?->produk_name ?? '-' }}"
                                        data-stock="{{ $item->stock_qty }}">
                                    <i class="bi bi-pencil"></i> Validasi
                                </button>
                            @endif
                        </td>
                        <td>
                            @if($item->validasi_foto)
                                <a href="javascript:void(0)"
                                class="text-primary btn-view-foto"
                                data-foto="{{ asset('storage/stok_validasi/' . $item->validasi_foto) }}"
                                data-title="Foto Validasi Stock">
                                    Lihat Foto
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->stock)
                                @if($item->sisa_stock !== null)
                                    <input type="text" class="form-control form-control-sm" value="{{ $item->sisa_stock }}" style="width: 80px;" readonly>
                                @else
                                    <button class="btn btn-sm btn-edit-stock"
                                            style="background: white; border: 1px solid #ddd; padding: 5px 15px; border-radius: 5px;"
                                            data-type="sisa"
                                            data-stock-id="{{ $item->stock_id }}"
                                            data-row="{{ $index + 1 }}"
                                            data-produk="{{ $item->produk?->produk_name }}">
                                        <i class="bi bi-pencil"></i> Input
                                    </button>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->sisa_foto)
                                <a href="javascript:void(0)"
                                class="text-primary btn-view-foto"
                                data-foto="{{ asset('storage/stok_sisa/' . $item->sisa_foto) }}"
                                data-title="Foto Sisa Stock">
                                    Lihat Foto
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->stock && $item->sisa_stock !== null)
                                RP {{ number_format(($item->stock - $item->sisa_stock) * $item->harga_modal, 0, ',', '.') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            Tidak ada data pengajuan untuk penitip ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer" style="background: white; border-top: 1px solid #ddd;">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing 1 to {{ count($detail_penitip_approved) }} of 20 entries</small>

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

{{-- MODAL VALIDASI STOCK --}}
<div class="modal fade" id="modalValidasiStock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">

            {{-- Header --}}
            <div class="modal-header" style="border-bottom: 1px solid #e5e7eb; padding: 20px 30px; background: white; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title" id="modalValidasiTitle" style="font-weight: 600; font-size: 1.25rem; color: #1f2937;">Validasi Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.5rem; font-weight: 300; color: #9ca3af; opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body" style="padding: 30px;">
                <form id="formValidasiStock">
                    {{-- Hidden Fields --}}
                    <input type="hidden" id="stockType" name="type">
                    <input type="hidden" id="stockId" name="stock_id">
                    <input type="hidden" id="rowId" name="row_id">
                    <input type="hidden" id="productName" name="product_name">

                    {{-- Jumlah Stock --}}
                    <div class="form-group mb-4">
                        <label for="jumlahStock"
                            style="font-weight: 500; color: #374151; margin-bottom: 8px; display: block;">
                            Jumlah Stock
                        </label>

                        <input type="number"
                            class="form-control"
                            id="jumlahStock"
                            name="jumlah_stock"
                            min="0"
                            placeholder="Masukkan jumlah stock"
                            required
                            style="border: 2px solid #e5e7eb;
                                    border-radius: 8px;
                                    padding: 12px 16px;
                                    font-size: 1rem;
                                    height: 48px;">
                    </div>


                    {{-- Upload Foto --}}
                    <div class="form-group mb-3">
                        <label for="uploadFoto" style="font-weight: 500; color: #374151; margin-bottom: 8px; display: block;">Upload Foto</label>
                        <div class="custom-file-upload" style="position: relative;">
                            <input type="file" class="form-control-file" id="uploadFoto" name="foto" accept="image/*"
                                   style="border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; width: 100%; display: block; cursor: pointer; font-size: 0.95rem;">
                        </div>
                        <small class="form-text" style="color: #9ca3af; font-size: 0.85rem; margin-top: 6px; display: block;">Format: JPG, PNG, JPEG (Max: 2MB)</small>
                    </div>

                    {{-- Preview Image --}}
                    <div id="previewContainer" style="display: none; margin-top: 20px; text-align: center;">
                        <img id="previewImage" src="" alt="Preview"
                             style="max-width: 100%; height: auto; max-height: 200px; border-radius: 8px; border: 2px solid #e5e7eb;">
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="modal-footer" style="border-top: 1px solid #e5e7eb; padding: 20px 30px; background: white; border-radius: 0 0 12px 12px; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn px-4 py-2" data-dismiss="modal"
                        style="background: white; color: #6b7280; border: 1px solid #d1d5db; border-radius: 8px; font-weight: 500; font-size: 0.95rem;">
                    Batal
                </button>
                <button type="button" class="btn px-4 py-2" id="btnSubmitStock"
                        style="background-color: #9B8CFF; color: white; border: none; border-radius: 8px; font-weight: 500; font-size: 0.95rem;">
                    Submit
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalViewFoto" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFotoTitle">Foto</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">
                <img id="modalFotoImage"
                     src=""
                     class="img-fluid rounded"
                     style="max-height:500px; border:1px solid #ddd;">
            </div>
        </div>
    </div>
</div>
<style>
/* Modal Style Enhancement */
#modalValidasiStock .modal-content {
    animation: modalSlideDown 0.3s ease-out;
}

@keyframes modalSlideDown {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#jumlahStock:focus,
#uploadFoto:focus {
    border-color: #9B8CFF !important;
    outline: none;
    box-shadow: 0 0 0 3px rgba(155, 140, 255, 0.1);
}

#btnSubmitStock:hover {
    background-color: #8b7aef !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(155, 140, 255, 0.3);
    transition: all 0.2s;
}

.modal-footer button:first-child:hover {
    background-color: #f9fafb !important;
}
</style>

@endsection

{{-- Script --}}
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

    // Open Modal saat icon pensil diklik
    $('.btn-edit-stock').on('click', function() {
        const type = $(this).data('type');
        const stockId = $(this).data('stock-id');
        const rowId = $(this).data('row');
        const productName = $(this).data('produk');
        const originalStock = $(this).data('stock');

        // Set judul modal berdasarkan tipe
        if (type === 'validasi') {
            $('#modalValidasiTitle').text('Validasi Stock - ' + productName);
        } else {
            $('#modalValidasiTitle').text('Validasi sisa stock - ' + productName);
        }

        // Set hidden fields
        $('#stockType').val(type);
        $('#stockId').val(stockId);
        $('#rowId').val(rowId);
        $('#productName').val(productName);

        // Set placeholder dengan nilai original stock
        $('#jumlahStock').attr('placeholder', 'Stock saat ini: ' + originalStock);

        // Reset form
        $('#formValidasiStock')[0].reset();
        $('#previewContainer').hide();
        $('#previewImage').attr('src', '');

        // Show modal
        $('#modalValidasiStock').modal('show');
    });

    // Preview gambar saat file dipilih
    $('#uploadFoto').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                $(this).val('');
                return;
            }

            // Validasi tipe file
            if (!file.type.match('image.*')) {
                alert('File harus berupa gambar');
                $(this).val('');
                return;
            }

            // Preview
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#previewContainer').show();
            }
            reader.readAsDataURL(file);
        }
    });

    // View Foto
    $('.btn-view-foto').on('click', function () {
        const foto = $(this).data('foto');
        const title = $(this).data('title');

        $('#modalFotoTitle').text(title);
        $('#modalFotoImage').attr('src', foto);

        $('#modalViewFoto').modal('show');
    });

    // Submit form
    $('#btnSubmitStock').on('click', function() {
        const type = $('#stockType').val();
        const stockId = $('#stockId').val();
        const jumlahStock = $('#jumlahStock').val();
        const foto = $('#uploadFoto')[0].files[0];

        // Validasi
        if (!stockId) {
            alert('Stock ID tidak ditemukan');
            return;
        }

        if (!jumlahStock) {
            alert('Silakan input jumlah stock');
            return;
        }

        // Buat FormData untuk kirim file
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('stock_id', stockId);

        // Set field name berdasarkan type
        if (type === 'validasi') {
            formData.append('validated_stock', jumlahStock);
        } else {
            formData.append('sisa_stock', jumlahStock);
        }

        if (foto) {
            formData.append('foto', foto);
        }

        // Tentukan URL route berdasarkan type
        const url = type === 'validasi'
            ? '{{ route("penjual.update_validated_stock") }}'
            : '{{ route("penjual.update_sisa_stock") }}';

        // Kirim AJAX
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);

                // Tutup modal
                $('#modalValidasiStock').modal('hide');

                // Reload halaman untuk update table
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr);
                alert('Gagal menyimpan data');
            }
        });
    });
});
</script>
@endpush
