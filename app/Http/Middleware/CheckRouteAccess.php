<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRouteAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user) return redirect('/login');

        $route = $request->route();
        $currentRouteName = $route ? $route->getName() : null;

        if (!$currentRouteName) return $next($request);

        $role = $user->role;
        if (!$role) abort(403, 'No role assigned.');

        if (!$role->routes->pluck('route_name')->contains($currentRouteName)) {
            abort(403, 'You do not have permission to access this route.');
        }

        return $next($request);
    }
}