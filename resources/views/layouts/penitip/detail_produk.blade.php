@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Detail Produk</h2>

    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 30px;">
        <div class="row">

             {{-- Gambar Produk --}}
            <div class="col-md-4">
                <div style="width:100%; height:300px; border:1px solid #ddd; border-radius:8px; overflow:hidden;">

                    @if(!empty($detail_produk->foto_produk))
                        <img src="{{ asset('storage/'.$detail_produk->foto_produk) }}"
                            style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="width:100%; height:100%; background:#f0f0f0; display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-image" style="font-size:64px; color:#999;"></i>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Info Produk --}}
            <div class="col-md-8">
                <h3 class="mb-3">{{ $detail_produk->produk_name }} </h3>

                <table class="table table-borderless">
                    <tr>
                        <td style="width: 150px;"><strong>Nama Produk</strong></td>
                        <td>{{ $detail_produk->produk_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tipe Produk</strong></td>
                        <td>{{ \Illuminate\Support\Str::title($detail_produk->produk_type) }}</td>                    </tr>
                    <tr>
                        <td><strong>Harga Modal</strong></td>
                        <td>Rp {{ $detail_produk->harga_modal }}</td>
                    </tr>
                    <tr>
                        <td><strong>Harga Jual</strong></td>
                        <td>Rp {{ $detail_produk->harga_jual }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>

                            @if($detail_produk->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif

                        </td>
                    </tr>
                </table>

                {{-- Tombol --}}
                <div class="mt-4">
                     {{-- EDIT --}}
                    <button class="btn btn-purple"
                        onclick="openEditProduk({
                            produk_id: {{ $detail_produk->produk_id }},
                            produk_type: '{{ $detail_produk->produk_type }}',
                            produk_name: '{{ $detail_produk->produk_name }}',
                            produk_description: '{{ $detail_produk->produk_description }}',
                            harga_modal: {{ $detail_produk->harga_modal }},
                            harga_jual: {{ $detail_produk->harga_jual }},
                            is_active: {{ $detail_produk->is_active ? 'true' : 'false' }},
                            foto_produk: '{{ $detail_produk->foto_produk }}'
                        })">
                        Edit
                    </button>

                    {{-- HAPUS --}}
                    <button class="btn btn-danger"
                        onclick="hapusProduk({{ $detail_produk->produk_id }})">
                        Hapus Produk
                    </button>
                    <a href="{{ route('penitip.produk') }}" class="btn btn-outline-purple">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@include('layouts.penitip.add_produk')
