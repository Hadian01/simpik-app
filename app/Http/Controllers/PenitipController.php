<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Pengajuan;
use App\Models\PengajuanDetail;
use App\Models\Penitip;
use App\Models\Notification;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenitipController extends Controller
{
    /**
     * Get authenticated penitip
     */
    protected function getAuthPenitip()
    {
        $user = Auth::guard('usermanual')->user();
        
        if (!$user || $user->user_type !== 'penitip') {
            abort(403, 'Unauthorized');
        }
        
        $penitip = $user->penitip;
        
        if (!$penitip) {
            abort(404, 'Data penitip tidak ditemukan');
        }
        
        return $penitip;
    }

    public function show(): View
    {
        $penitip = $this->getAuthPenitip();
        $produk = Produk::where('penitip_id', $penitip->penitip_id)->get();

        $produk_types = DB::select("
            SELECT unnest(enum_range(NULL::produk_type)) AS type
        ");

        return view('layouts.penitip.produk', compact('produk','produk_types'));
    }

    public function detail_produk(string $produk_id): View
    {
        $produk_types = DB::select("
            SELECT unnest(enum_range(NULL::produk_type)) AS type
        ");

        return view('layouts.penitip.detail_produk', [
            'detail_produk' => Produk::findOrFail($produk_id),
            'produk_types' => $produk_types
        ]);
    }

    public function daftar_toko(): View
    {
        $penitip = $this->getAuthPenitip();
        $penitip_id = $penitip->penitip_id;

        // ambil semua pengajuan + relasi toko
        $pengajuan = Pengajuan::with('penjual')
            ->where('penitip_id', $penitip_id)
            ->orderBy('created_at', 'desc') // penting!
            ->get()
            ->groupBy('penjual_id'); // group per toko

        $toko_saya = collect();
        $penjualIds = [];

        foreach ($pengajuan as $penjual_id => $items) {

            $latest = $items->first(); // ✅ ambil pengajuan terbaru

            if ($latest->penjual) {

                $toko = $latest->penjual;

                // inject attribute tambahan
                $toko->status_pengajuan = $latest->status;
                $toko->alasan = $latest->alasan;
                $toko->pengajuan_history = $items;

                $toko_saya->push($toko);
                $penjualIds[] = $penjual_id;
            }
        }

        // toko yang belum pernah di-join
        $toko_lainnya = Penjual::whereNotIn('penjual_id', $penjualIds)->get();

        foreach ($toko_lainnya as $toko) {
            $toko->status_pengajuan = 'not_joined';
        }

        return view(
            'layouts.penitip.daftar_toko',
            compact('toko_saya','toko_lainnya')
        );
    }

    public function detail_toko(string $penjual_id): View|RedirectResponse
    {
        $penitip = $this->getAuthPenitip();
        $penitip_id = $penitip->penitip_id;

        $toko = Penjual::findOrFail($penjual_id);

        /* =========================
        CEK STATUS PENGAJUAN
        ========================= */
        $latest_pengajuan = DB::table('tbl_pengajuan')
            ->where('penitip_id', $penitip_id)
            ->where('penjual_id', $penjual_id)
            ->orderByDesc('created_at')
            ->first();

        // Redirect ke toko_saya jika sudah approved
        if ($latest_pengajuan && strtolower($latest_pengajuan->status) === 'approved') {
            return redirect()->route('penitip.toko_saya', ['id' => $penjual_id]);
        }

        /* =========================
        PRODUK TOKO APPROVED (SEMUA PRODUK DARI SEMUA PENITIP)
        ========================= */
        $approvedProdukIds = PengajuanDetail::whereHas('pengajuan', function ($query) use ($penjual_id) {
                $query->where('penjual_id', $penjual_id);
            })
            ->where('status', 'Approved')
            ->pluck('produk_id')
            ->unique();
        
        $produk = Produk::whereIn('produk_id', $approvedProdukIds)
            ->where('is_active', true)
            ->get();

        /* =========================
        PRODUK MILIK PENITIP
        ========================= */
        $produk_penitip = Produk::where('penitip_id', $penitip_id)
            ->where('is_active', true)
            ->get();

        /* =========================
        HISTORY PENGAJUAN
        ========================= */
        $pengajuan_history = DB::table('tbl_pengajuan')
            ->where('penitip_id', $penitip_id)
            ->where('penjual_id', $penjual_id)
            ->orderByDesc('created_at')
            ->get();

        /* =========================
        STATUS TERAKHIR
        ========================= */
        $status_pengajuan = strtolower($latest_pengajuan->status ?? 'not_joined');

        return view(
            'layouts.penitip.detail_toko',
            compact(
                'toko',
                'produk',
                'produk_penitip',
                'status_pengajuan',
                'pengajuan_history',
                'latest_pengajuan'
            )
        );
    }
    public function join_penitip(Request $request)
    {
        $penitip = $this->getAuthPenitip();
        
        $request->validate([
            'penjual_id' => 'required',
            'produk' => 'required|array'
        ]);

        DB::beginTransaction();

        try{

            $pengajuan_id = DB::table('tbl_pengajuan')->insertGetId([
                'penitip_id' => $penitip->penitip_id,
                'penjual_id' => $request->penjual_id,
                'alasan' => $request->alasan,
                'status' => 'Pending',
                'created_by' => $penitip->penitip_id,
                'created_at' => now()
            ], 'pengajuan_id');

            foreach($request->produk as $produk_id){

                $produk = DB::table('tbl_produk')
                            ->where('produk_id',$produk_id)
                            ->first();

                DB::table('tbl_pengajuan_detail')->insert([

                    'pengajuan_id' => $pengajuan_id,
                    'produk_id' => $produk_id,

                    'harga_modal' => $produk->harga_modal,
                    'harga_jual' => $produk->harga_jual,

                    'status' => 'Pending',

                    'created_by' => $penitip->name,
                    'created_at' => now()

                ]);

            }

            DB::commit();

            // 🔔 Notification: Pengajuan baru untuk penjual
            $penjual = Penjual::find($request->penjual_id);
            if ($penjual && $penjual->user_id) {
                Notification::create([
                    'user_id' => $penjual->user_id,
                    'type' => 'pengajuan_baru',
                    'title' => 'Pengajuan Baru',
                    'message' => '🔔 ' . $penitip->name . ' mengajukan join ke toko Anda',
                    'data' => [
                        'pengajuan_id' => $pengajuan_id,
                        'penitip_id' => $penitip->penitip_id,
                        'penitip_name' => $penitip->name
                    ]
                ]);
            }

            return response()->json([
                'message' => 'Pengajuan berhasil dikirim'
            ]);

        }catch(\Exception $e){

        DB::rollback();

        return response()->json([
            'message' => $e->getMessage()
        ],500);

        }
    }

    public function toko_saya($id)
    {
        $penitip = $this->getAuthPenitip();
        $penitip_id = $penitip->penitip_id;

        $toko = Penjual::findOrFail($id);

        /*
        |--------------------------------
        | PRODUK MILIK PENITIP
        |--------------------------------
        */
        $produk_toko = Produk::where('penitip_id', $penitip_id)->get();


        /*
        |--------------------------------
        | DASHBOARD DATA
        |--------------------------------
        */
        $dashboard_data = DB::table('tbl_stock_harian as sh')
            ->join('tbl_produk as p', 'sh.produk_id', '=', 'p.produk_id')
            ->where('p.penitip_id', $penitip_id)
            ->where('sh.penjual_id', $id)
            ->whereRaw("DATE_TRUNC('month', sh.date) = DATE_TRUNC('month', CURRENT_DATE)")
            ->selectRaw('
                COALESCE(SUM(sh.stock_qty::int),0) as total_dititip,
                COALESCE(SUM(COALESCE(sh.stock::int, 0) - COALESCE(sh.sisa_stock::int, 0)),0) as total_terjual,
                COALESCE(SUM((COALESCE(sh.stock::int, 0) - COALESCE(sh.sisa_stock::int, 0)) * (sh.harga_jual::int - sh.harga_modal::int)),0) as total_pendapatan
            ')
            ->first();


        $dashboard = [
            'total_penjualan'   => $dashboard_data->total_terjual,
            'produk_terjual'    => $dashboard_data->total_terjual,
            'komisi'            => 0,
            'pendapatan_bersih' => $dashboard_data->total_pendapatan,
            'bulan'             => now()->format('F Y')
        ];


        /*
        |--------------------------------
        | STATISTIK DASHBOARD
        |--------------------------------
        */
        $statistik = [

            [
                'title' => 'Total Terjual',
                'value' => $dashboard_data->total_terjual,
                'bg_color' => '#CFC7FF'
            ],

            [
                'title' => 'Total Dititip',
                'value' => $dashboard_data->total_dititip ?: $produk_toko->count(),
                'bg_color' => '#CFC7FF'
            ],

            [
                'title' => 'Total Pendapatan',
                'value' => 'Rp ' . number_format($dashboard_data->total_pendapatan),
                'bg_color' => '#CFC7FF'
            ],

        ];


        /*
        |--------------------------------
        | RIWAYAT DASHBOARD (TAB 2)
        |--------------------------------
        */
        $riwayat = DB::table('tbl_stock_harian as sh')
            ->join('tbl_produk as p', 'sh.produk_id', '=', 'p.produk_id')
            ->join('tbl_penjual as pj', 'sh.penjual_id', '=', 'pj.penjual_id')
            ->where('p.penitip_id', $penitip_id)
            ->where('sh.penjual_id', $id)
            ->whereRaw("DATE_TRUNC('month', sh.date) = DATE_TRUNC('month', CURRENT_DATE)")
            ->selectRaw('
                sh.created_at,
                p.produk_name,
                pj.nama_toko,
                sh.stock_qty::int as stock,
                sh.harga_jual::int as harga_jual,
                sh.harga_modal::int as cogs,
                (COALESCE(sh.stock::int, 0) - COALESCE(sh.sisa_stock::int, 0)) as stock_terjual,
                ((COALESCE(sh.stock::int, 0) - COALESCE(sh.sisa_stock::int, 0)) * (sh.harga_jual::int - sh.harga_modal::int)) as pendapatan
            ')
            ->orderBy('sh.created_at', 'desc')
            ->get();


        $riwayat_list = [];
        $no_dashboard = 1;

        foreach ($riwayat as $r) {

            $riwayat_list[] = [

                'no' => $no_dashboard++,
                'submission_date' => date('d M Y', strtotime($r->created_at)),
                'name' => $r->produk_name,
                'nama_toko' => $r->nama_toko,
                'stock' => $r->stock,
                'stock_terjual' => $r->stock_terjual,
                'cogs' => 'Rp ' . number_format($r->cogs),
                'pendapatan' => 'Rp ' . number_format($r->pendapatan)

            ];
        }


        /*
        |--------------------------------
        | RIWAYAT PENJUALAN (TAB 3)
        |--------------------------------
        */
        $riwayat_penjualan = DB::table('tbl_stock_harian as sh')
            ->join('tbl_produk as p', 'sh.produk_id', '=', 'p.produk_id')
            ->where('p.penitip_id', $penitip_id)
            ->where('sh.penjual_id', $id)
            ->selectRaw('
                sh.created_at,
                p.produk_name,
                sh.harga_jual::int as harga_jual,
                sh.harga_modal::int as cogs,
                sh.stock_qty::int as sistem,
                sh.stock::int as validasi_stock,
                sh.sisa_stock::int as sisa_stock,
                ((COALESCE(sh.stock::int, 0) - COALESCE(sh.sisa_stock::int, 0)) * (sh.harga_jual::int - sh.harga_modal::int)) as pendapatan,
                sh.validasi_foto,
                sh.sisa_foto
            ')
            ->orderBy('sh.created_at','desc')
            ->get();


        $riwayat_penjualan_list = [];
        $no_riwayat = 1;

        foreach ($riwayat_penjualan as $r) {

            $riwayat_penjualan_list[] = [

                'no' => $no_riwayat++,
                'submission_date' => date('d-m-Y', strtotime($r->created_at)),
                'name_produk' => $r->produk_name,
                'harga_jual' => $r->harga_jual,
                'cogs' => $r->cogs,
                'sistem' => $r->sistem,
                'validasi_stock' => $r->validasi_stock,
                'sisa_stock' => $r->sisa_stock,
                'pendapatan' => $r->pendapatan,
                'validasi_foto' => $r->validasi_foto,
                'sisa_foto' => $r->sisa_foto
            ];
        }


        $total_data = count($riwayat_list);
        $total_data_penjualan = count($riwayat_penjualan_list);

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
                'riwayat_penjualan_list',
                'total_data',
                'total_data_penjualan',
                'per_page',
                'current_page'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADD PRODUK
    |--------------------------------------------------------------------------
    */

    public function add_produk(Request $request)
    {
        $penitip = $this->getAuthPenitip();
        
        $request->validate([
            'produk_type'   => 'required',
            'produk_name'   => 'required',
            'produk_description' => 'required',
            'harga_modal'  => 'required|numeric',
            'harga_jual'   => 'required|numeric',
            'upload_foto' => 'nullable|image|max:2048'
        ]);

        $produk = Produk::create([
            'penitip_id' => $penitip->penitip_id,
            'produk_type' => $request->produk_type,
            'produk_name' => $request->produk_name,
            'produk_description' => $request->produk_description,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'is_active' => true,
            'foto_produk' => $request->file('upload_foto')
                ? $request->file('upload_foto')->store('produk_foto', 'public')
                : null,
            'created_at' => now()
        ]);

        // 🔔 Notification: Produk baru ke penjual yang sudah approved
        $approved_penjuals = Pengajuan::where('penitip_id', $penitip->penitip_id)
            ->where('status', 'Approved')
            ->with('penjual')
            ->get();
        
        foreach ($approved_penjuals as $pengajuan) {
            if ($pengajuan->penjual && $pengajuan->penjual->user_id) {
                Notification::create([
                    'user_id' => $pengajuan->penjual->user_id,
                    'type' => 'produk_baru',
                    'title' => 'Produk Baru',
                    'message' => '✨ ' . $penitip->name . ' menambahkan produk baru: ' . $request->produk_name,
                    'data' => [
                        'produk_id' => $produk->produk_id,
                        'produk_name' => $request->produk_name,
                        'penitip_id' => $penitip->penitip_id
                    ]
                ]);
            }
        }

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'produk' => $produk
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUK
    |--------------------------------------------------------------------------
    */

    public function edit_produk(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:tbl_produk,produk_id',
            'produk_type'   => 'required',
            'produk_name'   => 'required',
            'produk_description' => 'required',
            'harga_modal'  => 'required|numeric',
            'harga_jual'   => 'required|numeric',
            'upload_foto' => 'nullable|image|max:2048'
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        $data = [
            'produk_type' => $request->produk_type,
            'produk_name' => $request->produk_name,
            'produk_description' => $request->produk_description,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'is_active' => $request->has('is_active'),
            'updated_at' => now()
        ];

        if ($request->hasFile('upload_foto')) {

            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }

            $data['foto_produk'] = $request->file('upload_foto')
                ->store('produk_foto', 'public');
        }

        $produk->update($data);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'produk' => $produk
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUK
    |--------------------------------------------------------------------------
    */

    public function delete_produk($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS PRODUK (TOGGLE)
    |--------------------------------------------------------------------------
    */

    public function update_status_produk(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        $produk->is_active = $request->is_active;
        $produk->save();

        return response()->json([
            'message' => 'Status produk berhasil diupdate'
        ]);
    }

    public function add_jumlah_produk(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:tbl_produk,produk_id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $penitip = $this->getAuthPenitip();
        $penitip_id = $penitip->penitip_id;

        // ambil data produk
        $produk = DB::table('tbl_produk')
            ->where('produk_id', $request->produk_id)
            ->first();

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        DB::table('tbl_stock_harian')->insert([

            'produk_id'  => $request->produk_id,
            'penjual_id' => $id,

            // jumlah stok
            'stock_qty'  => $request->jumlah,
            'stock'      => $request->jumlah, // Sama dengan stock_qty, bisa diupdate penjual saat validasi

            // harga dari tabel produk
            'harga_modal' => $produk->harga_modal,
            'harga_jual'  => $produk->harga_jual,

            // default pendapatan
            'pendapatan' => 0,

            // tanggal stok
            'date' => now(),

            // audit
            'created_at' => now(),
            'created_by' => 'penitip',

        ]);

        return redirect()
            ->back()
            ->with('success', 'Stok produk berhasil ditambahkan');
    }

    /**
     * Show data diri form
     */
    public function dataDiri()
    {
        $penitip = $this->getAuthPenitip();
        return view('layouts.penitip.data_diri', compact('penitip'));
    }

    /**
     * Update data diri
     */
    public function updateDataDiri(Request $request)
    {
        $penitip = $this->getAuthPenitip();

        $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle foto profile
        if ($request->hasFile('foto_profile')) {
            // Delete old photo if exists
            if ($penitip->foto_profile && $penitip->foto_profile !== 'default.jpg') {
                Storage::disk('public')->delete($penitip->foto_profile);
            }

            // Store new photo
            $path = $request->file('foto_profile')->store('profiles', 'public');
            $penitip->foto_profile = $path;
        }

        // Update data
        $penitip->name = $request->name;
        $penitip->no_hp = $request->no_hp;
        $penitip->alamat = $request->alamat;
        $penitip->save();

        return redirect()->route('penitip.data_diri')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Show edit password form
     */
    public function editPassword()
    {
        $penitip = $this->getAuthPenitip();
        return view('layouts.penitip.edit_password', compact('penitip'));
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
        } elseif (\Hash::check($request->current_password, $user->password)) {
            $currentPasswordValid = true;
        }

        if (!$currentPasswordValid) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        // Update password with hash
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return redirect()->route('penitip.edit_password')->with('success', 'Password berhasil diubah');
    }
}

