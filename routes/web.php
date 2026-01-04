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

// Route Detail Toko
Route::get('/penitip/detail_toko', function () {
    return view('penitip.detail_toko');
})->name('penitip.detail_toko');
