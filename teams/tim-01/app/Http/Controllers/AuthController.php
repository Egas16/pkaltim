<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ===== HALAMAN LOGIN =====
    public function loginPage()
    {
        return view('Login'); // SESUAIKAN NAMA FILE (Login.blade.php)
    }

    // ===== PROSES LOGIN =====
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔥 LANGSUNG KE DASHBOARD
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

    // ===== LOGOUT =====
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
