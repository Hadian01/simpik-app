@extends('layouts.app')

@section('content')

<div class="container-fluid">

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
                <h3 class="mb-3">Tart Tarik</h3>

                <table class="table table-borderless">
                    <tr>
                        <td style="width: 150px;"><strong>Nama Produk</strong></td>
                        <td>Tart Tarik</td>
                    </tr>
                    <tr>
                        <td><strong>Tipe Produk</strong></td>
                        <td>Kue</td>
                    </tr>
                    <tr>
                        <td><strong>Harga Modal</strong></td>
                        <td>Rp 8.000</td>
                    </tr>
                    <tr>
                        <td><strong>Harga Jual</strong></td>
                        <td>Rp 10.000</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>
                            <span class="badge badge-success">Aktif</span>
                        </td>
                    </tr>
                </table>

                {{-- Tombol --}}
                <div class="mt-4">
                    <button class="btn btn-warning">Edit Produk</button>
                    <button class="btn btn-danger">Hapus Produk</button>
                    <a href="{{ route('penitip.produk') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
