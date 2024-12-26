<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Menangani request yang masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Memeriksa apakah pengguna terautentikasi
        if (Auth::guard($guards)->check()) {
            return $next($request);
        }

        // Jika belum terautentikasi, redirect ke halaman login
        return redirect()->route('login');
    }
}
