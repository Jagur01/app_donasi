<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Check if the user has the required role
        if ($user && $user->roles_id == 2) {
            return $next($request);
        }

        // Redirect or return unauthorized response
        return redirect('/')->with('error', 'Unauthorized Access');
    }
}
