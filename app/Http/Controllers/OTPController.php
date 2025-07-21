<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class OTPController extends Controller
{
    public function form()
    {
        return view('otp.form');
    }




    public function sendOtpFromForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->query('email');

        // Cek apakah email ada di database
        $user = DB::table('users')->where('user_email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email belum terdaftar di sistem kami.'
            ], 404);
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        session(['otp' => $otp, 'otp_email' => $email]);

        // Kirim email OTP
        Mail::to($email)->send(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => "OTP berhasil dikirim ke $email"
        ]);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required'
        ]);

        if (
            session('otp') == $request->otp_code &&
            session('otp_email') == $request->email
        ) {
            return redirect()->route('password.form');
        } else {
            return back()->with('success', '❌ OTP salah atau sudah kadaluarsa.');
        }
    }
    public function resetForm(Request $request)
    {
        // Cek apakah sesi otp dan email tersedia
        if (!session()->has('otp_email')) {
            return redirect()->route('otp.form')->with('success', 'Silakan verifikasi OTP terlebih dahulu.');
        }

        return view('reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        $email = session('otp_email');

        // Simulasi update password ke user (ganti sesuai struktur databasenya!)
        \DB::table('users')
            ->where('user_email', $email)
            ->update(['user_password' => bcrypt($request->new_password)]);

        session()->forget(['otp', 'otp_email']);

        return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }

}



