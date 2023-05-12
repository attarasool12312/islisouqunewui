<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

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
//        $allowed_host = array('www.islisouq.com','islisouq.com','199.247.9.117');
//
//        if (!isset($_SERVER['HTTP_HOST']) || !in_array($_SERVER['HTTP_HOST'], $allowed_host))
//        {
//            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
//            exit;
//        }
        Schema::defaultStringLength(191);
		
		Paginator::useBootstrap();
    }
}
