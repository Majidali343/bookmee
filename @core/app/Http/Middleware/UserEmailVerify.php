<?php

namespace App\Http\Middleware;

use Closure;

class UserEmailVerify
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
         if (auth('web')->check() && auth('web')->user()->email_verified == 0 && empty(get_static_option('disable_user_email_verify')) && request()->path() !== 'seller/logout'){
            return redirect()->route('email.verify');
        }
        return $next($request);
    }
}
