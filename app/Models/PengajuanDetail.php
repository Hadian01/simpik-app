<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_pengajuan_detail';

    protected $primaryKey = 'pengajuan_detail_id';

    protected $fillable = [
        'pengajuan_id',
        'produk_id',
        'harga_modal',
        'harga_jual',
        'status',
        'created_by',
        'update_by'
    ];

     public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
