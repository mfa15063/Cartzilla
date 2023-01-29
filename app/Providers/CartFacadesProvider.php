<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CartFacadesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('cart', function(){  //Keep in mind this "check" must be return from facades accessor
            return new \App\Repositories\Cart;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
