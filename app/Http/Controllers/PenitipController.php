<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserManual;
use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Pengajuan;
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
        $penitip_id = 1; // sementara hardcode

        $pengajuan = Pengajuan::with('penjual')
            ->where('penitip_id', $penitip_id)
            ->get();

        // ambil id penjual yang sudah diajukan
        $penjualIds = $pengajuan->pluck('penjual_id');

        // =====================
        // TOKO SAYA (atas)
        // =====================
        $toko_saya = collect();

        foreach ($pengajuan as $item) {
            if ($item->penjual) {
                $toko = $item->penjual;
                $toko->status_pengajuan = $item->status;
                $toko_saya->push($toko);
            }
        }

        // =====================
        // TOKO LAINNYA (bawah)
        // =====================
        $toko_lainnya = Penjual::whereNotIn('penjual_id', $penjualIds)
            ->get();

        foreach ($toko_lainnya as $toko) {
            $toko->status_pengajuan = 'not_joined';
        }

        return view('layouts.penitip.daftar_toko',
            compact('toko_saya','toko_lainnya'));
    }


    // 🔥 INI YANG KURANG TADI
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

    public function toko_saya($id)
    {
        $penitip_id = 1; // sementara hardcode login

        // Ambil data toko
        $toko = Penjual::findOrFail($id);

        // Ambil produk milik penitip
        $produk_toko = Produk::where('penitip_id', $penitip_id)->get();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD DATA (sementara dummy aman)
        |--------------------------------------------------------------------------
        */

        $dashboard = [
            'total_penjualan' => 0,
            'produk_terjual' => 0,
            'komisi' => 0,
            'pendapatan_bersih' => 0,
            'bulan' => now()->format('F Y')
        ];

        /*
        |--------------------------------------------------------------------------
        | STATISTIK CARD
        |--------------------------------------------------------------------------
        */

        $statistik = [
            [
                'title' => 'Total Terjual',
                'value' => 0,
                'bg_color' => '#CFC7FF'
            ],
            [
                'title' => 'Total Dititip',
                'value' => $produk_toko->count(),
                'bg_color' => '#CFC7FF'
            ],
            [
                'title' => 'Total Pendapatan',
                'value' => 'Rp 0',
                'bg_color' => '#CFC7FF'
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | RIWAYAT LIST (kosong dulu biar aman)
        |--------------------------------------------------------------------------
        */

        $riwayat_list = collect();

        /*
        |--------------------------------------------------------------------------
        | PAGINATION DUMMY
        |--------------------------------------------------------------------------
        */

        $total_data = $riwayat_list->count();
        $per_page = 10;
        $current_page = 1;

        return view(
            'layouts.penitip.toko_saya',
            compact(
                'toko',
                'produk_toko',
                'dashboard',
                'statistik',
                'riwayat_list',
                'total_data',
                'per_page',
                'current_page'
            )
        );
    }

}
