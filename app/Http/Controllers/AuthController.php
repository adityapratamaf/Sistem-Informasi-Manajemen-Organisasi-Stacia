<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Users;

class AuthController extends Controller
{
    // ===== Auth =====

    // Pengalihan Halaman
    public function index()
    {
        return view('auth.login');
    }

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

        if (Auth::attempt($kredensial)) {
            $user = Auth::user();
            if ($user->status == 1) {
                return redirect('/dashboard');
            } else {
                return redirect('/login')->with('warning', 'Status Akun Tidak Aktif');
            }
        } else {
            return redirect('/login')->with('danger', 'Username / Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
