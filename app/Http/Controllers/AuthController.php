<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    // menampilkan form login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user(); // gunakan Auth::user() supaya editor tidak warning
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/siswa/dashboard');
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // // pengecekan role dan proses login
    // public function login(Request $request)
    // {
    //     // validasi input
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required',
    //     ]);
        
    //     $credentials = $request->only('email','password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         //redirect berdasarkan role
    //         $user = Auth::user();

    //         if('user' === 'admin'){
    //             return redirect('admin.dashboard');
    //         } else {
    //             return redirect('admin.dashboard');
    //         }
    //     };

    //     // jika gagal login
    //     return back()->withErrors([
    //         'email'=> 'Email atau password salah',
    //     ]);
    // }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
