<?php

namespace App\Http\Middleware;

use Closure, Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticateUser
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
        if (Auth::guard(userGuard())->guest()) {
            if ($request->ajax()) return response('Unauthorized.', 401);
            else return redirect()->route('app.login'); // , ['backurl' => url()->current()]
        }
        return $next($request);
    }
}
