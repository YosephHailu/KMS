<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::User()->hasAnyPermission([$permission])) {
            abort(401);           
        }
        
        return $next($request);
    }
}
