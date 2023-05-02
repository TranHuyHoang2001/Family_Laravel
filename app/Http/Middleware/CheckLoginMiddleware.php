<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Sentinel::check())
        {
            \View::share([ 'currentUser' => Sentinel::getUser() ]);

            return $next($request);
        }
        return Redirect::route('login');
    }
}
