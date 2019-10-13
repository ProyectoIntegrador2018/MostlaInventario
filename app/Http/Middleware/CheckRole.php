<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Models\UserRole;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!in_array($request->user()->type->title, explode('|', $roles))) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
