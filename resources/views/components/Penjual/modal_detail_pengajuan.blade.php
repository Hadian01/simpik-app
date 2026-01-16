<?php

use Illuminate\Support\Facades\Route;

// Route Welcome
Route::get('/', function () {
    return view('welcome');
});

// ========== ROUTE PENITIP ==========
Route::prefix('penitip')->name('penitip.')->group(function () {

    Route::get('/daftar_toko', function () {
        return view('penitip.daftar_toko');
    })->name('daftar_toko');

    Route::get('/toko_saya/{id}', function ($id) {
        return view('penitip.toko_saya', ['toko_id' => $id]);
    })->name('toko_saya');

    Route::get('/detail_toko/{id}', function ($id) {
        return view('penitip.detail_toko', ['toko_id' => $id]);
    })->name('detail_toko');

    Route::get('/produk', function () {
        return view('penitip.produk');
    })->name('produk');

    Route::get('/detail_produk/{id}', function ($id) {
        return view('penitip.detail_produk', ['produk_id' => $id]);
    })->name('detail_produk');

    Route::get('/riwayat', function () {
        return view('penitip.riwayat');
    })->name('riwayat');
});

// ========== ROUTE PENJUAL ==========
Route::prefix('penjual')->name('penjual.')->group(function () {

    Route::get('/dashboard', function () {
        return view('penjual.dashboard');
    })->name('dashboard');

    Route::get('/penitip', function () {
        return view('penjual.list_penitip');
    })->name('penitip');

    Route::get('/riwayat-pengajuan', function () {
        return view('penjual.riwayat_pengajuan');
    })->name('riwayat_pengajuan');

    Route::get('/stok-harian', function () {
        return view('penjual.stok_harian');
    })->name('stok_harian');
});
