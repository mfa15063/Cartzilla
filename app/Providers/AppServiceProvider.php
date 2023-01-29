<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Session;
use Illuminate\Support\Facades\Schema;
use App\Models\Cart;
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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        $categories = Category::all();
        $brands = Brand::get();
        $cart = Session::has('cart') ? Session::get('cart') : [];
        View::share('categories', $categories);
        View::share('brands', $brands);
        View::share('cartcount', sizeof($cart));

    }
}
