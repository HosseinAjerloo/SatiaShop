<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceIssuance\FinalInvoiceIssuanceRequest;
use App\Http\Requests\Admin\SaleProduct\SaleProductRequest;
use App\Http\Traits\HasDiscount;
use App\Http\Traits\HasResideChargeCapsule;
use App\Models\Product;
use App\Models\Reside;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mockery\Exception;

class SaleController extends Controller
{
    use HasResideChargeCapsule, HasDiscount;

    public function index()
    {
        Gate::authorize('admin.sale.index');
        $breadcrumbs = Breadcrumbs::render('admin.sale.index')->getData()['breadcrumbs'];

        $user = Auth::user();
        $allUser = User::all();
        $myFavorites = $user->productFavorite()->where('status', 'active')->where('type', 'goods')->get();
        $products = Product::where('status', 'active')->where('type', 'goods')->get();
        $filterProducts = Product::whereIn('id', Product::where('status', 'active')->where('type', 'goods')->select(DB::raw('max(id) as id'))->groupBy('category_id')->get()->pluck('id')->toArray())->get();

        return view('Admin.Sale.index', compact('myFavorites', 'products', 'filterProducts', 'allUser', 'breadcrumbs'));

    }

    public function store(SaleProductRequest $request)
    {
        Gate::authorize('admin.sale.index');
        $inputs = $request->all();
        return $this->registerSealCapsule();
    }

    public function edit(Reside $reside)
    {
        Gate::authorize('admin.sale.index');

        $user = Auth::user();
        $allUser = User::all();
        $myFavorites = $user->productFavorite()->where('status', 'active')->where('type', 'goods')->get();
        $products = Product::where('status', 'active')->where('type', 'goods')->get();
        $filterProducts = Product::whereIn('id', Product::where('status', 'active')->where('type', 'goods')->select(DB::raw('max(id) as id'))->groupBy('category_id')->get()->pluck('id')->toArray())->get();

        return view('Admin.Sale.edit', compact('myFavorites', 'products', 'filterProducts', 'allUser', 'reside'));

    }

    public function update(SaleProductRequest $request, Reside $reside)
    {

        Gate::authorize('admin.sale.index');
        app('request')->merge(['reside' => $reside]);
        return $this->updateSealCapsule();

    }

    public function show(Reside $reside)
    {

        $breadcrumbs = Breadcrumbs::render('admin.sale.show', $reside)->getData()['breadcrumbs'];

        return view('Admin.InvoiceIssuance.sale', compact('reside','breadcrumbs'));
    }

    public function generateFactor(Reside $reside, FinalInvoiceIssuanceRequest $request)
    {

        try {
            $this->compilationResideFactor($reside);
            return redirect()->route('admin.sale.printFactor', $reside)->with(['success' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);

        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }

    public function printFactor(Reside $reside)
    {
        return view('Admin.PrintFactorSaleCapsule.index', compact('reside'));
    }
}
