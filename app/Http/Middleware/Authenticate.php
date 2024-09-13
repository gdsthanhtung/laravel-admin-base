<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        //return $request->expectsJson() ? null : route('login');
        if (!Auth::check()) { // chưa đăng nhập
            return route('login');
        }else{
            $user = Auth::user();
            $route = $request->route()->getName();
            dump($user->can($route));
            return $next($request);
        }


    }
}
