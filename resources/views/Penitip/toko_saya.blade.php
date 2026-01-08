@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <h2 class="mb-4">Toko Hadian Nelvi</h2>

    {{-- TAB Navigation --}}
    <ul class="nav nav-tabs mb-4" id="tokoTab" role="tablist" style="border-bottom: 2px solid #ddd;">
        <li class="nav-item">
            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" style="color: #333; font-weight: 500;">
                Detail Toko
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" style="color: #333; font-weight: 500;">
                Dashboard Pendapatan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" style="color: #333; font-weight: 500;">
                Riwayat Penjualan
            </a>
        </li>
    </ul>

    {{-- TAB Content --}}
    <div class="tab-content" id="tokoTabContent">

        {{-- TAB 1: Detail Toko --}}
        <div class="tab-pane fade show active" id="detail" role="tabpanel">

            {{-- Banner Toko --}}
            <div class="mb-4" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; height: 250px; background: #f0f0f0;">
                <img src="{{ asset('images/banner-default.jpg') }}" alt="Banner Toko" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div class="row">

                {{-- KIRI: Info Toko --}}
                <div class="col-md-6 mb-4">
                    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">

                        <div class="mb-3">
                            <label class="small mb-1">Nama Toko</label>
                            <input type="text" class="form-control" value="Toko Kue Hadian Nelvi" readonly style="background: #f5f5f5;">
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="small mb-1">Pemilik Toko</label>
                                <input type="text" class="form-control" value="Hadian Nelvi" readonly style="background: #f5f5f5;">
                            </div>
                            <div class="col-6">
                                <label class="small mb-1">Alamat Toko</label>
                                <input type="text" class="form-control" value="Marina, Kota Batam" readonly style="background: #f5f5f5;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="small mb-1">No HP Toko</label>
                                <input type="text" class="form-control" value="082145687458" readonly style="background: #f5f5f5;">
                            </div>
                            <div class="col-6">
                                <label class="small mb-1">Email Toko</label>
                                <input type="text" class="form-control" value="hadianelvi82@gmai.com" readonly style="background: #f5f5f5;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="small mb-1">Start Operasional</label>
                                <input type="text" class="form-control" value="2020-09-15" readonly style="background: #f5f5f5;">
                            </div>
                            <div class="col-6">
                                <label class="small mb-1">Jam Operasional</label>
                                <input type="text" class="form-control" value="Every Day, 05.00 - 12.00" readonly style="background: #f5f5f5;">
                            </div>
                        </div>

                        <div>
                            <label class="small mb-1">Deskripsi Toko</label>
                            <textarea class="form-control" rows="3" readonly style="background: #f5f5f5;">Toko dian ini toko pertama saya di masa pandemi untuk membangkitkan perekonomian</textarea>
                        </div>

                    </div>
                </div>

                {{-- KANAN: Produk Toko --}}
                <div class="col-md-6">
                    <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                        <h5 class="mb-3">Produk Toko Hadian</h5>

                        <div class="row">
                            <div class="col-4 mb-3">
                                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                    <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                                    </div>
                                    <div class="p-2 text-center">
                                        <small class="font-weight-bold">Kue Lapis</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 mb-3">
                                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                    <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                                    </div>
                                    <div class="p-2 text-center">
                                        <small class="font-weight-bold">Brownies</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 mb-3">
                                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                    <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                                    </div>
                                    <div class="p-2 text-center">
                                        <small class="font-weight-bold">Roti Tawar</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- TAB 2: Dashboard Pendapatan --}}
        <div class="tab-pane fade" id="dashboard" role="tabpanel">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 30px;">
                <h4 class="mb-4">Dashboard Pendapatan</h4>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card text-center" style="background: #E3DFFF; border: none; padding: 20px;">
                            <h5>Total Penjualan</h5>
                            <h2>Rp 2.500.000</h2>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center" style="background: #E3DFFF; border: none; padding: 20px;">
                            <h5>Produk Terjual</h5>
                            <h2>150</h2>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center" style="background: #E3DFFF; border: none; padding: 20px;">
                            <h5>Komisi</h5>
                            <h2>Rp 250.000</h2>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center" style="background: #E3DFFF; border: none; padding: 20px;">
                            <h5>Pendapatan Bersih</h5>
                            <h2>Rp 2.250.000</h2>
                        </div>
                    </div>
                </div>

                <p class="text-muted mt-3">Dashboard pendapatan untuk bulan ini</p>
            </div>
        </div>

        {{-- TAB 3: Riwayat Penjualan --}}
        <div class="tab-pane fade" id="riwayat" role="tabpanel">
            <div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 30px;">
                <h4 class="mb-4">Riwayat Penjualan</h4>

                <table class="table table-bordered">
                    <thead style="background: #E3DFFF;">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2025-01-05</td>
                            <td>Kue Lapis</td>
                            <td>10</td>
                            <td>Rp 100.000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2025-01-05</td>
                            <td>Brownies</td>
                            <td>5</td>
                            <td>Rp 75.000</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2025-01-04</td>
                            <td>Roti Tawar</td>
                            <td>8</td>
                            <td>Rp 80.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- CSS untuk Tab Active --}}
<style>
.nav-tabs .nav-link.active {
    color: #9B8CFF !important;
    border-bottom: 3px solid #9B8CFF !important;
    font-weight: 600;
}

.nav-tabs .nav-link:hover {
    color: #9B8CFF !important;
}
</style>

@endsection
