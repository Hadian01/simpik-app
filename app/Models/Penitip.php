<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;

    protected $table = 'tbl_penitip';
    protected $primaryKey = 'penitip_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'no_hp',
        'alamat',
        'nama_bank',
        'no_rekening',
        'atas_nama',
        'foto_profile',
        'is_active',
        'created_at',
        'update_at',
    ];

     public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'user_id');
    }

    // relationship to user for email etc
    public function user()
    {
        return $this->belongsTo(UserManual::class, 'user_id');
    }
}
