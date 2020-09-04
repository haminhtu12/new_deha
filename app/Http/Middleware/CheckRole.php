<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next ,...$roles)
    {
        $user = Auth::user();

        if (Auth::check() &&  $user->hasAnyRole($roles)) {

            return $next($request);
        }
        return redirect(abort(403, 'Unauthorized action.'));
    }
}
