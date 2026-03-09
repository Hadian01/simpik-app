<?php

use App\Models\Produk;
use App\Models\PengajuanDetail;

echo "Produk fillable: " . json_encode((new Produk())->getFillable()) . PHP_EOL;
echo "Produk casts: " . json_encode((new Produk())->getCasts()) . PHP_EOL;
$p = Produk::first();
echo "Produk sample: " . json_encode($p ? $p->toArray() : null) . PHP_EOL;
$pd = PengajuanDetail::first();
echo "PengajuanDetail sample: " . json_encode($pd ? $pd->toArray() : null) . PHP_EOL;
