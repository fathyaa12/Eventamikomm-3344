<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                return $next($request);
            }
            if ($user->role === 'organizer') {
                if ($user->status === 'active') {
                    return $next($request);
                }
                if ($user->status === 'pending') {
                    abort(403, 'Akun Anda sedang dalam proses verifikasi oleh Admin.');
                }
                abort(403, 'Akun Anda telah ditangguhkan/suspended.');
            }
        }
        
        abort(403, 'Unauthorized action.');
    }
}
