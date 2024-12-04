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
    // Check if the user is authenticated
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $user = Auth::user();

    // Check if the user has any of the specified roles
    if (!$user->roles()->whereIn('name', $roles)->exists()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return $next($request);
}


}
