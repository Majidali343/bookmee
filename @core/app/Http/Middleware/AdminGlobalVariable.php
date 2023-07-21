<?php

namespace App\Http\Middleware;

use App\Language;
use App\Page;
use App\TopbarInfo;
use Closure;
use Illuminate\Http\Request;

class AdminGlobalVariable
{

    public function handle(Request $request, Closure $next)
    {
        view()->composer('*', function ($view) {
            $lang = !empty(session()->get('lang')) ? session()->get('lang') : Language::where('default',1)->first()->slug;
            $all_languages = Language::all();
            $home_variant_number = get_static_option('home_page_variant');
            $admin_languages = Language::where(['default'=>1,'status'=>'publish'])->first();
            $admin_default_lang = $admin_languages->slug;

            $view->with('home_variant_number', $home_variant_number);
            $view->with('all_languages', $all_languages);
            $view->with('admin_default_lang', $admin_default_lang);

        });
        return $next($request);
    }
}
