<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserManual;
use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Pengajuan;
use App\Models\PengajuanDetail;
use App\Models\StockHarian;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

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
            'penitip.user',
            'detail.produk'
        ])->findOrFail($id);

        return response()->json([
            'pengajuan_id' => $pengajuan->pengajuan_id,
            'status' => $pengajuan->status,
            'penitip' => $pengajuan->penitip,
            'email' => $pengajuan->penitip->user?->email ?? '-',
            'detail' => $pengajuan->detail
        ]);
    }
    public function approve(Request $request)
    {
        $request->validate([
            'pengajuan_id' => 'required',
            'produk_ids' => 'required|array'
        ]);

        // approve produk yg dicentang
        PengajuanDetail::whereIn(
            'pengajuan_detail_id',
            $request->produk_ids
        )->update([
            'status' => 'Approved'
        ]);

        // update status pengajuan utama
        $pengajuan = Pengajuan::findOrFail($request->pengajuan_id);

        $total = $pengajuan->detail()->count();
        $approved = $pengajuan->detail()
            ->where('status', 'Approved')
            ->count();

        if ($approved > 0) {
            $pengajuan->status = 'Approved';
            $pengajuan->save();
        }

        return response()->json([
            'message' => 'Produk berhasil di-approve'
        ]);
    }
    public function reject(Request $request)
    {
        $request->validate([
            'pengajuan_id' => 'required',
            'reason' => 'required|string'
        ]);

        $pengajuan = Pengajuan::findOrFail($request->pengajuan_id);

        // reject semua detail
        $pengajuan->detail()->update([
            'status' => 'Rejected'
        ]);

        $pengajuan->status = 'Rejected';
        $pengajuan->reject_reason = $request->reason;
        $pengajuan->save();

        return response()->json([
            'message' => 'Pengajuan berhasil ditolak'
        ]);
    }
      public function show_penitip_approved(): View
    {
        $penitip_approved = Pengajuan::where('status', 'Approved')
            ->with('penitip.user')
            ->get();

        return view('layouts.penjual.list_penitip_approved', compact('penitip_approved'));
    }
      public function show_detail_penitip_approved($penjual_id): View
    {
        $detail_penitip_approved = StockHarian::
            where('penjual_id', $penjual_id)
            ->with('penjual.user', 'produk')
            ->get();
        return view('layouts.penjual.detail_penitip_approved', compact('detail_penitip_approved'));
    }

    public function updateValidatedStock(Request $request)
    {
        try {
            $request->validate([
                'stock_id' => 'required|exists:tbl_stock_harian,stock_id',
                'validated_stock' => 'required|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $stock = StockHarian::findOrFail($request->stock_id);

            // Update stock dengan nilai validasi
            $stock->stock = $request->validated_stock;

            // Handle file upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = 'validasi_' . time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/stok_validasi', $filename);
                $stock->validasi_foto = $filename;
            }

            $stock->save();

            return response()->json([
                'message' => 'Validasi stock berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateSisaStock(Request $request)
    {
        try {
            $request->validate([
                'stock_id' => 'required|exists:tbl_stock_harian,stock_id',
                'sisa_stock' => 'required|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $stock = StockHarian::findOrFail($request->stock_id);

            // Update sisa stock
            $stock->sisa_stock = $request->sisa_stock;

            // Hitung dan update pendapatan: (stock - sisa_stock) x harga_modal
            $stock->pendapatan = ($stock->stock - $request->sisa_stock) * $stock->harga_modal;

            // Handle file upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = 'sisa_' . time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/stok_sisa', $filename);
                $stock->sisa_foto = $filename;
            }

            $stock->save();

            return response()->json([
                'message' => 'Sisa stock berhasil disimpan',
                'pendapatan' => $stock->pendapatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
