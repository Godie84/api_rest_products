<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If you want to use guards, define them here, e.g.:
        // $guards = ['web'];

        // Or, if you don't need guards, remove the loop and use default authentication:
        if (\Illuminate\Support\Facades\Auth::check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
