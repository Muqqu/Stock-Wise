<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Mstauthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /*  public function handle(Request $request, Closure $next)
    {
    // Your SQL logic here
    if ($request->session()->has('USER_LOGIN')) {
    // User is logged in
    } else {
    $mstauth = DB::table('mstauthorization')->get();
    }

    return $next($request);
    }   */

    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('USER_LOGIN')) {
            return redirect('login');
        }

        return $next($request);
    }
}
