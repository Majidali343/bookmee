<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class UserRoleCheck
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
        $allowed_url_list = [
            'seller/logout',
            'buyer/send',
            'buyer/load-latest-messages'
        ];
        if (Auth::guard('web')->check() &&
            1 !== Auth::guard('web')->user()->user_type &&
            !in_array(request()->path(),$allowed_url_list)){
            return redirect()->to('/');
        }
        return $next($request);

    }
}

