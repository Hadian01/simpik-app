@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header dengan Tombol Join --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Toko Hadian Nelvi</h2>
        <button type="button" class="btn" style="background-color: #9B8CFF; color: white; padding: 8px 20px; border-radius: 8px;" data-toggle="modal" data-target="#modalJoin">
            <strong>+</strong> Join sebagai penitip
        </button>
    </div>

    {{-- Banner Toko (DARI DATABASE) --}}
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

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Donat</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Kue Bolu</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Kue Cubit</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Kue Nastar</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Kue Putri Salju</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Kue Pancong</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <div style="width: 100%; height: 100px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 32px; color: #999;"></i>
                            </div>
                            <div class="p-2 text-center">
                                <small class="font-weight-bold">Kue Lumpur</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- INCLUDE MODAL --}}
@include('penitip.join_penitip')

@endsection
