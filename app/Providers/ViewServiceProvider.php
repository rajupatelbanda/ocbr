<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        View::composer('*', function ($view) {
            $cartCount = 0; // Default count

            if (Auth::check()) { // Check if user is authenticated
                $cartCount = Cart::where('user_id', Auth::id())->count();
            }

            $view->with('cartCount', $cartCount);
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
