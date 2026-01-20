@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2 class="mb-4">Daftar Toko</h2>

<div class="row mb-5">

@php
$toko_approved = [
    [
        'id' => 1,
        'nama' => 'Dian Toko',
        'alamat' => 'Bengkong Indonesia',
        'jam_operasional' => '07.00 - 11.00',
        'gambar' => null,
        'status' => 'approved'
    ],
    [
        'id' => 2,
        'nama' => 'Toko Kue Manis',
        'alamat' => 'Batam Center',
        'jam_operasional' => '08.00 - 17.00',
        'gambar' => null,
        'status' => 'pending'
    ],
    [
        'id' => 2,
        'nama' => 'Toko Kue Manis',
        'alamat' => 'Batam Center',
        'jam_operasional' => '08.00 - 17.00',
        'gambar' => null,
        'status' => 'rejected'
    ],
];
@endphp

@foreach($toko_approved as $toko)
    @include('components.penitip.card_toko', [
        'id' => $toko['id'],
        'nama' => $toko['nama'],
        'alamat' => $toko['alamat'],
        'jam_operasional' => $toko['jam_operasional'],
        'gambar' => $toko['gambar'],
        'status' => $toko['status']
    ])
@endforeach

</div>

<h2 class="mb-4">Daftar Toko Lainnya</h2>

<div class="row">

@php
$toko_pending = [
    [
        'id' => 3,
        'nama' => 'Toko Roti Segar',
        'alamat' => 'Nagoya',
        'jam_operasional' => '06.00 - 12.00',
        'gambar' => null,
        'status' => 'not_joined'
    ],
    [
        'id' => 4,
        'nama' => 'Kue Tradisional',
        'alamat' => 'Sei Panas',
        'jam_operasional' => '09.00 - 16.00',
        'gambar' => null,
        'status' => 'not_joined'
    ],
    [
        'id' => 5,
        'nama' => 'Bakery Corner',
        'alamat' => 'Muka Kuning',
        'jam_operasional' => '07.00 - 18.00',
        'gambar' => null,
        'status' => 'not_joined'
    ],
];
@endphp

@foreach($toko_pending as $toko)
    @include('components.penitip.card_toko', [
        'id' => $toko['id'],
        'nama' => $toko['nama'],
        'alamat' => $toko['alamat'],
        'jam_operasional' => $toko['jam_operasional'],
        'gambar' => $toko['gambar'],
        'status' => $toko['status']
    ])
@endforeach

</div>
</div>

@endsection
