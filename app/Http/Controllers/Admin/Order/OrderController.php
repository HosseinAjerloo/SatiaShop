<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::Search()->get();
        return view('Admin.Order.index',compact('orders'));
    }
    public function invoice()
    {
       $invoiceOrders=Invoice::Search()->where('type_of_business','sales')->get();
       return view('Admin.Order.Invoice.index',compact('invoiceOrders'));
    }
    public function invoiceDetails(Invoice $invoice){
        return view('Admin.Order.Invoice.details',compact('invoice'));
    }
}
