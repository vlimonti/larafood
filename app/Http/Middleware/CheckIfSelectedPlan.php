<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfSelectedPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has('plan'))
        {
            return redirect()->route('site.home');
        }

        return $next($request);
    }
}
