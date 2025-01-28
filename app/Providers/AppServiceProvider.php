<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
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


        \Illuminate\Support\Facades\View::composer('Panel.Layout.header', function (View $view) {
            $user = Auth::user();
            $myCart = Cart::where('status', 'addToCart')->where(function ($query) use ($user) {
                $query->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', request()->ip());

            })->first();
                $categories=Category::where('status','active')->orderBy('view_sort','asc')->limit(7)->get();
                $view->with(['myCart' => $myCart,'categories'=>$categories]);



        });


    }
}
