<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with(['invoices', 'cart.cartItems'])->find($id);
    
        return view('user.show', compact('user'));
    }
    public function history()
    {
    // Contoh ambil dari model User_keys atau UserReward
    $histories = [
        [
            'name' => 'Nebula Vault',
            'rarity' => 'Epic',
            'quantity' => 2,
            'reward' => 'Voucher Steam Rp. 12.000',
        ],
        // Tambah data lainnya sesuai database jika ada
    ];

        return view('user.history', compact('histories'));
    }

    public function login(Request $request)
    {
    $credentials = [
        'user_username' => $request->username,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Login berhasil!');
    }

    return back()->withErrors(['login' => 'Username atau password salah.']);
    }

     public function logout(Request $request)
    {
        Auth::logout(); // Logout user dari guard

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/')->with('success', 'You have been logged out.');
    }
    
    public function register(Request $request)
    {
        $request -> validate([
            'nama_user' => 'required|string|max:100',
            'user_username' => 'required|string|max:100|unique:users,user_username',
            'user_email' => 'required|email|unique:users,user_email',
            'user_password' => 'required|min:6|confirmed',
            'no_telp' => 'required|digits_between:10,12',
            'role' => 'required|in:user,seller',

        ]);

        $user = new User();
        $user->nama_user = $request->nama_user;
        $user->user_username = $request->user_username;
        $user->user_email = $request->user_email;
        $user->user_password = Hash::make($request->user_password);
        $user->user_role = $request->role;
        $user->no_telp = $request->no_telp;
        $user->save();


        $user->kode_user = 'USR' . str_pad($user->user_id,4,0,STR_PAD_LEFT);
        $user -> save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');

    }

    public function reset_password(Request $request)
    {
        $request -> validate([
            'user_email' => 'required|email|exists:users,user_email',
            'user_password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('user_email',$request -> user_email)->first();
        $user ->user_password = Hash::make($request->user_password);
        $user ->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset!');
    }
    
}