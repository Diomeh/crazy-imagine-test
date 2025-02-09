<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Custom auth middleware
 */
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and trying to access the signin or signup pages
        if (Auth::check()) {
            if ($request->is('signin') || $request->is('signup')) {
                return redirect()->intended('dashboard');
            }
        } elseif ($request->is('dashboard') || $request->is('logout')) {
            // Prevent guest users from accessing dashboard or logout
            return redirect()->intended('signin');
        }

        return $next($request);
    }
}
