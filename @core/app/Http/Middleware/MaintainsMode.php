<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MaintainsMode
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
        if (!empty(get_static_option('site_maintenance_mode')) && !Auth::guard('admin')->check()) {
            return response()->view('frontend.pages.maintain');
        }
        return $next($request);
    }
}
