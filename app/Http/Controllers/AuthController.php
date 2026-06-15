<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        // Pastikan jika user sudah login, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // Memproses data login yang dikirim kasir/admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencoba login menggunakan username dan password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // Jika gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
