<?php

namespace App\Http\Middleware;

use App\Helpers\FlashMsg;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserBanned
{

    public function handle($request, Closure $next)
    {
        if (auth('web')->check() && auth('web')->user()->is_banned == 1 ){
             $notification = FlashMsg::error('Your account has been blocked..! Please contact to the administrator');
                 Auth::guard('web')->logout();
                 $request->session()->invalidate();
                 $request->session()->regenerateToken();
                 return redirect()->route('user.login')->with($notification);
        }
        return $next($request);
    }
}
