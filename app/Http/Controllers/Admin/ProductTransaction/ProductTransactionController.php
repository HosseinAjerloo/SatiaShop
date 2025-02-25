<?php

namespace App\Http\Controllers\Admin\ProductTransaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTransaction;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.index')->getData()['breadcrumbs'];

        $productTransactions = ProductTransaction::Search()->orderBy('product_id', 'desc')->get()->unique('product_id');


        if ($request->input('customDate'))
        {

            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('customDate')));
            $productTransactions=$productTransactions->filter(function ( $value,  $key) use ($date) {
              return  Carbon::make($value->created_at)->toDateString()>=$date;
            });

        }
        return view('Admin.ProductTransAction.index', compact('productTransactions', 'breadcrumbs'));
    }

    public function details(Product $product)
    {

        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.details',$product)->getData()['breadcrumbs'];
        $productTransactions = ProductTransaction::Search()->orderBy('product_id', 'desc')->where('product_id', $product->id)->get();
        return view('Admin.ProductTransaction.details', compact('productTransactions', 'breadcrumbs','product'));

    }
}
