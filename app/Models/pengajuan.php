<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'tbl_pengajuan';
    protected $primaryKey = 'pengajuan_id';

    protected $fillable = [
        'penitip_id',
        'penjual_id',
        'status',
        'created_by',
        'update_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'penjual_id');
    }
}

