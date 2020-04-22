<?php

namespace App\Http\Middleware;

use Closure;

class CheckForRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        return $next($request);
    }
}
