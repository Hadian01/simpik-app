{{-- KOMPONEN INFO TOKO --}}
<div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">

    <div class="mb-3">
        <label class="small mb-1">Nama Toko</label>
        <input type="text" class="form-control" value="{{ $nama_toko }}" readonly style="background: #f5f5f5;">
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label class="small mb-1">Pemilik Toko</label>
            <input type="text" class="form-control" value="{{ $pemilik }}" readonly style="background: #f5f5f5;">
        </div>
        <div class="col-6">
            <label class="small mb-1">Alamat Toko</label>
            <input type="text" class="form-control" value="{{ $alamat }}" readonly style="background: #f5f5f5;">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label class="small mb-1">No HP Toko</label>
            <input type="text" class="form-control" value="{{ $no_hp }}" readonly style="background: #f5f5f5;">
        </div>
        <div class="col-6">
            <label class="small mb-1">Email Toko</label>
            <input type="text" class="form-control" value="{{ $email }}" readonly style="background: #f5f5f5;">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label class="small mb-1">Start Operasional</label>
            <input type="text" class="form-control" value="{{ $start_operasional }}" readonly style="background: #f5f5f5;">
        </div>
        <div class="col-6">
            <label class="small mb-1">Jam Operasional</label>
            <input type="text" class="form-control" value="{{ $jam_operasional }}" readonly style="background: #f5f5f5;">
        </div>
    </div>

    <div>
        <label class="small mb-1">Deskripsi Toko</label>
        <textarea class="form-control" rows="3" readonly style="background: #f5f5f5;">{{ $deskripsi }}</textarea>
    </div>

</div>
