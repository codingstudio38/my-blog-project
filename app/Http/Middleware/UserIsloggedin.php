<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsloggedin
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
        $path = explode("/",\Request::url());
        $current_path = end($path);
        $staticpath = array();   
        $login_route = route('login');
        $user_home = route('user-home');
        if(!Session()->has('user_data')){
            return redirect($login_route)->with('failed_','You Are Not Logged In..!!');
        }

        if(in_array($current_path, $staticpath)){//remove header cache from separate path  
            return $next($request);
        } else {
            return $next($request)
            ->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
        }
    }
}
