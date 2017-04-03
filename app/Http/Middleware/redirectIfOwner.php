<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class redirectIfOwner
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
        $user_id = explode('/',$request->getRequestUri());
        $user_id = $user_id[2];
//        dd($user_id); die();
        if (Auth::user()->isOwner($user_id)){

            return $next($request);
        }else {
            return redirect('/forbidden');
        }
    }
}
