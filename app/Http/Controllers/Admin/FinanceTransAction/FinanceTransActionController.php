<?php

namespace App\Http\Controllers\Admin\FinanceTransAction;

use App\Http\Controllers\Controller;
use App\Models\FinanceTransaction;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class FinanceTransActionController extends Controller
{
    public function index(Request $request)
    {

        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.index')->getData()['breadcrumbs'];

        $financeTransactions=FinanceTransaction::Search()->orderBy('user_id','desc')->get()->unique('user_id');

        if ($request->input('customDate'))
        {
            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('customDate')));
            $financeTransactions=$financeTransactions->filter(function ( $value,  $key) use ($date) {
                return  Carbon::make($value->created_at)->toDateString()>=$date;
            });
        }

        return view('Admin.FinanceTransAction.index',compact('financeTransactions','breadcrumbs'));
    }
    public function details(FinanceTransaction $finance){

        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.details',$finance)->getData()['breadcrumbs'];
        $financeTransactions=FinanceTransaction::Search()->orderBy('user_id','desc')->where('user_id',$finance->user_id)->get();
        return view('Admin.FinanceTransAction.details',compact('financeTransactions','breadcrumbs','finance'));
    }
}
