@extends('layouts.app', ['userType' => 'penitip'])

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Toko</h2>
        <button class="btn btn-outline-purple" data-toggle="modal" data-target="#modalFilterToko">
            <i class="bi bi-funnel"></i> Filter
        </button>
    </div>

    <div class="row mb-5">

        @forelse($toko_saya as $item)
            @include('components.penitip.card_toko', [
                'id' => $item->penjual_id,
                'nama' => $item->nama_toko,
                'alamat' => $item->alamat_toko,
                'jam_operasional' =>
                    \Carbon\Carbon::parse($item->jam_buka)->format('H:i')
                    .' - '.
                    \Carbon\Carbon::parse($item->jam_tutup)->format('H:i'),
                'gambar' => null,
                'status' => $item->status_pengajuan
            ])
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Kamu belum mengajukan toko.
                </div>
            </div>
        @endforelse

    </div>


    <h2 class="mb-4">Daftar Toko Lainnya</h2>

    <div class="row">

        @forelse($toko_lainnya as $item)
            @include('components.penitip.card_toko', [
                'id' => $item->penjual_id,
                'nama' => $item->nama_toko,
                'alamat' => $item->alamat_toko,
                'jam_operasional' =>
                    \Carbon\Carbon::parse($item->jam_buka)->format('H:i')
                    .' - '.
                    \Carbon\Carbon::parse($item->jam_tutup)->format('H:i'),
                'gambar' => null,
                'status' => $item->status_pengajuan
            ])
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Tidak ada toko tersedia.
                </div>
            </div>
        @endforelse

    </div>

    {{-- Modal Filter --}}
    <div class="modal fade" id="modalFilterToko" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formFilterToko">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Toko</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status Pengajuan</label>
                            <select class="form-control" name="status">
                                <option value="">Semua Status</option>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                                <option value="not_joined">Belum Join</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-purple" id="resetFilterToko">Reset</button>
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
    // Filter functionality
    $('#formFilterToko').on('submit', function(e) {
        e.preventDefault();
        
        const status = $('[name="status"]').val();
        
        $('.col-md-4').each(function() {
            const card = $(this);
            let show = true;
            
            // Filter by status
            if (status && card.data('status') !== status) {
                show = false;
            }
            
            card.toggle(show);
        });
        
        $('#modalFilterToko').modal('hide');
    });
    
    // Reset filter
    $('#resetFilterToko').on('click', function() {
        $('#formFilterToko')[0].reset();
        $('.col-md-4').show();
        $('#modalFilterToko').modal('hide');
    });
});
</script>
@endpush
