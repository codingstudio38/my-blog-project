<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsNotloggedin
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
        $login_route = route('login');
        $user_home = route('user-home');
        if(Session()->has('user_data')){
            return redirect($user_home)->with('failed_','You Are Already Logged In..!!');
        }  
        return $next($request)
        ->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
    }
}
