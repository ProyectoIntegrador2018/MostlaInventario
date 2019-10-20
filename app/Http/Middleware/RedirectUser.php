<?php

namespace App\Http\Middleware;

use Closure;

class RedirectUser
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
        info($request->path());
        if ($request->session()->has('no_redirect')
            || !$request->session()->has('url.intended')
            || $request->path() == 'auth/google'
        ) {
            return $next($request);
        }

        $next($request);
        return redirect()->intended();
    }
}
