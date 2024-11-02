<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        // Pastikan Pengguna Sudah Terautentikasi
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Dapatkan Peran Pengguna Saat Ini
        $userRole = Auth::user()->role;

        // Periksa Apakah Peran Pengguna Termasuk Dalam Daftar Yang Diperbolehkan
        if (!in_array($userRole, $roles)) {
            return redirect('/unauthorized'); // Rute Jika Tidak Diizinkan
        }

        return $next($request);
    }
}
