<?php

namespace App\Http\Controllers\Admin\FinanceTransAction;

use App\Http\Controllers\Controller;
use App\Models\FinanceTransaction;
use Illuminate\Http\Request;

class FinanceTransActionController extends Controller
{
    public function index()
    {
        $financeTransactions=FinanceTransaction::orderBy('user_id','desc')->get()->unique('user_id');
        return view('Admin.FinanceTransAction.index',compact('financeTransactions'));
    }
    public function details(FinanceTransaction $finance){
         
        $financeTransactions=FinanceTransaction::orderBy('user_id','desc')->where('user_id',$finance->user_id)->get();
        return view('Admin.FinanceTransAction.details',compact('financeTransactions'));
    }
}