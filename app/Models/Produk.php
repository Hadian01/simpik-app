<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tbl_produk';

    protected $primaryKey = 'produk_id';

    public $incrementing = true;

     protected $fillable = [
        'produk_id',
        'produk_name',
        'produk_description',
        'harga_modal',
        'harga_jual',
        'status_produk',
        'produk_type',
        'penitip_id',
        'is_active',
        'foto_produk'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function approval()
    {
        return $this->hasMany(ProdukPenjual::class, 'produk_id');
    }

    public function pengajuanDetails()
    {
        return $this->hasMany(PengajuanDetail::class, 'produk_id');
    }

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'penitip_id');
    }

    // Accessor untuk compatibility dengan nama_produk
    public function getNamaProdukAttribute()
    {
        return $this->produk_name;
    }
}
