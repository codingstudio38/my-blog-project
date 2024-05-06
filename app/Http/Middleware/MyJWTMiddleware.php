<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class MyJWTMiddleware
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
        try {
            if(!Auth::check()){
                $datais = array(
                    'message'=>'Unauthorized',
                    'error'=>array("error"=>"Invalid token provided"),
                    'status'=>false, 
                );
                return response()->json($datais,401);
            }
        } catch (Exception $e) {
            $erroris = array(
            'message'=>$error->getMessage(),
            'error'=>$error,
            'status'=>false,
        );
        return response()->json($erroris, 400);  
        }
        return $next($request);
    }
}
