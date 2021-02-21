<?php

namespace App\Http\Middleware;
use Closure;
use App\Exceptions\UnauthorizedException;

class RolesAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $role_id = auth()->user()->role_id;

        throw_if($role_id!=1, UnauthorizedException::noPermission());

        return $next($request);
    }
}
