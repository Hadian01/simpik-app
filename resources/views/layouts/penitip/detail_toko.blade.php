@extends('layouts.app')

@section('content')

<div class="container-fluid">

{{-- ================= HEADER ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">

<h2>{{ $toko->nama_toko }}</h2>

{{-- STATUS ACTION --}}
@if($status_pengajuan === 'not_joined')

<button class="btn btn-purple" data-toggle="modal" data-target="#modalJoin">
Join Sebagai Penitip
</button>

@elseif($status_pengajuan === 'pending')

<button class="btn btn-warning" data-toggle="modal" data-target="#modalStatusPengajuan">
Lihat Status Pengajuan
</button>


@elseif($status_pengajuan === 'approved')

<span class="badge badge-success px-3 py-2">
✔️ Anda sudah menjadi penitip
</span>

@elseif($status_pengajuan === 'rejected')

<div class="text-right">

<button class="btn btn-danger" data-toggle="modal" data-target="#modalStatusPengajuan">
Lihat Alasan Penolakan
</button>

</div>

@endif

</div>

{{-- ================= BANNER ================= --}}
@include('components.penitip.banner_toko',[
'banner'=>null,
'nama_toko'=>$toko->nama_toko
])

<div class="row">

{{-- ================= INFO TOKO ================= --}}
<div class="col-md-6 mb-4">

@include('components.penitip.detail_toko',[
'nama_toko'=>$toko->nama_toko,
'pemilik'=>$toko->nama_pemilik,
'alamat'=>$toko->alamat_toko,
'no_hp'=>$toko->no_hp,
'email'=>optional($toko->user)->email ?? '-',
'start_operasional'=>$toko->tanggal_join,

'jam_operasional' =>
($toko->jam_buka && $toko->jam_tutup)
? $toko->jam_buka->format('H:i').' - '.$toko->jam_tutup->format('H:i')
: '-',

'deskripsi'=>$toko->deskripsi_toko
])

</div>


{{-- ================= PRODUK TOKO ================= --}}
<div class="col-md-6">

<div class="card" style="border:1px solid #ddd;border-radius:8px;padding:20px;">

<h5 class="mb-3">Produk {{ $toko->nama_toko }}</h5>

<div class="row">

@forelse($produk as $item)

@include('components.penitip.list_produk',[
'nama'=>$item->produk_name,
'gambar'=>$item->foto_produk
])

@empty

<div class="col-12">
<div class="alert alert-info">
Belum ada produk yang disetujui di toko ini.
</div>
</div>

@endforelse

</div>

</div>

</div>

</div>

</div>

{{-- ================= MODALS ================= --}}
@include('layouts.penitip.join_penitip')
@include('components.penitip.modal_status_pengajuan')

@endsection


@push('scripts')

<script>

$(document).ready(function(){

$('#formJoin').submit(function(e){

e.preventDefault();

let formData = $(this).serialize();

$.ajax({

url:'/penitip/join_penitip',
type:'POST',
data:formData,

headers:{
'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
},

success:function(res){

Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: res.message,
    confirmButtonColor: '#9B8CFF'
});

$('#modalJoin').modal('hide');

setTimeout(function(){
location.reload();
},1500);

},

error:function(xhr){
    let errorMsg = 'Terjadi kesalahan';
    
    if (xhr.responseJSON && xhr.responseJSON.message) {
        errorMsg = xhr.responseJSON.message;
    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
        errorMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
    }
    
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        html: errorMsg,
        confirmButtonColor: '#9B8CFF'
    });
}

});

});

});

</script>

@endpush
