<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckPanitia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil ID Program Dari Route
        $programId = $request->route('program_id');

        // Periksa Pengguna Yang Login Adalah Panitia Dalam Suatu Program
        $isPanitia = \DB::table('panitia')
            ->where('users_id', Auth::id())
            ->where('program_id', $programId)
            ->where('role', 'panitia')
            ->exists();

        if ($isPanitia) {
            return $next($request);
        }

        // return redirect()->route('');

        return $next($request);
    }
}
