<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route Daftar Toko
Route::get('/penitip/daftar_toko', function () {
    return view('penitip.daftar_toko');
})->name('penitip.daftar_toko');

// Route Toko Saya (dengan parameter ID)
Route::get('/penitip/toko_saya/{id}', function ($id) {
    return view('penitip.toko_saya', ['toko_id' => $id]);
})->name('penitip.toko_saya');

// Route Detail Toko (dengan parameter ID)
Route::get('/penitip/detail_toko/{id}', function ($id) {
    return view('penitip.detail_toko', ['toko_id' => $id]);
})->name('penitip.detail_toko');

// Route Produk Saya
Route::get('/penitip/produk', function () {
    return view('penitip.produk');
})->name('penitip.produk');

// Route Detail Produk
Route::get('/penitip/detail_produk', function () {
    return view('penitip.detail_produk');
})->name('penitip.detail_produk');

// Route Dashboard Penjualan
Route::get('/penitip/dashboard', function () {
    return view('penitip.dashboard');
})->name('penitip.dashboard');
