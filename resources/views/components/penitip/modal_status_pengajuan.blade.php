{{-- MODAL STATUS PENGAJUAN --}}
<div class="modal fade" id="modalStatusPengajuan" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content" style="border-radius:12px;">

<div class="modal-header">
<h5 class="modal-title">
<i class="bi bi-clock-history"></i>
Status Pengajuan Penitip
</h5>

<button type="button" class="close" data-dismiss="modal">
<span>&times;</span>
</button>
</div>

<div class="modal-body">

@php
$status = $status_pengajuan;
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<strong>Toko:</strong> {{ $toko->nama_toko }}<br>
<small class="text-muted">Pengajuan Anda sebagai penitip</small>
</div>

@if($status === 'pending')

<span class="badge badge-warning px-3 py-2">
⏳ Menunggu Approval
</span>

@elseif($status === 'approved')

<span class="badge badge-success px-3 py-2">
✔️ Disetujui
</span>

@elseif($status === 'rejected')

<span class="badge badge-danger px-3 py-2">
❌ Ditolak
</span>

@endif

</div>


<ul class="list-group mb-4">

<li class="list-group-item">
<strong>📨 Pengajuan Dikirim</strong><br>

<small class="text-muted">
{{ $pengajuan ? \Carbon\Carbon::parse($pengajuan->created_at)->format('d F Y H:i') : '-' }}
</small>

</li>

<li class="list-group-item">
<strong>🔍 Sedang Diproses Admin</strong>
</li>

@if($status === 'approved')

<li class="list-group-item list-group-item-success">
<strong>✅ Disetujui</strong><br>
<small>Selamat! Anda resmi menjadi penitip.</small>
</li>

@endif


@if($status === 'rejected')

<li class="list-group-item list-group-item-danger">
<strong>❌ Ditolak</strong><br>
<small>Silakan ajukan ulang.</small>
</li>

@endif

</ul>


@if($status === 'rejected')

<div class="alert alert-danger">

<strong>Catatan Admin:</strong><br>

{{ $pengajuan->catatan_admin ?? 'Pengajuan ditolak oleh admin.' }}

</div>

@endif


<div class="text-center">

<button class="btn btn-secondary" data-dismiss="modal">
Tutup
</button>

@if($status === 'rejected')

<button class="btn btn-warning ml-2"
data-toggle="modal"
data-target="#modalJoin"
data-dismiss="modal">

Ajukan Ulang

</button>

@endif

</div>

</div>
</div>
</div>
</div>
