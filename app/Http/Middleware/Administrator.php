<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        abort(403, 'You do not have permission to perform this action.');
    }
}
