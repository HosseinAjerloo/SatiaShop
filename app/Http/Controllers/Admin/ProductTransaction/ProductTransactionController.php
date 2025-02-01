<?php

namespace App\Http\Controllers\Admin\ProductTransaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index()
    {
        $productTransactions=ProductTransaction::orderBy('product_id','desc')->get()->unique('product_id');
        return view('Admin.ProductTransaction.index',compact('productTransactions'));
    }
    public function details(Product $product)
    {
        $productTransactions=ProductTransaction::orderBy('product_id','desc')->where('product_id',$product->id)->get();
        return view('Admin.ProductTransaction.details',compact('productTransactions'));

    }
}
