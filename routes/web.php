<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ========== ROUTE PENITIP ==========
Route::prefix('penitip')->name('penitip.')->group(function () {

    Route::get('/daftar_toko', function () {
        return view('layouts.penitip.daftar_toko');
    })->name('daftar_toko');

    Route::get('/toko_saya/{id}', function ($id) {
        return view('layouts.penitip.toko_saya', ['toko_id' => $id]);
    })->name('toko_saya');

    Route::get('/detail_toko/{id}', function ($id) {
        return view('layouts.penitip.detail_toko', ['toko_id' => $id]);
    })->name('detail_toko');

    Route::get('/produk', function () {
        return view('layouts.penitip.produk');
    })->name('produk');

    Route::get('/detail_produk/{id}', function ($id) {
        return view('layouts.penitip.detail_produk', ['produk_id' => $id]);
    })->name('detail_produk');

    Route::get('/detail_produk_v2/{id}', function ($id) {
        return view('layouts.penitip.detail_produk_v2', ['produk_id' => $id]);
    })->name('detail_produk_v2');

    Route::get('/riwayat', function () {
        return view('layouts.penitip.riwayat');
    })->name('riwayat');
});

// ========== ROUTE PENJUAL ==========
Route::prefix('penjual')->name('penjual.')->group(function () {

    Route::get('/dashboard', function () {
    return view('layouts.penjual.dashboard');
    })->name('dashboard');

    Route::get('/penitip', function () {
        return view('layouts.penjual.list_penitip');  // Halaman pengajuan (yang lama)
    })->name('penitip');

    Route::get('/penitip-approved', function () {
        return view('layouts.penjual.list_penitip_approved');  // Halaman penitip approved (BARU)
    })->name('penitip_approved');

    Route::get('/penitip/{id}/pengajuan', function ($id) {
        return view('layouts.penjual.detail_penitip_approved', ['penitip_id' => $id]);  // Detail pengajuan per penitip (BARU)
    })->name('detail_pengajuan_penitip');

    Route::get('/penjual-register-toko', function () {
        return view('layouts.penjual.register_toko');
    })->name('register_toko');

    Route::get('/stok-harian', function () {
        return view('layouts.penjual.stok_harian');
    })->name('stok_harian');
});
