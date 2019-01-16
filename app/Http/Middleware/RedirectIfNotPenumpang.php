<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotPenumpang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard="penumpang")
     {
         if(!auth()->guard($guard)->check()) {
             return redirect(route('penumpang.login'));
         }
         return $next($request);
     }
}
