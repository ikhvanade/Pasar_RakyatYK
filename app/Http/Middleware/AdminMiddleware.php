<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login dan apakah dia admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/');
        }
        return $next($request);
    }
}
