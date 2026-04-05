<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserManual extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
    protected $fillable = [
        'email',
        'password',
        'user_type',
    ];
    
    protected $hidden = [
        'password',
    ];
    
    // Override getAuthPassword untuk support plain text password (data existing)
    public function getAuthPassword()
    {
        return $this->password;
    }
    
    // Relasi dengan Penitip
    public function penitip()
    {
        return $this->hasOne(Penitip::class, 'user_id', 'user_id');
    }
    
    // Relasi dengan Penjual
    public function penjual()
    {
        return $this->hasOne(Penjual::class, 'user_id', 'user_id');
    }
}
