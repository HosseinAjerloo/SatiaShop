<?php

namespace App\Http\Controllers\Admin\ProductTransaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTransaction;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

class ProductTransactionController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('admin.product.transaction.index');
        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.index')->getData()['breadcrumbs'];

        $query = ProductTransaction::Search()->select(DB::raw('max(id) as id'))->groupBy('product_id')->get()->pluck('id')->toArray();
        $productTransactions = ProductTransaction::whereIn('id',$query)->paginate(20,['*'],'page')->withQueryString();

        return view('Admin.ProductTransAction.index', compact('productTransactions', 'breadcrumbs'));
    }

    public function details(Product $product)
    {
        Gate::authorize('admin.product.transaction.details');
        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.details',$product)->getData()['breadcrumbs'];
        $productTransactions = ProductTransaction::Search()->orderBy('created_at', 'desc')->where('product_id', $product->id)->paginate(20,['*'],'page')->withQueryString();
        return view('Admin.ProductTransAction.details', compact('productTransactions', 'breadcrumbs','product'));
    }
}
