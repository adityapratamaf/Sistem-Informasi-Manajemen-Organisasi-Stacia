<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // ===== Auth =====

    // Pengalihan Halaman
    public function index()
    {
        return view('auth.login');
    }

    // Validasi Request Login
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $kredensial = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Cek Keterdesiaan Akun Di database
        $user = User::where('username', $kredensial['username'])->first();
        if (!$user) {
            return redirect('/login')->with('danger', 'Akun Tidak Terdaftar');
        }

        // Cek Validasi Akun Yang Login Di Database
        if (Auth::attempt($kredensial)) {
            $user = Auth::user();
            if ($user->status == 1) {
                return redirect('/dashboard');
            } else {
                Auth::logout();
                return redirect('/login')->with('warning', 'Status Akun Tidak Aktif');
            }
        } else {
            Auth::logout();
            return redirect('/login')->with('danger', 'Username Password Salah');
        }

        // Cek Validasi Akun Yang Login Di Database
        // if (Auth::attempt($kredensial)) {
        //     $user = Auth::user();

        //     // Pastikan bahwa user memiliki relasi anggota
        //     if ($user->anggota) {
        //         if ($user->anggota->status == 1) {
        //             return redirect('/dashboard');
        //         } else {
        //             Auth::logout();
        //             return redirect('/login')->with('warning', 'Status Akun Tidak Aktif');
        //         }
        //     } else {
        //         Auth::logout();
        //         return redirect('/login')->with('danger', 'User tidak memiliki anggota yang terkait.');
        //     }
        // } else {
        //     return redirect('/login')->with('danger', 'Username atau Password Salah');
        // }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
