<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHarian extends Model
{
    use HasFactory;

    protected $table = 'tbl_stock_harian';

    protected $primaryKey = 'stock_id';

    public $timestamps = false;

    protected $fillable = [
        'penjual_id',
        'produk_id',
        'stock_qty',
        'stock',
        'sisa_stock',
        'validasi_foto',
        'sisa_foto'
    ];

     public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
