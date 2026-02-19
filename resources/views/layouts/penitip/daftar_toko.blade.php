@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Daftar Toko</h2>

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

</div>

@endsection
