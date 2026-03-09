<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Pengajuan;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PenitipController extends Controller
{

    public function show(): View
    {
        $produk = Produk::all();

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
        $penitip_id = 1; // sementara hardcode

        $pengajuan = Pengajuan::with('penjual')
            ->where('penitip_id', $penitip_id)
            ->get();

        $penjualIds = $pengajuan->pluck('penjual_id');

        $toko_saya = collect();

        foreach ($pengajuan as $item) {
            if ($item->penjual) {
                $toko = $item->penjual;
                $toko->status_pengajuan = $item->status;
                $toko_saya->push($toko);
            }
        }

        $toko_lainnya = Penjual::whereNotIn('penjual_id', $penjualIds)->get();

        foreach ($toko_lainnya as $toko) {
            $toko->status_pengajuan = 'not_joined';
        }

        return view('layouts.penitip.daftar_toko',
            compact('toko_saya','toko_lainnya'));
    }

    public function detail_toko(string $penjual_id): View
    {

        $penitip_id = 1; // sementara hardcode login

        $toko = Penjual::findOrFail($penjual_id);

        // Produk toko yang sudah approved
        $produk = Produk::whereHas('approval', function ($query) use ($penjual_id) {
            $query->where('penjual_id', $penjual_id)
                ->where('status', 'approved');
        })
        ->where('is_active', true)
        ->get();

        // Produk milik penitip (untuk diajukan)
        $produk_penitip = Produk::where('penitip_id',$penitip_id)
                            ->where('is_active',true)
                            ->get();

        // ambil data pengajuan terakhir
        $pengajuan = DB::table('tbl_pengajuan')
            ->where('penitip_id',$penitip_id)
            ->where('penjual_id',$penjual_id)
            ->orderBy('created_at','desc')
            ->first();

        // status pengajuan
        $status_pengajuan = $pengajuan->status ?? 'not_joined';

        return view(
            'layouts.penitip.detail_toko',
            compact(
                'toko',
                'produk',
                'produk_penitip',
                'status_pengajuan',
                'pengajuan'
            )
        );

    }
    public function join_penitip(Request $request)
    {

        $request->validate([
            'penitip_id' => 'required',
            'penjual_id' => 'required',
            'produk' => 'required|array'
        ]);

        DB::beginTransaction();

        try{

            $pengajuan_id = DB::table('tbl_pengajuan')->insertGetId([
                'penitip_id' => $request->penitip_id,
                'penjual_id' => $request->penjual_id,
                'alasan' => $request->alasan,
                'status' => 'pending',
                'created_by' => 1, // sementara hardcode
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

                    'created_by' => 1,
                    'created_at' => now()

                ]);

            }

            DB::commit();

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
        $penitip_id = 1; // sementara hardcode login

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

        $dashboard_data = DB::table('tbl_stock_harian')
            ->where('penitip_id', $penitip_id)
            ->where('penjual_id', $id)
            ->whereRaw("DATE_TRUNC('month', date) = DATE_TRUNC('month', CURRENT_DATE)")
            ->selectRaw('
                SUM(stock::int) as total_dititip,
                SUM(stock::int - sisa_stock::int) as total_terjual,
                SUM(pendapatan::int) as total_pendapatan
            ')
            ->first();


        $dashboard = [
            'total_penjualan' => $dashboard_data->total_terjual ?? 0,
            'produk_terjual' => $dashboard_data->total_terjual ?? 0,
            'komisi' => 0,
            'pendapatan_bersih' => $dashboard_data->total_pendapatan ?? 0,
            'bulan' => now()->format('F Y')
        ];


        /*
        |--------------------------------
        | STATISTIK DASHBOARD
        |--------------------------------
        */

        $statistik = [

            [
                'title' => 'Total Terjual',
                'value' => $dashboard_data->total_terjual ?? 0,
                'bg_color' => '#CFC7FF'
            ],

            [
                'title' => 'Total Dititip',
                'value' => $dashboard_data->total_dititip ?? $produk_toko->count(),
                'bg_color' => '#CFC7FF'
            ],

            [
                'title' => 'Total Pendapatan',
                'value' => 'Rp ' . number_format($dashboard_data->total_pendapatan ?? 0),
                'bg_color' => '#CFC7FF'
            ],

        ];


        /*
        |--------------------------------
        | RIWAYAT PENJUALAN
        |--------------------------------
        */

        $riwayat = DB::table('tbl_stock_harian as sh')
            ->join('tbl_produk as p', 'sh.produk_id', '=', 'p.produk_id')
            ->join('tbl_penjual as pj', 'sh.penjual_id', '=', 'pj.penjual_id')
            ->where('sh.penitip_id', $penitip_id)
            ->where('sh.penjual_id', $id)
            ->whereRaw("DATE_TRUNC('month', sh.date) = DATE_TRUNC('month', CURRENT_DATE)")
            ->selectRaw('
                sh.created_at,
                p.produk_name,
                pj.nama_toko,
                sh.stock::int as stock,
                (sh.stock::int - sh.sisa_stock::int) as stock_terjual,
                sh.harga_modal::int as cogs,
                sh.pendapatan::int as pendapatan
            ')
            ->orderBy('sh.created_at', 'desc')
            ->get();


        $riwayat_list = [];

        $no = 1;

        foreach ($riwayat as $r) {

            $riwayat_list[] = [

                'no' => $no++,
                'submission_date' => date('d M Y', strtotime($r->created_at)),
                'name' => $r->produk_name,
                'nama_toko' => $r->nama_toko,
                'stock' => $r->stock,
                'stock_terjual' => $r->stock_terjual,
                'cogs' => 'Rp ' . number_format($r->cogs),
                'pendapatan' => 'Rp ' . number_format($r->pendapatan)

            ];
        }


        $total_data = count($riwayat_list);
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

    /*
    |--------------------------------------------------------------------------
    | ADD PRODUK
    |--------------------------------------------------------------------------
    */

    public function add_produk(Request $request)
    {
        $request->validate([
            'produk_type'   => 'required',
            'produk_name'   => 'required',
            'produk_description' => 'required',
            'harga_modal'  => 'required|numeric',
            'harga_jual'   => 'required|numeric',
            'upload_foto' => 'nullable|image|max:2048'
        ]);

        $produk = Produk::create([
            'penitip_id' => $request->penitip_id,
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

    public function dashboard($id)
    {

        $penitip_id = 1; // sementara hardcode login

        $toko = Penjual::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | PRODUK YANG DITITIPKAN KE TOKO
        |--------------------------------------------------------------------------
        */

        $produk_toko = DB::table('tbl_produk_penjual')
            ->join('tbl_produk', 'tbl_produk_penjual.produk_id', '=', 'tbl_produk.produk_id')
            ->where('tbl_produk_penjual.penjual_id', $id)
            ->where('tbl_produk.penitip_id', $penitip_id)
            ->select(
                'tbl_produk_penjual.*',
                'tbl_produk.produk_name',
                'tbl_produk.harga_modal',
                'tbl_produk.harga_jual',
                'tbl_produk.foto_produk',
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD HEADER
        |--------------------------------------------------------------------------
        */

        $dashboard = [
            'bulan' => now()->format('F Y')
        ];


        /*
        |--------------------------------------------------------------------------
        | STATISTIK DASHBOARD (PER BULAN)
        |--------------------------------------------------------------------------
        */

        $dashboard_data = DB::table('tbl_stock_harian')
            ->where('penitip_id', $penitip_id)
            ->where('penjual_id', $id)
            ->whereRaw("DATE_TRUNC('month', date) = DATE_TRUNC('month', CURRENT_DATE)")
            ->selectRaw('
                SUM(stock::int) as total_dititip,
                SUM(stock::int - sisa_stock::int) as total_terjual,
                SUM(pendapatan::int) as total_pendapatan
            ')
            ->first();


        $statistik = [

            [
                'title' => 'Total Terjual',
                'value' => $dashboard_data->total_terjual ?? 0,
                'bg_color' => '#CFC7FF'
            ],

            [
                'title' => 'Total Dititip',
                'value' => $dashboard_data->total_dititip ?? 0,
                'bg_color' => '#CFC7FF'
            ],

            [
                'title' => 'Total Pendapatan',
                'value' => 'Rp ' . number_format($dashboard_data->total_pendapatan ?? 0),
                'bg_color' => '#CFC7FF'
            ]

        ];


        /*
        |--------------------------------------------------------------------------
        | RIWAYAT PENJUALAN
        |--------------------------------------------------------------------------
        */

        $riwayat = DB::table('tbl_stock_harian as sh')
            ->join('tbl_produk as p', 'sh.produk_id', '=', 'p.produk_id')
            ->join('tbl_penjual as pj', 'sh.penjual_id', '=', 'pj.penjual_id')
            ->where('sh.penitip_id', $penitip_id)
            ->where('sh.penjual_id', $id)
            ->whereRaw("DATE_TRUNC('month', sh.date) = DATE_TRUNC('month', CURRENT_DATE)")
            ->selectRaw('
                sh.created_at,
                p.produk_name,
                pj.nama_toko,
                sh.stock::int as stock,
                (sh.stock::int - sh.sisa_stock::int) as stock_terjual,
                sh.harga_modal::int as cogs,
                sh.pendapatan::int as pendapatan
            ')
            ->orderBy('sh.created_at', 'desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | FORMAT DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        $riwayat_list = [];

        $no = 1;

        foreach ($riwayat as $r) {

            $riwayat_list[] = [

                'no' => $no++,
                'submission_date' => date('d M Y', strtotime($r->created_at)),
                'name' => $r->produk_name,
                'nama_toko' => $r->nama_toko,
                'stock' => $r->stock,
                'stock_terjual' => $r->stock_terjual,
                'cogs' => 'Rp ' . number_format($r->cogs),
                'pendapatan' => 'Rp ' . number_format($r->pendapatan)

            ];

        }

        $total_data = count($riwayat_list);


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'layouts.penitip.toko_saya',
            compact(
                'toko',
                'dashboard',
                "produk_toko",
                'statistik',
                'riwayat_list',
                'total_data'
            )
        );

    }
}
