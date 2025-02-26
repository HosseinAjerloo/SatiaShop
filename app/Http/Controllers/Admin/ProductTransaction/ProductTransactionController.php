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
class ProductTransactionController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.index')->getData()['breadcrumbs'];

        $query = ProductTransaction::Search()->select(DB::raw('max(id) as id'))->groupBy('product_id')->get()->pluck('id')->toArray();
        $productTransactions = ProductTransaction::whereIn('id',$query);

        if ($request->input('customDate'))
        {
            $productTransactions = $productTransactions->get();

            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('customDate')));
            $productTransactions=$productTransactions->filter(function ( $value,  $key) use ($date) {
              return  Carbon::make($value->created_at)->toDateString()>=$date;
            });
            $perPage = 20;
            $page =$request->input('page')?$request->input('page'):1;
            $paginatedItems = $productTransactions->forPage($page,$perPage);
            $productTransactions = new LengthAwarePaginator(
                $paginatedItems,
                $productTransactions->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

        }
        else{
            $productTransactions = $productTransactions->paginate(20,['*'],'page')->withQueryString();
        }
        return view('Admin.ProductTransAction.index', compact('productTransactions', 'breadcrumbs'));
    }

    public function details(Product $product)
    {
        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.details',$product)->getData()['breadcrumbs'];
        $productTransactions = ProductTransaction::Search()->orderBy('created_at', 'desc')->where('product_id', $product->id)->paginate(20,['*'],'page')->withQueryString();
        return view('Admin.ProductTransAction.details', compact('productTransactions', 'breadcrumbs','product'));
    }
}
