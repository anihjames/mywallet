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
            return redirect('/auth/login')->with('warning','Please Confirm Email to Login');
        }elseif(Auth::user()->access == 0) {
            Auth::logout();
            return redirect('/auth/login')->with('danger','Account Has been blocked');
        }
        return $next($request);
    }
}
