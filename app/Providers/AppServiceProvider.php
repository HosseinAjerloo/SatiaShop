<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::loginUsingId(1);


        \Illuminate\Support\Facades\View::composer('Site.Layout.header', function (View $view) {
            $user = Auth::user();
            $myCart = Cart::where('status', 'addToCart')->where(function ($query) use ($user) {
                $query->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', request()->ip());

            })->first();
            $count = 0;
            if ($myCart)
                $count = $myCart->cartItem->count();
            else
                $view->with(['countCart' => $count]);

            $view->with(['countCart' => $count]);


        });


    }
}
