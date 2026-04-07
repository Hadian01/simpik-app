<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\UserManual;
use App\Models\Penitip;
use App\Models\Penjual;
use App\Mail\ResetPasswordMail;

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
            'user_type' => 'required|in:penitip,penjual',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tbl_user,email',
            'password' => 'required|min:4|confirmed',
        ]);

        // Create user dengan hashed password
        $user = UserManual::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        // Create profile berdasarkan user_type dengan nama dari input
        if ($request->user_type === 'penitip') {
            Penitip::create([
                'user_id' => $user->user_id,
                'name' => $request->name,
                'no_hp' => '-',
                'alamat' => '-',
                'foto_profile' => 'default.jpg',
                'is_active' => true,
                'created_at' => now(),
            ]);
        } else if ($request->user_type === 'penjual') {
            Penjual::create([
                'user_id' => $user->user_id,
                'nama_toko' => 'Toko ' . $request->name,
                'nama_pemilik' => $request->name,
                'no_hp' => '-',
                'tanggal_join' => now()->toDateString(),
                'deskripsi_toko' => '-',
                'jam_buka' => now()->startOfDay(),
                'jam_tutup' => now()->endOfDay(),
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

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:tbl_user_manual,email'
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem'
        ]);

        // Get user for name
        $user = UserManual::where('email', $request->email)->first();
        $userName = null;
        
        if ($user) {
            if ($user->user_type === 'penitip' && $user->penitip) {
                $userName = $user->penitip->name;
            } elseif ($user->user_type === 'penjual' && $user->penjual) {
                $userName = $user->penjual->nama_pemilik;
            }
        }

        // Generate reset token
        $token = \Str::random(60);
        
        // Store in password_resets table
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Generate reset URL
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);
        
        // Send email
        try {
            Mail::to($request->email)->send(new ResetPasswordMail($resetUrl, $userName));
            
            return back()->with('status', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
        } catch (\Exception $e) {
            // If email fails, show link for testing
            return back()->with('status', 
                'Gagal mengirim email. Link reset password: ' . $resetUrl . 
                ' (Error: ' . $e->getMessage() . ')'
            );
        }
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Handle reset password request
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:tbl_user_manual,email',
            'password' => 'required|min:4|confirmed'
        ], [
            'email.exists' => 'Email tidak ditemukan',
            'password.min' => 'Password minimal 4 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        // Check if token exists and is valid
        $reset = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Token reset tidak valid']);
        }

        // Check if token matches (token is hashed in database)
        if (!Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'Token reset tidak valid']);
        }

        // Check if token is not expired (24 hours)
        $createdAt = \Carbon\Carbon::parse($reset->created_at);
        if ($createdAt->addHours(24)->isPast()) {
            return back()->withErrors(['email' => 'Token reset sudah expired. Silakan request ulang.']);
        }

        // Update user password
        $user = UserManual::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete used token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }
}

