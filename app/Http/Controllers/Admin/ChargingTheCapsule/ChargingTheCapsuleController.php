<?php

namespace App\Http\Controllers\Admin\ChargingTheCapsule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChargingTheCapsuleController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $myFavorites=$user->productFavorite()->where('status','active')->where('type','service')->get();
        $products=Product::where('status','active')->where('type','service')->get();
        $filterProducts = Product::whereIn('id',Product::where('status','active')->where('type','service')->select(DB::raw('max(id) as id' ))->groupBy('category_id')->get()->pluck('id')->toArray())->get();

        return view('Admin.ResidSharchCapsule.index',compact('myFavorites','products','filterProducts'));
    }
    public function store(ResidChargeCapsuleRequest $request)
    {
            dd(\request()->all(),'hi');
    }
}
