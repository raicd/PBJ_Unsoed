<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        // belum login
        if (!$user) {
            return redirect()->route('login');
        }

        // role tidak cocok
        if (!isset($user->role) || $user->role !== $role) {
            // lempar ke gerbang biar smart redirect kamu jalan
            return redirect()->route('home');
        }

        return $next($request);
    }
}
