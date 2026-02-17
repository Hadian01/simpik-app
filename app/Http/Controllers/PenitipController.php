<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserManual;
use App\Models\Produk;
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

}
