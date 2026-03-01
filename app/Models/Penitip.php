<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;

    protected $table = 'tbl_penitip';

    protected $primaryKey = 'penitip_id';

     public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'user_id');
    }

    // relationship to user for email etc
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
