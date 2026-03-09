<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\StockHarian;

// Check approved pengajuan
echo "=== APPROVED PENGAJUAN ===\n";
$approved = Pengajuan::where('status', 'Approved')->get();
echo "Count: " . count($approved) . "\n";
foreach ($approved as $p) {
    echo "pengajuan_id: {$p->pengajuan_id}, penjual_id: {$p->penjual_id}, penitip_id: {$p->penitip_id}\n";
}

echo "\n=== STOCK HARIAN ===\n";
// Check first penjual_id's stock
if ($approved->count() > 0) {
    $penjual_id = $approved->first()->penjual_id;
    echo "Checking StockHarian for penjual_id: {$penjual_id}\n";

    $stock = StockHarian::where('penjual_id', $penjual_id)->get();
    echo "Count: " . count($stock) . "\n";
    foreach ($stock as $s) {
        echo "stock_id: {$s->stock_id}, penjual_id: {$s->penjual_id}, produk_id: {$s->produk_id}\n";
    }
}

echo "\n=== ALL STOCK HARIAN ===\n";
$all_stock = StockHarian::all();
echo "Total: " . count($all_stock) . "\n";
