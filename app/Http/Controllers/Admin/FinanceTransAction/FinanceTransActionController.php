<?php

namespace App\Http\Controllers\Admin\FinanceTransAction;

use App\Http\Controllers\Controller;
use App\Models\FinanceTransaction;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class FinanceTransActionController extends Controller
{
    public function index()
    {
        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.index')->getData()['breadcrumbs'];

        $financeTransactions=FinanceTransaction::orderBy('user_id','desc')->get()->unique('user_id');
        return view('Admin.FinanceTransAction.index',compact('financeTransactions','breadcrumbs'));
    }
    public function details(FinanceTransaction $finance){

        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.details',$finance)->getData()['breadcrumbs'];
        $financeTransactions=FinanceTransaction::orderBy('user_id','desc')->where('user_id',$finance->user_id)->get();
        return view('Admin.FinanceTransAction.details',compact('financeTransactions','breadcrumbs'));
    }
}
