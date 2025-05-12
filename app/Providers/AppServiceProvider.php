<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
            $myCart = Cart::where('status', 'addToCart')->when($user, function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->when(!$user, function ($query) {
                $query->where('id', session()->get('cart_id'));
            })->first();
            $categories = Category::where('status', 'active')->orderBy('view_sort', 'asc')->limit(7)->get();
            $products = Product::where("status", 'active')->orderBy('created_at', 'desc')->limit(6)->get();
            $categoryMenus = Category::where("status", 'active')->whereNull('category_id')->get();

            if ($myCart)
                session(['cart_id' => $myCart->id]);
            $view->with(['myCart' => $myCart, 'categories' => $categories, 'products' => $products, 'categoryMenus' => $categoryMenus]);


        });
        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                if (in_array($permission->id, $user->getAllPermissionUser())) {
                    return true;
                }
                return false;
            });
        }

    }
}
