<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()->admin) {
            if (Auth::user()['admin']['tipe']->tipe === 'Super Admin') {
                return $next($request);
            }
        }

        return abort('404');

    }
}
