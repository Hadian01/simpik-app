<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserManual;
use App\Models\Produk;
use App\Models\Penjual;
use Illuminate\View\View;

class PenitipController extends Controller
{
    public function show(): View
    {

        $produk = Produk::all();

        return view('layouts.penitip.produk', compact('produk'));

    }
    public function detail_produk(string $produk_id): View
    {
        return view('layouts.penitip.detail_produk', [
            'detail_produk' => Produk::findOrFail($produk_id)
        ]);
    }
    public function daftar_toko(): View
    {
       // Sementara kosong (karena belum ada tabel join)
    $toko_saya = collect();

    // Semua toko tampil sebagai toko lainnya
    $toko_lainnya = Penjual::all();

    return view('layouts.penitip.daftar_toko', compact('toko_saya','toko_lainnya'));
    }
     public function detail_toko(string $penjual_id): View
    {
        $toko = Penjual::findOrFail($penjual_id);

        $produk = Produk::whereHas('approval', function ($query) use ($penjual_id) {
            $query->where('penjual_id', $penjual_id)
                  ->where('status', 'approved');
        })
        ->where('is_active', true)
        ->get();

        return view('layouts.penitip.detail_toko', compact('toko','produk'));
    }

}
