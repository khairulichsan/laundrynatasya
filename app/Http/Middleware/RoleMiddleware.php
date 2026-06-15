<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
{
    if (!Auth::check() || Auth::user()->role !== $role) {
        // Jika bukan admin, lempar kembali ke dashboard dengan pesan peringatan
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Menu ini hanya untuk ' . $role);
    }

    return $next($request);
}
}
