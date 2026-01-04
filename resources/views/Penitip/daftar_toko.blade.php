@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Daftar Toko</h2>

    <div class="row">

        {{-- Card 1 --}}
        <div class="col-md-3 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">
                <div style="width: 100%; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                    <strong style="color: #999;">Gambar</strong>
                </div>
                <div class="card-body">
                    <table class="w-100 small">
                        <tr>
                            <td style="width: 40%;">Nama Toko</td>
                            <td>Dian Toko</td>
                        </tr>
                        <tr>
                            <td>Alamat Toko</td>
                            <td>Bengkong Indonesia</td>
                        </tr>
                        <tr>
                            <td>Jam Operasional</td>
                            <td>07.00 - 11.00</td>
                        </tr>
                    </table>
                    <a href="{{ route('penitip.detail_toko') }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>

        {{-- Card 2 --}}
        <div class="col-md-3 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">
                <div style="width: 100%; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                    <strong style="color: #999;">Gambar</strong>
                </div>
                <div class="card-body">
                    <table class="w-100 small">
                        <tr>
                            <td style="width: 40%;">Nama Toko</td>
                            <td>Dian Toko</td>
                        </tr>
                        <tr>
                            <td>Alamat Toko</td>
                            <td>Bengkong Indonesia</td>
                        </tr>
                        <tr>
                            <td>Jam Operasional</td>
                            <td>07.00 - 11.00</td>
                        </tr>
                    </table>
                    <a href="{{ route('penitip.detail_toko') }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>

        {{-- Card 3 --}}
        <div class="col-md-3 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">
                <div style="width: 100%; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                    <strong style="color: #999;">Gambar</strong>
                </div>
                <div class="card-body">
                    <table class="w-100 small">
                        <tr>
                            <td style="width: 40%;">Nama Toko</td>
                            <td>Dian Toko</td>
                        </tr>
                        <tr>
                            <td>Alamat Toko</td>
                            <td>Bengkong Indonesia</td>
                        </tr>
                        <tr>
                            <td>Jam Operasional</td>
                            <td>07.00 - 11.00</td>
                        </tr>
                    </table>
                    <a href="{{ route('penitip.detail_toko') }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>

        {{-- Card 4 --}}
        <div class="col-md-3 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">
                <div style="width: 100%; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                    <strong style="color: #999;">Gambar</strong>
                </div>
                <div class="card-body">
                    <table class="w-100 small">
                        <tr>
                            <td style="width: 40%;">Nama Toko</td>
                            <td>Dian Toko</td>
                        </tr>
                        <tr>
                            <td>Alamat Toko</td>
                            <td>Bengkong Indonesia</td>
                        </tr>
                        <tr>
                            <td>Jam Operasional</td>
                            <td>07.00 - 11.00</td>
                        </tr>
                    </table>
                    <a href="{{ route('penitip.detail_toko') }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>

        {{-- Card 5 --}}
        <div class="col-md-3 mb-4">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px;">
                <div style="width: 100%; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #ddd;">
                    <strong style="color: #999;">Gambar</strong>
                </div>
                <div class="card-body">
                    <table class="w-100 small">
                        <tr>
                            <td style="width: 40%;">Nama Toko</td>
                            <td>Dian Toko</td>
                        </tr>
                        <tr>
                            <td>Alamat Toko</td>
                            <td>Bengkong Indonesia</td>
                        </tr>
                        <tr>
                            <td>Jam Operasional</td>
                            <td>07.00 - 11.00</td>
                        </tr>
                    </table>
                    <a href="{{ route('penitip.detail_toko') }}" class="btn btn-sm btn-block mt-3" style="background-color: #9B8CFF; color: white; border: none; padding: 8px; border-radius: 5px; text-decoration: none;">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
