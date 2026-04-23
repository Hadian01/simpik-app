<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengajuan;
use App\Models\PengajuanDetail;
use App\Models\StockHarian;
use App\Models\Penjual;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class PenjualController extends Controller
{
    /**
     * Get authenticated penjual
     */
    protected function getAuthPenjual()
    {
        $user = Auth::guard('usermanual')->user();

        if (!$user || $user->user_type !== 'penjual') {
            abort(403, 'Unauthorized');
        }

        $penjual = $user->penjual;

        if (!$penjual) {
            abort(404, 'Data penjual tidak ditemukan');
        }

        return $penjual;
    }

    /**
     * Dashboard Penjual
     */
    public function dashboard(Request $request)
    {
        // Ambil data penjual yang sedang login
        $penjual = $this->getAuthPenjual();

        // Filter dari request (untuk grafik monthly dan yearly)
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        // Total Produk yang sudah di-approve
        $totalProduk = PengajuanDetail::whereHas('pengajuan', function($query) use ($penjual) {
            $query->where('penjual_id', $penjual->penjual_id);
        })->where('status', 'Approved')->count();

        // Data dari Stock Harian dengan filter (hanya yang sudah divalidasi)
        $stockQuery = StockHarian::where('penjual_id', $penjual->penjual_id)
            ->whereNotNull('sisa_stock'); // Hanya yang sudah validasi stock

        // Jika ada filter bulan
        if ($request->filled('bulan')) {
            $stockQuery->whereMonth('date', $bulan);
        }

        // Jika ada filter tahun
        if ($request->filled('tahun')) {
            $stockQuery->whereYear('date', $tahun);
        }

        $stockData = $stockQuery->get();

        // Total Terjual (stock - sisa_stock)
        $totalTerjual = 0;
        $totalPendapatan = 0;
        $totalOmset = 0;

        foreach ($stockData as $stock) {
            $stockQty = is_numeric($stock->stock) ? (int)$stock->stock : 0;
            $sisaStock = is_numeric($stock->sisa_stock) ? (int)$stock->sisa_stock : 0;
            $terjual = $stockQty - $sisaStock;

            $totalTerjual += $terjual;

            // Pendapatan (untuk penjual) - HITUNG ULANG DARI MARGIN
            $hargaJual = is_numeric($stock->harga_jual) ? (float)$stock->harga_jual : 0;
            $hargaModal = is_numeric($stock->harga_modal) ? (float)$stock->harga_modal : 0;
            $margin = $hargaJual - $hargaModal;
            $totalPendapatan += ($terjual * $margin);

            // Omset (total penjualan)
            $totalOmset += ($terjual * $hargaJual);
        }

        // Data Penitip - Monthly (untuk bar chart) - Jumlah Produk Terjual
        $monthlyQuery = StockHarian::join('tbl_produk', 'tbl_stock_harian.produk_id', '=', 'tbl_produk.produk_id')
            ->join('tbl_penitip', 'tbl_produk.penitip_id', '=', 'tbl_penitip.penitip_id')
            ->select('tbl_penitip.name as penitip_name',
                DB::raw('SUM(CAST(tbl_stock_harian.stock AS INTEGER) - COALESCE(CAST(tbl_stock_harian.sisa_stock AS INTEGER), 0)) as total_terjual'))
            ->where('tbl_stock_harian.penjual_id', $penjual->penjual_id)
            ->whereNotNull('tbl_stock_harian.sisa_stock')
            ->whereMonth('tbl_stock_harian.date', $bulan)
            ->whereYear('tbl_stock_harian.date', $tahun)
            ->groupBy('tbl_penitip.name')
            ->orderBy('total_terjual', 'desc')
            ->limit(6);

        $monthlyData = $monthlyQuery->get();

        // Data Produk Terjual - Yearly (per bulan dalam tahun ini)
        $yearlyData = collect();
        for ($month = 1; $month <= 12; $month++) {
            $terjual = StockHarian::where('penjual_id', $penjual->penjual_id)
                ->whereNotNull('sisa_stock')
                ->whereMonth('date', $month)
                ->whereYear('date', $tahun)
                ->sum(DB::raw('CAST(stock AS INTEGER) - COALESCE(CAST(sisa_stock AS INTEGER), 0)'));

            $yearlyData->push([
                'month' => date('M', mktime(0, 0, 0, $month, 1)),
                'terjual' => $terjual ?? 0
            ]);
        }

        // Top 3 Produk dengan Margin/Pendapatan Tertinggi
        $topProductsQuery = StockHarian::with('produk.penitip')
            ->select('produk_id', 'created_by',
                DB::raw('SUM(CAST(stock AS INTEGER) - COALESCE(CAST(sisa_stock AS INTEGER), 0)) as total_terjual'),
                DB::raw('SUM(CAST(pendapatan AS DECIMAL)) as total_pendapatan'),
                DB::raw('SUM((CAST(stock AS INTEGER) - COALESCE(CAST(sisa_stock AS INTEGER), 0)) * CAST(harga_jual AS DECIMAL)) as total_omset')
            )
            ->where('penjual_id', $penjual->penjual_id)
            ->whereNotNull('sisa_stock');

        if ($request->filled('bulan')) {
            $topProductsQuery->whereMonth('date', $bulan);
        }

        if ($request->filled('tahun')) {
            $topProductsQuery->whereYear('date', $tahun);
        }

        $topProducts = $topProductsQuery->groupBy('produk_id', 'created_by')
            ->orderBy('total_pendapatan', 'desc')
            ->limit(3)
            ->get();

        // Data Jenis Kue (from produk types) - filtered by date
        $jenisKueQuery = PengajuanDetail::whereHas('pengajuan', function($query) use ($penjual) {
                $query->where('penjual_id', $penjual->penjual_id);
            })
            ->where('status', 'Approved')
            ->join('tbl_produk', 'tbl_pengajuan_detail.produk_id', '=', 'tbl_produk.produk_id')
            ->join('tbl_stock_harian', function($join) {
                $join->on('tbl_stock_harian.produk_id', '=', 'tbl_produk.produk_id')
                     ->whereNotNull('tbl_stock_harian.sisa_stock');
            });

        // Apply date filters to jenis kue
        if ($request->filled('bulan')) {
            $jenisKueQuery->whereMonth('tbl_stock_harian.date', $bulan);
        }

        if ($request->filled('tahun')) {
            $jenisKueQuery->whereYear('tbl_stock_harian.date', $tahun);
        }

        $jenisKueData = $jenisKueQuery->select('tbl_produk.produk_type', DB::raw('COUNT(DISTINCT tbl_produk.produk_id) as count'))
            ->groupBy('tbl_produk.produk_type')
            ->get();

        // Get all produk types from enum
        $produkTypes = DB::select("SELECT unnest(enum_range(NULL::produk_type)) AS type");

        // Initialize counts for all types (convert to lowercase for consistency)
        $jenisKueCounts = [];
        foreach ($produkTypes as $type) {
            $jenisKueCounts[strtolower($type->type)] = 0;
        }

        // Map actual data to counts
        foreach ($jenisKueData as $item) {
            $type = strtolower($item->produk_type);
            if (isset($jenisKueCounts[$type])) {
                $jenisKueCounts[$type] = $item->count;
            }
        }

        return view('layouts.penjual.dashboard', compact(
            'totalProduk',
            'totalTerjual',
            'totalPendapatan',
            'totalOmset',
            'monthlyData',
            'yearlyData',
            'topProducts',
            'jenisKueCounts'
        ));
    }

    public function show(): View
    {
        $penjual = $this->getAuthPenjual();

        $pengajuan = Pengajuan::with('penitip')
            ->where('penjual_id', $penjual->penjual_id)
            ->withCount('detail')
            ->withCount([
                'detail as approved_count' => function ($query) {
                    $query->where('status', 'Approved');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layouts.penjual.list_penitip', compact('pengajuan', 'penjual'));
    }
    public function getDetailPengajuan($id)
    {
        $pengajuan = Pengajuan::with([
            'penitip.user',
            'detail.produk'
        ])->findOrFail($id);

        // Build history data
        $history = [];

        // Always add created date (Waiting status)
        $history[] = [
            'tanggal' => $pengajuan->created_at->format('d-m-Y H:i'),
            'status' => 'Waiting for Approval',
            'reason' => '-'
        ];

        // If approved or rejected, add update history
        if ($pengajuan->status === 'Approved') {
            $history[] = [
                'tanggal' => $pengajuan->updated_at->format('d-m-Y H:i'),
                'status' => 'Approved',
                'reason' => '-'
            ];
        } elseif ($pengajuan->status === 'Rejected') {
            $history[] = [
                'tanggal' => $pengajuan->updated_at->format('d-m-Y H:i'),
                'status' => 'Rejected',
                'reason' => $pengajuan->alasan ?? 'No reason provided'
            ];
        }

        // Map detail with explicit status
        $detailWithStatus = $pengajuan->detail->map(function($detail) {
            return [
                'pengajuan_detail_id' => $detail->pengajuan_detail_id,
                'produk_id' => $detail->produk_id,
                'harga_modal' => $detail->harga_modal,
                'harga_jual' => $detail->harga_jual,
                'status' => $detail->status ?? 'Pending',
                'produk' => $detail->produk
            ];
        });

        return response()->json([
            'pengajuan_id' => $pengajuan->pengajuan_id,
            'status' => $pengajuan->status,
            'penitip' => $pengajuan->penitip,
            'email' => $pengajuan->penitip?->user?->email ?? '-',
            'detail' => $detailWithStatus,
            'history' => $history
        ]);
    }
    public function approve(Request $request)
    {
        try {
            $request->validate([
                'pengajuan_id' => 'required',
                'approved_data' => 'required|array',
                'approved_data.*.detail_id' => 'required',
                'approved_data.*.harga_jual' => 'required|numeric|min:0'
            ]);

            // approve produk yg dicentang dan update harga jual
            foreach ($request->approved_data as $item) {
                PengajuanDetail::where('pengajuan_detail_id', $item['detail_id'])
                    ->update([
                        'status' => 'Approved',
                        'harga_jual' => $item['harga_jual']
                    ]);
            }

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

            // 🔔 Notification: Pengajuan approved untuk penitip (disabled - model not yet created)
            // try {
            //     if ($pengajuan->penitip && $pengajuan->penitip->user_id) {
            //         Notification::create([
            //             'user_id' => $pengajuan->penitip->user_id,
            //             'type' => 'pengajuan_approved',
            //             'title' => 'Pengajuan Disetujui',
            //             'message' => '✅ Pengajuan Anda ke ' . ($pengajuan->penjual->nama_toko ?? 'Toko') . ' telah disetujui!',
            //             'data' => [
            //                 'pengajuan_id' => $pengajuan->pengajuan_id,
            //                 'penjual_id' => $pengajuan->penjual_id,
            //                 'approved_count' => $approved
            //             ]
            //         ]);
            //     }
            // } catch (\Exception $e) {
            //     \Log::error('Failed to create notification: ' . $e->getMessage());
            // }

            return response()->json([
                'success' => true,
                'message' => "Berhasil menyetujui {$approved} produk"
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Approve error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function reject(Request $request)
    {
        try {
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
            $pengajuan->alasan = $request->reason;
            $pengajuan->save();

            // 🔔 Notification: Pengajuan rejected untuk penitip (disabled - model not yet created)
            // try {
            //     if ($pengajuan->penitip && $pengajuan->penitip->user_id) {
            //         Notification::create([
            //             'user_id' => $pengajuan->penitip->user_id,
            //             'type' => 'pengajuan_rejected',
            //             'title' => 'Pengajuan Ditolak',
            //             'message' => '❌ Pengajuan Anda ke ' . ($pengajuan->penjual->nama_toko ?? 'Toko') . ' ditolak',
            //             'data' => [
            //                 'pengajuan_id' => $pengajuan->pengajuan_id,
            //                 'penjual_id' => $pengajuan->penjual_id,
            //                 'alasan' => $request->reason
            //             ]
            //         ]);
            //     }
            // } catch (\Exception $e) {
            //     \Log::error('Failed to create notification: ' . $e->getMessage());
            // }

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil ditolak'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Reject error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
      public function show_penitip_approved(): View
    {
        $penjual = $this->getAuthPenjual();

        $penitip_approved = Pengajuan::where('status', 'Approved')
            ->where('penjual_id', $penjual->penjual_id)
            ->with('penitip.user')
            ->get();

        return view('layouts.penjual.list_penitip_approved', compact('penitip_approved', 'penjual'));
    }

    public function show_detail_penitip_approved($penjual_id): View
    {
        $penjual = $this->getAuthPenjual();

        // Pastikan hanya data penjual yang login
        if ($penjual->penjual_id != $penjual_id) {
            abort(403, 'Unauthorized');
        }

        $detail_penitip_approved = StockHarian::where('penjual_id', $penjual_id)
            ->with('produk')
            ->orderBy('created_at', 'desc')
            ->get();

        // ambil nama dari created_by
        $penitipName = $detail_penitip_approved->first()?->created_by;

        return view(
            'layouts.penjual.detail_penitip_approved',
            compact('detail_penitip_approved', 'penitipName', 'penjual')
        );
    }

    public function show_detail_penitip_pengajuan($penitip_id): View
    {
        $penjual = $this->getAuthPenjual();

        // Filter: penjual yang login DAN penitip tertentu
        $detail_penitip_approved = StockHarian::where('penjual_id', $penjual->penjual_id)
            ->whereHas('produk', function($query) use ($penitip_id) {
                $query->where('penitip_id', $penitip_id);
            })
            ->with('produk.penitip')
            ->orderBy('created_at', 'desc')
            ->get();

        // ambil nama penitip dari relasi
        $penitipName = $detail_penitip_approved->first()?->produk?->penitip?->name ?? 'N/A';

        return view(
            'layouts.penjual.detail_penitip_approved',
            compact('detail_penitip_approved', 'penitipName', 'penjual')
        );
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

            // Hitung dan update pendapatan: (stock - sisa_stock) x (harga_jual - harga_modal)
            $jumlah_terjual = $stock->stock - $request->sisa_stock;
            $margin = $stock->harga_jual - $stock->harga_modal;
            $stock->pendapatan = $jumlah_terjual * $margin;

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

    /**
     * Show form to register/lengkapi toko data (pertama kali)
     */
    public function registerToko()
    {
        $user = Auth::guard('usermanual')->user();

        if (!$user || $user->user_type !== 'penjual') {
            abort(403, 'Unauthorized');
        }

        $penjual = $user->penjual;
        return view('layouts.penjual.register_toko', compact('penjual'));
    }

    /**
     * Store toko data pertama kali
     */
    public function storeToko(Request $request)
    {
        $user = Auth::guard('usermanual')->user();

        if (!$user || $user->user_type !== 'penjual') {
            abort(403, 'Unauthorized');
        }

        $penjual = $user->penjual;

        if (!$penjual) {
            abort(404, 'Data penjual tidak ditemukan');
        }

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jam_operasional_buka' => 'required',
            'jam_operasional_tutup' => 'required',
            'tgl_berdiri' => 'required|date',
            'deskripsi' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle file upload for banner
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $filename = 'banner_' . $penjual->penjual_id . '_' . time() . '.' . $banner->getClientOriginalExtension();
            $banner->storeAs('public/banners', $filename);
            $penjual->banner = $filename;
        }

        // Update data toko
        $penjual->nama_toko = $request->nama_toko;
        $penjual->nama_pemilik = $request->pemilik;
        $penjual->email = $request->email;
        $penjual->no_hp = $request->no_hp;
        $penjual->alamat_toko = $request->alamat;
        $penjual->jam_buka = $request->jam_operasional_buka;
        $penjual->jam_tutup = $request->jam_operasional_tutup;
        $penjual->tanggal_join = $request->tgl_berdiri;
        $penjual->deskripsi_toko = $request->deskripsi;
        $penjual->updated_at = now();
        $penjual->save();

        return redirect()->route('penjual.dashboard')->with('success', 'Data toko berhasil disimpan');
    }

    /**
     * Show form to edit toko data
     */
    public function editToko()
    {
        $penjual = $this->getAuthPenjual();
        return view('layouts.penjual.edit_toko', compact('penjual'));
    }

    /**
     * Update toko data
     */
    public function updateToko(Request $request)
    {
        $penjual = $this->getAuthPenjual();

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jam_operasional_buka' => 'required',
            'jam_operasional_tutup' => 'required',
            'tgl_berdiri' => 'required|date',
            'deskripsi' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle file upload for banner
        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($penjual->banner && $penjual->banner !== 'default-banner.jpg') {
                Storage::disk('public')->delete('banners/' . $penjual->banner);
            }

            // Store new banner
            $path = $request->file('banner')->store('banners', 'public');
            $penjual->banner = basename($path);
        }

        // Update data toko
        $penjual->nama_toko = $request->nama_toko;
        $penjual->nama_pemilik = $request->pemilik;
        $penjual->email = $request->email;
        $penjual->no_hp = $request->no_hp;
        $penjual->alamat_toko = $request->alamat;
        $penjual->jam_buka = $request->jam_operasional_buka;
        $penjual->jam_tutup = $request->jam_operasional_tutup;
        $penjual->tanggal_join = $request->tgl_berdiri;
        $penjual->deskripsi_toko = $request->deskripsi;
        $penjual->updated_at = now();
        $penjual->save();

        return redirect()->route('penjual.edit_toko')->with('success', 'Data toko berhasil diperbarui');
    }

    /**
     * Show form to change password
     */
    public function editPassword()
    {
        $penjual = $this->getAuthPenjual();
        return view('layouts.penjual.edit_password', compact('penjual'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('usermanual')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|confirmed'
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru minimal 4 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        // Check current password (support both plain text and hashed)
        $currentPasswordValid = false;
        if ($user->password === $request->current_password) {
            $currentPasswordValid = true;
        } elseif (Hash::check($request->current_password, $user->password)) {
            $currentPasswordValid = true;
        }

        if (!$currentPasswordValid) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        // Update password with hash
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('penjual.edit_password')->with('success', 'Password berhasil diubah');
    }
}
