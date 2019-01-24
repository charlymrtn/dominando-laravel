<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
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
        $roles = array_slice(func_get_args(),2);
        if (Auth::user()->hasRoles($roles)){
            return $next($request);
        }

        return redirect()->route('index')->with('error','no tienes acceso a esta ruta');
    }
}
