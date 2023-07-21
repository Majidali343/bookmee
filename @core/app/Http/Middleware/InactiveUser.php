<?php

namespace App\Http\Middleware;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;


class InactiveUser
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->user_status == 0 ){
                $msg = FlashMsg::error('Your account is inactive! Please contact to the administrator');
                Auth::guard('web')->logout();
                $request->session()->invalidate();
 
                $request->session()->regenerateToken();
                return redirect()->route('user.login')->with($msg);
        }
        return $next($request);
    }
}

