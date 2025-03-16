<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
    {
        $customMessages = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar di database'
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessages);

        $token = Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link reset password ke email Anda');
    }

    public function validasi_forgot_password_act(Request $request)
    {
        $customMessages = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ];

        $request->validate([
            'password' => 'required|min:8',
        ], $customMessages);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        $user = User::where('email', $token->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $token->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah');
    }

    public function validasi_forgot_password(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }
        return view('auth.validasi-token', compact('token'));
    }

    protected function authenticated(Request $request, $user)
    {
        // Debug session
        // dd(session()->all());
        
        if ($request->session()->has('redirect_url')) {
            $redirectUrl = $request->session()->pull('redirect_url');
            return redirect($redirectUrl);
        }

        return redirect()->route('donationuser.create', session()->pull('id-payment'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $redirectUrl = $this->getRedirectUrl($request);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Login Berhasil!',
                'redirect' => $redirectUrl,
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Email atau password salah.'
        ], 401);
    }
    
    protected function getRedirectUrl($request)
    {
        // 1. Cek redirect URL dari session
        if(session()->has('redirect_url')) {
            return session()->pull('redirect_url');
        }
    
        // 2. Default redirect berdasarkan role
        return $request->user()->roles_id == 1 ? '/home' : '/indexs';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
