<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $knowledgeProduct)
    {
        if (!Auth::User()->hasAnyPermission(['create'])) {
            return redirect()->back()->with('success', 'You Don\'t Have Permission');
        }
        
        return $next($request);
    }
}
