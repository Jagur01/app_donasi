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

        // Ensure the user is authenticated
        if (!$user) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        // Check if the user has the required role
        if ($user->roles_id != $role) {
            return redirect('/')->with('error', 'Unauthorized Access');
        }

        // Allow the request to proceed if the role matches
        return $next($request);
    }
}
