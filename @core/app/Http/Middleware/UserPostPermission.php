<?php

namespace App\Http\Middleware;

use App\Helpers\FlashMsg;
use Closure;

class UserPostPermission
{

    public function handle($request, Closure $next)
    {
        if (auth('web')->check() && auth('web')->user()->post_permission == 0 ){
            if(request()->routeIs('user.home') ){
                return redirect()->route('user.home.edit.profile');
            }
            return redirect()->route('user.home.edit.profile')->with(FlashMsg::error('You have no permission to access this page.. Please contact to the administrator..!'));
        }
        return $next($request);
    }
}

