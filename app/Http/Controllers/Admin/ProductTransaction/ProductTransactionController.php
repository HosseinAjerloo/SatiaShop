<?php

namespace App\Http\Controllers\Admin\ProductTransaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTransaction;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index()
    {

        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.index')->getData()['breadcrumbs'];

        $productTransactions = ProductTransaction::orderBy('product_id', 'desc')->get()->unique('product_id');
        return view('Admin.ProductTransaction.index', compact('productTransactions', 'breadcrumbs'));
    }

    public function details(Product $product)
    {

        $breadcrumbs = Breadcrumbs::render('admin.product.transaction.details',$product)->getData()['breadcrumbs'];
        $productTransactions = ProductTransaction::orderBy('product_id', 'desc')->where('product_id', $product->id)->get();
        return view('Admin.ProductTransaction.details', compact('productTransactions', 'breadcrumbs'));

    }
}
