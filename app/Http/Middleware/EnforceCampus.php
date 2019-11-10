<?php

namespace App\Http\Middleware;

use Closure;

class EnforceCampus
{
    protected $redirectPath = 'profile';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->campus_id === null
            && $request->path() != 'profile'
            && $request->path() != 'profile/campus') {
            $request->session()->flash('alert', 'Por favor, actualiza tu campus.');
            return redirect()->guest($this->redirectPath)
                ->with('no_redirect', true);
        }

        return $next($request);
    }
}
