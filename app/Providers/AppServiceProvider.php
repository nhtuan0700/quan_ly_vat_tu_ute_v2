<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Pagination\Paginator::useBootstrap();
        app()->singleton('date_format' ,function () {
            return config('constants.date_format');
        });
        app()->singleton('datetime_format' ,function () {
            return config('constants.datetime_format');
        });
    }
}
