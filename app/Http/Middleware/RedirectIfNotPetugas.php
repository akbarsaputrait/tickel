<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotPetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard="petugas")
     {
         if(!auth()->guard($guard)->check()) {
             return redirect(route('petugas.login'));
         }
         return $next($request);
     }
}
