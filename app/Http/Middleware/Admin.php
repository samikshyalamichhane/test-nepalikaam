<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Auth;

class Admin
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
        // $user_access = explode(",",Auth::user()->access_level);
        // dd($user_access);
        $segment =  Request::segment(2);
        if($userRole == 'admin'){
            return $next($request);
          }
        $access_levels_string = auth()->user()->access_level;
        $access_levels = explode(',',$access_levels_string);
        if(in_array($segment, $access_levels)){
         return $next($request);
        }
        return redirect()->route('adminlogin')->with('message','You dont have access');
    }
}
