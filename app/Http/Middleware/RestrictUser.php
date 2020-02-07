<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
class RestrictUser
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
        if(Auth::user()->verified_email == 0) {
            Auth::logout();
            return redirect('/login')->with('warning','Please Confirm Email to Login');
        }
        return $next($request);
    }
}
