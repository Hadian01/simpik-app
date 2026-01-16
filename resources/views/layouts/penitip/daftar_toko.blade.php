@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- SECTION 1: Daftar Toko (Approved) --}}
    <h2 class="mb-4">Daftar Toko</h2>

    <div class="row mb-5">

        @php
        // DATA DUMMY - Toko yang sudah approved
        $toko_approved = [
            [
                'id' => 1,
                'nama' => 'Dian Toko',
                'alamat' => 'Bengkong Indonesia',
                'jam_operasional' => '07.00 - 11.00',
                'gambar' => null, // atau 'images/toko1.jpg'
                'is_approved' => true
            ],
            [
                'id' => 2,
                'nama' => 'Toko Kue Manis',
                'alamat' => 'Batam Center',
                'jam_operasional' => '08.00 - 17.00',
                'gambar' => null,
                'is_approved' => true
            ],
        ];
        @endphp

        {{-- Loop Toko Approved --}}
        @foreach($toko_approved as $toko)
            @include('components.penitip.card_toko', [
                'id' => $toko['id'],
                'nama' => $toko['nama'],
                'alamat' => $toko['alamat'],
                'jam_operasional' => $toko['jam_operasional'],
                'gambar' => $toko['gambar'],
                'is_approved' => $toko['is_approved']
            ])
        @endforeach

    </div>

    {{-- SECTION 2: Daftar Toko Lainnya (Pending) --}}
    <h2 class="mb-4">Daftar Toko Lainnya</h2>

    <div class="row">

        @php
        // DATA DUMMY - Toko yang belum approved
        $toko_pending = [
            [
                'id' => 3,
                'nama' => 'Toko Roti Segar',
                'alamat' => 'Nagoya',
                'jam_operasional' => '06.00 - 12.00',
                'gambar' => null,
                'is_approved' => false
            ],
            [
                'id' => 4,
                'nama' => 'Kue Tradisional',
                'alamat' => 'Sei Panas',
                'jam_operasional' => '09.00 - 16.00',
                'gambar' => null,
                'is_approved' => false
            ],
            [
                'id' => 5,
                'nama' => 'Bakery Corner',
                'alamat' => 'Muka Kuning',
                'jam_operasional' => '07.00 - 18.00',
                'gambar' => null,
                'is_approved' => false
            ],
        ];
        @endphp

        {{-- Loop Toko Pending --}}
        @foreach($toko_pending as $toko)
            @include('components.penitip.card_toko', [
                'id' => $toko['id'],
                'nama' => $toko['nama'],
                'alamat' => $toko['alamat'],
                'jam_operasional' => $toko['jam_operasional'],
                'gambar' => $toko['gambar'],
                'is_approved' => $toko['is_approved']
            ])
        @endforeach

    </div>
</div>

@endsection
