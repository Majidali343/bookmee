<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Response::macro('success',function ($data){
            return response()->json($data,201);
        });
        Response::macro('error',function ($data){
            return response()->json($data,404);
        });
    }
}