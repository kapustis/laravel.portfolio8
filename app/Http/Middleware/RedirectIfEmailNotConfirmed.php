<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfEmailNotConfirmed
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
        if(! $request->user()->confirmed){
            return redirect('/blog')->with('flash','You must first confirm your email address.');
        }

        return $next($request);
    }
}
