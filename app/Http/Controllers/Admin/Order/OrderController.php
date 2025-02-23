<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $breadcrumbs = Breadcrumbs::render('admin.order.index')->getData()['breadcrumbs'];
        $orders=Order::Search()->get();
        return view('Admin.Order.index',compact('orders','breadcrumbs'));
    }
    public function invoice()
    {
        $breadcrumbs = Breadcrumbs::render('admin.order.invoice')->getData()['breadcrumbs'];

        $invoiceOrders=Invoice::Search()->where('type_of_business','sales')->get();
       return view('Admin.Order.Invoice.index',compact('invoiceOrders','breadcrumbs'));
    }
    public function invoiceDetails(Invoice $invoice){
        $breadcrumbs = Breadcrumbs::render('admin.order.invoiceDetails',$invoice)->getData()['breadcrumbs'];
        return view('Admin.Order.Invoice.details',compact('invoice','breadcrumbs'));
    }
}
