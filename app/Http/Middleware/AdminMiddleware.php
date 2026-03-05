<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Checks authentication first, then verifies admin role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check authentication first to avoid infinite redirect loops
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to access the admin panel.');
        }

        // Check admin role
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized. Admin access required.');
        }

        return $next($request);
    }
}
