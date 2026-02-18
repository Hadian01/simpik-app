@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- ===================== DAFTAR TOKO SAYA ===================== --}}
    <h2 class="mb-4">Daftar Toko</h2>

    <div class="row mb-5">

        @if($toko_saya->count() > 0)
            @foreach($toko_saya as $item)
                @include('components.penitip.card_toko', [
                    'id' => $item->penjual_id,
                    'nama' => $item->nama_toko,
                    'alamat' => $item->alamat_toko,
                    'jam_operasional' =>
                        $item->jam_buka->format('H:i') . ' - ' .
                        $item->jam_tutup->format('H:i'),
                    'gambar' => null,
                    'status' => 'approved'
                ])
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    Kamu belum mengajukan toko.
                </div>
            </div>
        @endif

    </div>

    {{-- ===================== DAFTAR TOKO LAINNYA ===================== --}}
    <h2 class="mb-4">Daftar Toko Lainnya</h2>

    <div class="row">

        @foreach($toko_lainnya as $item)
            @include('components.penitip.card_toko', [
                'id' => $item->penjual_id,
                'nama' => $item->nama_toko,
                'alamat' => $item->alamat_toko,
                'jam_operasional' =>
                    $item->jam_buka->format('H:i') . ' - ' .
                    $item->jam_tutup->format('H:i'),
                'gambar' => null,
                'status' => 'not_joined'
            ])
        @endforeach

    </div>

</div>

@endsection
