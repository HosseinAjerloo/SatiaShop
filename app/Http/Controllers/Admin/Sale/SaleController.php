<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        dd('hossein');
        $user = Auth::user();
        $allUser = User::all();
        $myFavorites = $user->productFavorite()->where('status', 'active')->where('type', 'goods')->get();
        $products = Product::where('status', 'active')->where('type', 'goods')->get();
        $filterProducts = Product::whereIn('id', Product::where('status', 'active')->where('type', 'goods')->select(DB::raw('max(id) as id'))->groupBy('category_id')->get()->pluck('id')->toArray())->get();

        return view('Admin.Sale.index',compact('myFavorites', 'products', 'filterProducts', 'allUser'));

    }
}
