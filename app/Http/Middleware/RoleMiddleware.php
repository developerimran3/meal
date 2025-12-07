<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // if (auth()->check() && auth()->user()->role === $role) {
        //     return $next($request);
        // }

        // abort(403, 'Unauthorized Access');

        // Check if user is logged in
        if (!auth()->check()) {
            abort(403, 'Unauthorized Access');
        }

        // Split roles by pipe '|' to get an array
        $rolesArray = explode('|', $role);

        // Check if logged-in user's role is in the array
        if (in_array(auth()->user()->role, $rolesArray)) {
            return $next($request);
        }

        // If role doesn't match, abort
        abort(403, 'Unauthorized Access');
    }
}
