<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Doller;
use App\Models\FinanceTransaction;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $invoices =Invoice::where("user_id",$user->id)->where('type_of_business','sales')->get();
        return view('Panel.order', compact('invoices'));
    }
    public function orderItem(Invoice $invoice)
    {
        return view('Site.Invoice.index', compact('invoice'));
    }
    public function invoiceDetail(Invoice $invoice)
    {
        return view('Panel.Invoice.index',compact('invoice'));
    }
    public function Expectation()
    {
        $user=Auth::user();
        $invoices=Invoice::where('user_id',$user->id)->orderBy('created_at','desc')->get();

        return view('Panel.Orders.expectation',compact('invoices'));
    }
    public function ExpectationDetails(Invoice $invoice)
    {
        $banks = Bank::where('is_active', 1)->get();
        return view('Panel.Orders.expectationDetails',compact('invoice','banks'));
    }
}
