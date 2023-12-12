<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if (Auth::check())
        {
            if (Auth::user()->roll == 0  && Auth::user()->verifyotp == 1)
            {
                return $next($request);
            }
            else
            {
                session()->put('error','Your are not seem to be Admin');
                return redirect()->route('AdminSignInForm');
            }
        }
        else
        {
            session()->put('error','Login first in order to access dashboard');
            return redirect()->route('AdminSignInForm');
        }
    }
}
