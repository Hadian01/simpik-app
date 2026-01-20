@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================
        DATA DUMMY TOKO
    ========================== --}}
    @php
    $toko = [
        'id' => 1,
        'nama_toko' => 'Toko Kue Maju',
        'pemilik' => 'Hadian Nelvi',
        'alamat' => 'Marina, Kota Batam',
        'no_hp' => '082145687458',
        'email' => 'hadianelvi82@gmai.com',
        'start_operasional' => '2020-09-15',
        'jam_operasional' => 'Every Day, 05.00 - 12.00',
        'deskripsi' => 'Toko dian ini toko pertama saya di masa pandemi untuk membangkitkan perekonomian',
        'banner' => null,
    ];

    $produk_toko = [
        ['id' => 1, 'nama' => 'Kue Lapis', 'gambar' => null],
        ['id' => 2, 'nama' => 'Brownies', 'gambar' => null],
        ['id' => 3, 'nama' => 'Roti Tawar', 'gambar' => null],
        ['id' => 4, 'nama' => 'Donat', 'gambar' => null],
        ['id' => 5, 'nama' => 'Kue Bolu', 'gambar' => null],
        ['id' => 6, 'nama' => 'Kue Cubit', 'gambar' => null],
    ];

    /**
     * STATUS PENGAJUAN
     * not_joined | pending | approved | rejected
     */
    $status_pengajuan = 'not_joined'; // ganti nanti dari DB
    @endphp

    {{-- =========================
        HEADER + ACTION BUTTON
    ========================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $toko['nama_toko'] }}</h2>

        {{-- ACTION BUTTON DINAMIS --}}
        @if($status_pengajuan === 'not_joined')
            <button id="btnJoinPenitip"
                class="btn"
                style="background:#9B8CFF;color:white"
                data-toggle="modal"
                data-target="#modalJoin">
                ➕ Join Sebagai Penitip
            </button>

            <button id="btnStatusPengajuan"
                class="btn btn-warning"
                data-toggle="modal"
                data-target="#modalStatusPengajuan"
                style="display:none">
                ⏳ Menunggu Approval
            </button>

        @elseif($status_pengajuan === 'pending')
            <button
                class="btn btn-warning"
                data-toggle="modal"
                data-target="#modalStatusPengajuan">
                ⏳ Menunggu Approval
            </button>

        @elseif($status_pengajuan === 'approved')
            <span class="badge badge-success px-3 py-2">
                ✔️ Anda sudah menjadi penitip
            </span>

        @elseif($status_pengajuan === 'rejected')
            <button
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#modalStatusPengajuan">
                ❌ Pengajuan Ditolak
            </button>
        @endif
    </div>

    {{-- =========================
        BANNER TOKO
    ========================== --}}
    @include('components.penitip.banner_toko', [
        'banner' => $toko['banner'],
        'nama_toko' => $toko['nama_toko']
    ])

    <div class="row">

        {{-- INFO TOKO --}}
        <div class="col-md-6 mb-4">
            @include('components.penitip.detail_toko', [
                'nama_toko' => $toko['nama_toko'],
                'pemilik' => $toko['pemilik'],
                'alamat' => $toko['alamat'],
                'no_hp' => $toko['no_hp'],
                'email' => $toko['email'],
                'start_operasional' => $toko['start_operasional'],
                'jam_operasional' => $toko['jam_operasional'],
                'deskripsi' => $toko['deskripsi']
            ])
        </div>

        {{-- PRODUK TOKO --}}
        <div class="col-md-6">
            <div class="card" style="border:1px solid #ddd;border-radius:8px;padding:20px;">
                <h5 class="mb-3">Produk {{ $toko['nama_toko'] }}</h5>

                <div class="row">
                    @foreach($produk_toko as $produk)
                        @include('components.penitip.list_produk', [
                            'nama' => $produk['nama'],
                            'gambar' => $produk['gambar']
                        ])
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

{{-- MODAL JOIN --}}
@include('layouts.penitip.join_penitip')

{{-- MODAL STATUS --}}
@include('components.penitip.modal_status_pengajuan')

@endsection
