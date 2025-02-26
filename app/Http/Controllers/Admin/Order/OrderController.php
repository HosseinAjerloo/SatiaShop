<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Dflydev\DotAccessData\Data;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $breadcrumbs = Breadcrumbs::render('admin.order.index')->getData()['breadcrumbs'];
        $orders=Order::Search()->orderBy('created_at','desc')->paginate(20,['*'],'page')->withQueryString();
        return view('Admin.Order.index',compact('orders','breadcrumbs'));
    }
    public function invoice()
    {
        $breadcrumbs = Breadcrumbs::render('admin.order.invoice')->getData()['breadcrumbs'];

        $invoiceOrders=Invoice::Search()->where('type_of_business','sales')->orderBy('created_at','desc')->paginate(20,['*'],'page')->withQueryString();
       return view('Admin.Order.Invoice.index',compact('invoiceOrders','breadcrumbs'));
    }
    public function invoiceDetails(Invoice $invoice){
        $invoiceItems=$invoice->invoiceItem()->orderBy('created_at','desc')->paginate(20,['*'],'page')->withQueryString();
        $breadcrumbs = Breadcrumbs::render('admin.order.invoiceDetails',$invoice)->getData()['breadcrumbs'];
        return view('Admin.Order.Invoice.details',compact('invoice','breadcrumbs','invoiceItems'));
    }
}
