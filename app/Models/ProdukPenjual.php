<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukPenjual extends Model
{
    protected $table = 'tbl_produk_penjual';
    protected $primaryKey = 'produk_penjual_id';

    protected $fillable = [
        'produk_id',
        'penjual_id',
        'status'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }
}
