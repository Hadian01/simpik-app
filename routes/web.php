<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PenjualController;

Route::get('/', function () {
    return view('welcome');
});

// ========== ROUTE PENITIP ==========
Route::prefix('penitip')->name('penitip.')->group(function () {

    Route::get('/daftar_toko',[PenitipController::class, 'daftar_toko'])->name('daftar_toko');
    Route::get('/toko_saya/{id}', [PenitipController::class, 'toko_saya'])->name('toko_saya');
    Route::get('/detail_toko/{penjual_id}',[PenitipController::class, 'detail_toko'])->name('detail_toko');
    Route::get('/dashboard/{id}', [PenitipController::class, 'dashboard'])->name('dashboard');
    Route::post('/join_penitip',[PenitipController::class,'join_penitip'])->name('join_penitip');

    Route::get('/produk', [PenitipController::class, 'show']) -> name('produk');
    Route::get('/detail_produk/{produk_id}', [PenitipController::class, 'detail_produk']) -> name('detail_produk');
    Route::post('/add_produk', [PenitipController::class, 'add_produk']) -> name('add_produk');
    Route::post('/edit_produk', [PenitipController::class, 'edit_produk']) -> name('edit_produk');
    Route::delete('/delete_produk/{id}', [PenitipController::class, 'delete_produk'])->name('delete_produk');
    Route::post('/update_status_produk', [PenitipController::class, 'update_status_produk'])
    ->name('update_status_produk');

    Route::post('/toko_saya/{id}/tambah-jumlah', [PenitipController::class, 'add_jumlah_produk'])
    ->name('add_jumlah_produk');

    Route::get('/detail_produk_v2/{id}', function ($id) {
        return view('layouts.penitip.detail_produk_v2', ['produk_id' => $id]);
    })->name('detail_produk_v2');

    Route::get('/riwayat/{id}', [PenitipController::class, 'riwayat'])
        ->name('riwayat');

    Route::get('/data-diri', function () {
        return view('layouts.penitip.data_diri');
    })->name('data_diri');

});

// ========== ROUTE PENJUAL ==========
Route::prefix('penjual')->name('penjual.')->group(function () {

    Route::get('/dashboard', function () {
    return view('layouts.penjual.dashboard');
    })->name('dashboard');

    Route::get('/penitip',[PenjualController::class, 'show'])->name('penitip');
    Route::get('/pengajuan/{id}/detail',[PenjualController::class, 'getDetailPengajuan'])->name('get_detail_pengajuan');
    Route::get('/penitip-approved', [PenjualController::class, 'show_penitip_approved'])->name('penitip_approved');
    Route::get('/detail-penitip-approved/{penjual_id}', [PenjualController::class, 'show_detail_penitip_approved'])->name('detail_penitip_approved');

    Route::get('/penitip/{penjual_id}/pengajuan', [PenjualController::class, 'show_detail_penitip_approved'])->name('detail_pengajuan_penitip');

    Route::post('/pengajuan/approve',
        [PenjualController::class, 'approve']
    )->name('approve_produk');

    Route::post('/pengajuan/reject',
        [PenjualController::class, 'reject']
    )->name('reject_pengajuan');

    Route::post('/stock/update-validated',
        [PenjualController::class, 'updateValidatedStock']
    )->name('update_validated_stock');

    Route::post('/stock/update-sisa',
        [PenjualController::class, 'updateSisaStock']
    )->name('update_sisa_stock');

    Route::get('/penjual-register-toko', function () {
        return view('layouts.penjual.register_toko');
    })->name('register_toko');

    Route::get('/stok-harian', function () {
        return view('layouts.penjual.stok_harian');
    })->name('stok_harian');
});

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

