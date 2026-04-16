<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserManual;

class Penjual extends Model
{
    protected $table = 'tbl_penjual';
    protected $primaryKey = 'penjual_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'no_hp',
        'tanggal_join',
        'nama_toko',
        'deskripsi_toko',
        'jam_buka',
        'jam_tutup',
        'nama_pemilik',
        'alamat_toko',
        'banner',
        'email',
        'created_at',
        'updated_at',
    ];

    // Ini buat memastikan untuk  mengubah format tanggal dan waktu saat diambil dari database
    protected $casts = [
        'tanggal_join' => 'date',
        'jam_buka' => 'datetime',
        'jam_tutup' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // public function approval()
    // {
    //     return $this->hasMany(ProdukPenjual::class, 'penjual_id');
    // }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'penjual_id');
    }
    public function user()
    {
        return $this->belongsTo(UserManual::class, 'user_id');
    }


}
