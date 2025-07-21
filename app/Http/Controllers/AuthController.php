<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('login'); // pastikan ada resources/views/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Perhatikan: sesuaikan kolom user_username sesuai di database users-mu
        if (Auth::attempt(['user_username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Redirect ke halaman home
            return redirect()->intended(route('home'));
        }

        // Jika gagal login, kembali ke login dengan error
        return back()->withErrors(['login' => 'Username atau password salah'])->withInput();
    }

    // Login sebagai guest (tanpa user sebenarnya)
    // public function loginGuest(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     session(['guest' => true]);

    //     return redirect()->route('home');
    // }


    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kamu sudah logout.');
    }

    // Contoh register user sederhana (bisa kamu kembangkan)
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,user_username',
            'password' => 'required|confirmed|min:6',
            // field lain jika ada
        ]);

        \App\Models\User::create([
            'user_username' => $request->username,
            'password' => bcrypt($request->password),
            // field lain jika ada
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
