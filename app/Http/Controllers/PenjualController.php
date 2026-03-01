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

class PenjualController extends Controller
{
    public function show(): View
    {
        $pengajuan = Pengajuan::with('penitip')
        ->withCount('detail')
        ->withCount(['detail as approved_count' => function ($query) {
            $query->where('status', 'Approved');
        }])->get();
        return view('layouts.penjual.list_penitip', compact('pengajuan'));
    }
    public function getDetailPengajuan($id)
    {
        $pengajuan = Pengajuan::with([
            'penitip',
            'detail.produk'
        ])->findOrFail($id);

        return response()->json($pengajuan);
    }
}
