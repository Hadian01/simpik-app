@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER + ACTION BUTTON
    ========================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $toko->nama_toko }}</h2>

        {{-- STATUS SEMENTARA (nanti bisa dari tabel pengajuan) --}}
        @php
            $status_pengajuan = 'not_joined';
        @endphp

        @switch($status_pengajuan)

            @case('not_joined')
                @include('components.button', [
                    'type' => 'button',
                    'text' => 'Join Sebagai Penitip',
                    'icon' => '+',
                    'dataToggle' => 'modal',
                    'dataTarget' => '#modalJoin'
                ])
                @break

            @case('pending')
                @include('components.button', [
                    'type' => 'button',
                    'text' => 'Lihat Status Pengajuan',
                    'dataToggle' => 'modal',
                    'dataTarget' => '#modalStatusPengajuan'
                ])
                @break

            @case('rejected')
                <div class="d-flex gap-2">
                    @include('components.button', [
                        'type' => 'button',
                        'text' => 'Lihat Status',
                        'class' => 'mr-2',
                        'dataToggle' => 'modal',
                        'dataTarget' => '#modalStatusPengajuan'
                    ])

                    @include('components.button', [
                        'type' => 'button',
                        'text' => 'Ajukan Ulang',
                        'icon' => '↻',
                        'dataToggle' => 'modal',
                        'dataTarget' => '#modalJoin'
                    ])
                </div>
                @break

            @case('approved')
                <span class="badge badge-success px-3 py-2">
                    ✔️ Anda sudah menjadi penitip
                </span>
                @break

        @endswitch
    </div>

    {{-- =========================
        BANNER TOKO
    ========================== --}}
    @include('components.penitip.banner_toko', [
        'banner' => null,
        'nama_toko' => $toko->nama_toko
    ])

    <div class="row">

        {{-- INFO TOKO --}}
        <div class="col-md-6 mb-4">
            @include('components.penitip.detail_toko', [
                'nama_toko' => $toko->nama_toko,
                'pemilik' => $toko->nama_pemilik,
                'alamat' => $toko->alamat_toko,
                'no_hp' => $toko->no_hp,
                'email' => optional($toko->user)->email ?? '-',
                'start_operasional' => $toko->tanggal_join,
                'jam_operasional' =>
                    $toko->jam_buka->format('H:i') . ' - ' .
                    $toko->jam_tutup->format('H:i'),
                'deskripsi' => $toko->deskripsi_toko
            ])
        </div>

        {{-- PRODUK TOKO (HANYA APPROVED) --}}
        <div class="col-md-6">
            <div class="card" style="border:1px solid #ddd;border-radius:8px;padding:20px;">
                <h5 class="mb-3">Produk {{ $toko->nama_toko }}</h5>

                <div class="row">
                    @forelse($produk as $item)
                        @include('components.penitip.list_produk', [
                            'nama' => $item->produk_name,
                            'gambar' => null
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

{{-- MODAL JOIN --}}
@include('layouts.penitip.join_penitip')

{{-- MODAL STATUS --}}
@include('components.penitip.modal_status_pengajuan')

@endsection
