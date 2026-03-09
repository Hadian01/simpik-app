<div class="modal fade" id="modalJoin" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content" style="border-radius:12px">

<div class="modal-header">

<h5 class="modal-title">Join Sebagai Penitip</h5>

<button type="button" class="close" data-dismiss="modal">
<span>&times;</span>
</button>

</div>


<div class="modal-body">

<form id="formJoin">

<input type="hidden" name="penjual_id" value="{{ $toko->penjual_id }}">
<input type="hidden" name="penitip_id" value="1">

{{-- ALASAN --}}
<div class="mb-4">

<label class="small mb-1">Alasan</label>

<textarea class="form-control"
name="alasan"
rows="3"
required></textarea>

</div>


{{-- PILIH PRODUK --}}
<h6 class="mb-3">Pilih Produk Yang Akan Dititipkan</h6>

<div class="table-responsive">

<table class="table table-bordered table-sm text-center">

<thead style="background:#CFC7FF">

<tr>

<th>No</th>
<th>Nama Produk</th>
<th>Harga Jual</th>
<th>COGS</th>
<th>Pilih</th>

</tr>

</thead>


<tbody>

@foreach($produk_penitip as $i => $item)

<tr>

<td>{{ $i+1 }}</td>

<td>{{ $item->produk_name }}</td>

<td>Rp {{ number_format($item->harga_jual) }}</td>

<td>Rp {{ number_format($item->harga_modal) }}</td>

<td>

<input type="checkbox"
name="produk[]"
value="{{ $item->produk_id }}">

</td>

</tr>

@endforeach

</tbody>

</table>

</div>


<div class="text-center mt-4">

<button type="submit"
class="btn"
style="background:#9B8CFF;color:white;padding:8px 30px;border-radius:8px">

Submit

</button>

</div>

</form>

</div>

</div>
</div>
</div>
