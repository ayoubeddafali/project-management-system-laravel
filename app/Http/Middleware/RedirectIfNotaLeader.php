<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotaLeader
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
        $project_id = explode('/',$request->getRequestUri());
        $project_id = $project_id[2];
        if(! $request->user()->isATeamLeader($project_id)){
            return redirect('layouts.forbidden');
            
            
        }

        return $next($request);
    }
}
