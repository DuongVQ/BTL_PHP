<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('home.header', function ($view) {
            $cartSidebar = collect();
            if (Auth::check()) {
                $cartSidebar = Cart::where('user_id', Auth::id())->with('product')->get();
            }
            $view->with('cartSidebar', $cartSidebar);
        });
    }
}
