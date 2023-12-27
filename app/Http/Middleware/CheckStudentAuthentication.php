<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated via the 'student' guard
        if (Auth::guard('student')->check()) {
            // If authenticated, retrieve the user's name
            $userName = Auth::guard('student')->user()->name;
            // You can use $userName as needed within the middleware
            // For example, logging or performing certain actions based on the user's name

            // Proceed with the request
            return $next($request);
        }

        // If not authenticated, redirect or perform some action
        return redirect()->route('login'); // Redirect to the login page, adjust as needed
    }
}
