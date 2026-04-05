<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read'
    ];
    
    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];
    
    // Relation to User
    public function user()
    {
        return $this->belongsTo(UserManual::class, 'user_id', 'user_id');
    }
    
    // Scope untuk notifikasi yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
    
    // Mark as read
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
