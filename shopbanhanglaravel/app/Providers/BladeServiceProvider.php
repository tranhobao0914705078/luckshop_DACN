<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      Blade::if('hasrole', function($expression){
        if(Auth::user()){
            if(Auth::user()->hasAnyRoles($expression)){
                return true;
            }
        }
        return false;
      });
    }
}
