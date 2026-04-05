<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::guard('usermanual')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::guard('usermanual')->user();

        if ($user->user_type !== $role) {
            // Redirect ke dashboard yang sesuai dengan role mereka
            if ($user->user_type === 'penjual') {
                return redirect()->route('penjual.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            } else {
                return redirect()->route('penitip.daftar_toko')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
            
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
