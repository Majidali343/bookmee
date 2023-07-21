<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class BuyerCheck
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
        if (Auth::guard('web')->check() && 0 !== Auth::guard('web')->user()->user_type && !in_array(request()->path(),['seller/account-settings','seller/logout','seller/profile-edit', 'seller/send'])){
            return redirect()->to('/');
        }
        return $next($request);

    }

 }