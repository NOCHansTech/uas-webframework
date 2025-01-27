<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required','regex:/^\S*$/'],
            'password' => ['required']
        ],
        [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.'
        ]);
        // $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember') ? true : false; 
        
        if (Auth::attempt($credentials, $remember_me)) {
            // $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->to('/admin/dashboard');
            }elseif(Auth::user()->role == 'user'){
                return redirect()->to('/');
            }
        }
        return back()->withErrors([
            'loginFailed' => 'Login Gagal, Username atau Password yang Anda masukkan salah.'
        ]);
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('auth/login');
    }
}
