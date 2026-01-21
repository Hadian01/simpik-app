@extends('layouts.app')

@section('content')


<div class="container-fluid">

@php
$produk = [
    'id' => 1,
    'nama' => 'Tart Tarik',
    'tipe' => 'Kue',
    'harga_modal' => 8000,
    'harga_jual' => 10000,
    'status' => 'pending', // approved | pending | rejected
    'history' => [
        [
            'status' => 'submitted',
            'tanggal' => '2025-01-10',
            'keterangan' => 'Produk diajukan oleh penitip'
        ],
        [
            'status' => 'review',
            'tanggal' => '2025-01-11',
            'keterangan' => 'Sedang direview admin'
        ],
    ]
];
@endphp

    <h2 class="mb-4">Detail Produk</h2>

    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 30px;">
        <div class="row">

            {{-- Gambar Produk --}}
            <div class="col-md-4">
                <div style="width: 100%; height: 300px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border: 1px solid #ddd; border-radius: 8px;">
                    <i class="bi bi-image" style="font-size: 64px; color: #999;"></i>
                </div>
            </div>

            {{-- Info Produk --}}
            <div class="col-md-8">
                <h3 class="mb-3">{{ $produk['nama'] }}</h3>

                <table class="table table-borderless">
                    <tr>
                        <td style="width: 150px;"><strong>Nama Produk</strong></td>
                        <td>{{ $produk['nama'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tipe Produk</strong></td>
                        <td>{{ $produk['tipe'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Harga Modal</strong></td>
                        <td>Rp {{ number_format($produk['harga_modal'],0,',','.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Harga Jual</strong></td>
                        <td>Rp {{ number_format($produk['harga_jual'],0,',','.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>
                            @if($produk['status'] === 'approved')
                                <span class="badge badge-success">Aktif</span>
                            @elseif($produk['status'] === 'pending')
                                <span class="badge badge-warning">In Progress</span>
                            @elseif($produk['status'] === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- Tombol --}}
                <div class="mt-4">

                    @if($produk['status'] === 'approved')
                        <button class="btn btn-warning">Edit Produk</button>
                        <button class="btn btn-danger">Hapus Produk</button>

                    @else
                        <button class="btn btn-outline-primary"
                                data-toggle="modal"
                                data-target="#modalStatusProduk">
                            Lihat Status
                        </button>
                    @endif

                    <a href="{{ route('penitip.produk') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL STATUS PRODUK --}}
@if($produk['status'] !== 'approved')
<div class="modal fade" id="modalStatusProduk" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">History Status Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <ul class="list-group">
                    @foreach($produk['history'] as $item)
                        <li class="list-group-item">
                            <strong>{{ ucfirst($item['status']) }}</strong><br>
                            <small class="text-muted">{{ $item['tanggal'] }}</small>
                            <p class="mb-0">{{ $item['keterangan'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif

@endsection
