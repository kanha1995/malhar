<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class SuperAdmin
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
        // if (!auth()->check()) {
        //     return redirect()->route('login');
        // }

        // if (auth()->user()->role == 3) {
        //     return redirect()->route('leadManagerDashboard');
        // }

        // if (auth()->user()->role == 4) {
        //     return redirect()->route('projectManagerDashboard');
        // }

        // return $next($request);
        $response = $next($request);
        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
}
