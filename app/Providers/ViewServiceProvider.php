<?php

namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\ContactComposer;
use App\Http\View\Composers\QtyProComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('main/header', CategoryComposer::class);
        View::composer('main/footer', CategoryComposer::class);
        View::composer('main/footer', ContactComposer::class);
        View::composer('main/cart', CartComposer::class);

    }
}
