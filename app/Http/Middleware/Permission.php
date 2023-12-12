<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laratrust\Middleware\LaratrustMiddleware;

class Permission extends LaratrustMiddleware
{
    /**
     * Handle incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        string|array $permissions,
        ?string $team = null,
        ?string $options = ''
    ) {
        // if user has (super-admin) role then access all permissions
        if(auth()->user()?->hasRole(['super-admin', 'director', 'manager'])){
            return $next($request);
        }

        if (! $this->authorization('permissions', $permissions, $team, $options)) {
            return $this->unauthorized();
        }

        return $next($request);
    }
}
