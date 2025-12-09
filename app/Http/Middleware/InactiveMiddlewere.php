<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InactiveMiddlewere
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // User logged in আছে কিনা চেক
        if (Auth::check()) {

            // যদি user active হয় → তাকে dashboard এ পাঠিয়ে দাও
            if (Auth::user()->is_active == true) {

                // শুধু active-profile page এ ঢুকতে দেবে না
                if ($request->route()->getName() == 'active.profile.form') {
                    return redirect()->route('dashboard');
                }
            }
        }
        return $next($request);
    }
}
