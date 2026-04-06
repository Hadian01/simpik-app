<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

// Redirect root URL to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// ========== ROUTE PENITIP ==========
Route::prefix('penitip')->name('penitip.')->middleware(['auth:usermanual', 'role:penitip'])->group(function () {

    Route::get('/daftar_toko',[PenitipController::class, 'daftar_toko'])->name('daftar_toko');
    Route::get('/toko_saya/{id}', [PenitipController::class, 'toko_saya'])->name('toko_saya');
    Route::get('/detail_toko/{penjual_id}',[PenitipController::class, 'detail_toko'])->name('detail_toko');
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

    // Data Diri & Password
    Route::get('/data-diri', [PenitipController::class, 'dataDiri'])->name('data_diri');
    Route::put('/update-data-diri', [PenitipController::class, 'updateDataDiri'])->name('update_data_diri');
    Route::get('/edit-password', [PenitipController::class, 'editPassword'])->name('edit_password');
    Route::put('/update-password', [PenitipController::class, 'updatePassword'])->name('update_password');

});

// ========== ROUTE PENJUAL ==========
Route::prefix('penjual')->name('penjual.')->middleware(['auth:usermanual', 'role:penjual'])->group(function () {

    // Register/Lengkapi Data Toko (Pertama Kali)
    Route::get('/register-toko', [PenjualController::class, 'registerToko'])->name('register_toko');
    Route::post('/store-toko', [PenjualController::class, 'storeToko'])->name('store_toko');

    Route::get('/dashboard', [PenjualController::class, 'dashboard'])->name('dashboard');

    // Edit Toko
    Route::get('/edit-toko', [PenjualController::class, 'editToko'])->name('edit_toko');
    Route::put('/update-toko', [PenjualController::class, 'updateToko'])->name('update_toko');

    // Edit Password
    Route::get('/edit-password', [PenjualController::class, 'editPassword'])->name('edit_password');
    Route::put('/update-password', [PenjualController::class, 'updatePassword'])->name('update_password');

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
});

// ========== AUTHENTICATION ROUTES ==========
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== NOTIFICATION ROUTES (Shared) ==========
Route::middleware(['auth:usermanual'])->group(function () {
    Route::get('/notifications/count', [NotificationController::class, 'getUnreadCount'])->name('notifications.count');
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read_all');
});

