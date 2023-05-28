<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalasAndInovasi
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
        if (Auth::guard('guru')->check()) {
            if (Auth::guard('guru')->user()->walas || Auth::guard('guru')->user()->inovasi) return $next($request);

            abort(403, 'Anda Tidak Memiliki Hak Akses');
        }
        return redirect()->guest('/login-guru');
    }
}
