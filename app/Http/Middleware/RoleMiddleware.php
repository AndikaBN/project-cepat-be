<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('/');
        }

        foreach ($roles as $role) {
            if (auth()->user()->role == $role) {
                return $next($request);
            }

            if ($role == 'owner' && auth()->user()->role == 'kolektor') {
                return $next($request);
            }

            if ($role == 'owner' && auth()->user()->role == 'marketing') {
                return $next($request);
            }

            if ($role == 'owner' && auth()->user()->role == 'inputer') {
                return $next($request);
            }
        }

        // Hapus cookie login saat user tidak memiliki akses
        Auth::logout();
        Cookie::queue(Cookie::forget('laravel_session'));

        return abort(403, 'anda tidak memiliki akses');
    }
}
