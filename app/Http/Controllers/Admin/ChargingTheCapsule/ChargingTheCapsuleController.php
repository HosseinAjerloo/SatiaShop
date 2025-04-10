<?php

namespace App\Http\Controllers\Admin\ChargingTheCapsule;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChargingTheCapsuleController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $myFavorites=$user->productFavorite()->where('status','active')->where('type','service')->get();
        $products=Product::where('status','active')->where('type','service')->get();
        return view('Admin.residSharcheCapsule',compact('myFavorites','products'));
    }
}
