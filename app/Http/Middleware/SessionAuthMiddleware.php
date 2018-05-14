<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class SessionAuthMiddleware
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
        if(session('uid') && User::find(session('uid'))){
            $request->user = User::find(session('uid'));
        }
        return $next($request);
    }
}
