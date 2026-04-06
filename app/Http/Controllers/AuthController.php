<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserManual;
use App\Models\Penitip;
use App\Models\Penjual;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = UserManual::with(['penitip', 'penjual'])->where('email', $request->email)->first();

        if ($user) {
            $isAuthenticated = false;
            
            // Check plain text password (untuk data existing)
            if ($user->password === $request->password) {
                $isAuthenticated = true;
            }
            
            // Check hashed password (untuk user baru dari register)
            if (!$isAuthenticated && Hash::check($request->password, $user->password)) {
                $isAuthenticated = true;
            }
            
            if ($isAuthenticated) {
                Auth::guard('usermanual')->login($user);
                $request->session()->regenerate();
                
                // Redirect berdasarkan user_type
                if ($user->user_type === 'penjual') {
                    // Langsung ke dashboard, tidak cek kelengkapan data
                    return redirect()->route('penjual.dashboard')->with('success', 'Login berhasil!');
                } else if ($user->user_type === 'penitip') {
                    return redirect()->route('penitip.daftar_toko')->with('success', 'Login berhasil!');
                }
                
                return redirect('/')->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle register request
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:tbl_user,email',
            'password' => 'required|min:4|confirmed',
            'user_type' => 'required|in:penitip,penjual',
        ]);

        // Create user dengan hashed password
        $user = UserManual::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        // Create profile berdasarkan user_type dengan default values
        if ($request->user_type === 'penitip') {
            Penitip::create([
                'user_id' => $user->user_id,
                'name' => $request->name ?? 'User' . $user->user_id,
                'no_hp' => '-',
                'alamat' => '-',
                'foto_profile' => 'default.jpg',
                'is_active' => true,
                'created_at' => now(),
            ]);
        } else if ($request->user_type === 'penjual') {
            Penjual::create([
                'user_id' => $user->user_id,
                'nama_toko' => $request->nama_toko ?? 'Toko' . $user->user_id,
                'no_hp' => '-',
                'tanggal_join' => now()->toDateString(),
                'deskripsi_toko' => '-',
                'jam_buka' => now()->startOfDay(),
                'jam_tutup' => now()->endOfDay(),
                'nama_pemilik' => '-',
                'alamat_toko' => '-',
                'created_at' => now(),
            ]);
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::guard('usermanual')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
