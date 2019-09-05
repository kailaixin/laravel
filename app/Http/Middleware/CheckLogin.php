<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming reqauest.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=request()->session()->get('user');
        if(!$user){
         return redirect('huowu/login');
        }
        return $next($request);
    }
}
