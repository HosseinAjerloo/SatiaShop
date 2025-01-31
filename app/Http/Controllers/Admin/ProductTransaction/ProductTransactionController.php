<?php

namespace App\Http\Controllers\Admin\ProductTransaction;

use App\Http\Controllers\Controller;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index()
    {
        $productTransactions=ProductTransaction::all();
        return view('Admin.ProductTransaction.index',compact('productTransactions'));
    }
}
