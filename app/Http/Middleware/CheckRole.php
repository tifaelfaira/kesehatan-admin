<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole  // PERHATIKAN: NAMA CLASS HARUS CheckRole, BUKAN CheckIsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        
        // Jika user belum login, redirect ke login
        if (!$user) {
            return redirect()->route('auth.index')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }
        
        // Cek jika user memiliki salah satu role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }
        
        // Jika tidak memiliki akses
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}