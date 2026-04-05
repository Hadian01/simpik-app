<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get unread notification count
     */
    public function getUnreadCount()
    {
        $user = Auth::guard('usermanual')->user();
        
        if (!$user) {
            return response()->json(['count' => 0]);
        }
        
        $count = Notification::where('user_id', $user->user_id)
            ->where('is_read', false)
            ->count();
        
        return response()->json(['count' => $count]);
    }
    
    /**
     * Get all notifications for current user
     */
    public function getNotifications()
    {
        $user = Auth::guard('usermanual')->user();
        
        if (!$user) {
            return response()->json(['notifications' => []]);
        }
        
        $notifications = Notification::where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return response()->json(['notifications' => $notifications]);
    }
    
    /**
     * Mark notification as read
     */
    public function markAsRead(Request $request)
    {
        $user = Auth::guard('usermanual')->user();
        
        $notification = Notification::where('id', $request->id)
            ->where('user_id', $user->user_id)
            ->first();
        
        if ($notification) {
            $notification->markAsRead();
        }
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Mark all as read
     */
    public function markAllAsRead()
    {
        $user = Auth::guard('usermanual')->user();
        
        Notification::where('user_id', $user->user_id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }
}
