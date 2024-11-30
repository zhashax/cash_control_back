<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $user = Auth::user();

    // Allow access if the user has any of the specified roles
    if (!$user->roles()->whereIn('name', $roles)->exists()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return $next($request);
}

}
