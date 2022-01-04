<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == '1') {
            return $next($request);
        }else if(auth()->user()->role == '2'){
            return $next($request);
        }
        return response()->json('Your account is inactive');
        
    }
}
