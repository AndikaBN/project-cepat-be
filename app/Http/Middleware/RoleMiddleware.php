<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
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

        return abort(403, 'Unauthorized');
    }
}
