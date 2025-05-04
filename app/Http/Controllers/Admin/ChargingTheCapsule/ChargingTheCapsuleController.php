<?php

namespace App\Http\Controllers\Admin\ChargingTheCapsule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleRequest;
use App\Http\Traits\HasResideChargeCapsule;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reside;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChargingTheCapsuleController extends Controller
{
    use HasResideChargeCapsule;

    public function index()
    {
        $user = Auth::user();
        $allUser = User::all();
        $myFavorites = $user->productFavorite()->where('status', 'active')->where('type', 'goods')->get();
        $products = Product::where('status', 'active')->where('type', 'goods')->get();
        $filterProducts = Product::whereIn('id', Product::where('status', 'active')->where('type', 'goods')->select(DB::raw('max(id) as id'))->groupBy('category_id')->get()->pluck('id')->toArray())->get();

        return view('Admin.ResideChargeCapsule.index', compact('myFavorites', 'products', 'filterProducts', 'allUser'));
    }

    public function store(ResidChargeCapsuleRequest $request)
    {
        return $this->registerResideCapsule();
    }

    public function edit(Reside $reside)
    {
        $user = Auth::user();
        $allUser = User::all();
        $myFavorites = $user->productFavorite()->where('status', 'active')->where('type', 'service')->get();
        $products = Product::where('status', 'active')->where('type', 'goods')->get();
        $filterProducts = Product::whereIn('id', Product::where('status', 'active')->where('type', 'goods')->select(DB::raw('max(id) as id'))->groupBy('category_id')->get()->pluck('id')->toArray())->get();
        return view('Admin.ResideChargeCapsule.edit', compact('myFavorites', 'products', 'filterProducts', 'allUser', 'reside'));
    }

    public function update(ResidChargeCapsuleRequest $request, Reside $reside)
    {
        app('request')->merge(['reside' => $reside]);
        return $this->updateResideCapsule();
    }

    public function printReside(Reside $reside)
    {
        return view('Admin.PrintResideChargeCapsule.index', compact('reside'));
    }
}
