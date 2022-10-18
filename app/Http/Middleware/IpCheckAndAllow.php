<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Location;

class IpCheckAndAllow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $ip='129.23.34.56';
        // $ip=$request->ip();
        // $location=Location::get($ip);
        // return response()->json(['success'=>$location->ip]);
        return $next($request);
    }
}


