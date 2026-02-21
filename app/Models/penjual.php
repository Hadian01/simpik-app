<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Penjual extends Model
{
    protected $table = 'tbl_penjual';

    protected $primaryKey = 'penjual_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'no_hp',
        'tanggal_join',
        'nama_toko',
        'deskripsi_toko',
        'jam_buka',
        'jam_tutup',
        'nama_pemilik',
        'alamat_toko'
    ];

    // Ini buat memastikan untuk  mengubah format tanggal dan waktu saat diambil dari database
    protected $casts = [
        'tanggal_join' => 'date',
        'jam_buka' => 'datetime',
        'jam_tutup' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function approval()
    {
        return $this->hasMany(ProdukPenjual::class, 'penjual_id');
    }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'penjual_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
