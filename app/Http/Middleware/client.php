<?php

namespace App\Http\Middleware;

use Closure;

class client
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
        $userRole = auth()->user()->role;
            if($userRole=='client' && (auth()->user()->publish=='approved')){
                return $next($request);
            }
        return redirect()->route('home')->with('message','You dont have access');
    }
}
