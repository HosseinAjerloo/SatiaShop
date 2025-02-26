<?php

namespace App\Http\Controllers\Admin\FinanceTransAction;

use App\Http\Controllers\Controller;
use App\Models\FinanceTransaction;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class FinanceTransActionController extends Controller
{
    public function index(Request $request)
    {
        $query=FinanceTransaction::search()->select(DB::raw('Max(id) as id'))->groupBy('user_id')->pluck('id')->toArray();
        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.index')->getData()['breadcrumbs'];
        $financeTransactions=FinanceTransaction::whereIn('id',$query);

        if ($request->input('customDate'))
        {       $financeTransactions=$financeTransactions->get();

            $date=date('Y-m-d',changeFormatNumberToDate(request()->input('customDate')));
            $financeTransactions=$financeTransactions->filter(function ( $value,  $key) use ($date) {
                return  Carbon::make($value->created_at)->toDateString()>=$date;
            });
            $perPage = 1;
            $page =$request->input('page')?$request->input('page'):1;

            $financeTransactionsList=$financeTransactions->forPage($page,$perPage);
            $financeTransactions=new LengthAwarePaginator(
                $financeTransactionsList,
                $financeTransactions->count(),
                $perPage,
                $page,
                ['path'=>$request->url(),'query'=>$request->query()]
            );
        }
        else{
            $financeTransactions=$financeTransactions->paginate(20,['*'],'page')->withQueryString();
        }

        return view('Admin.FinanceTransAction.index',compact('financeTransactions','breadcrumbs'));
    }
    public function details(FinanceTransaction $finance){

        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.details',$finance)->getData()['breadcrumbs'];
        $financeTransactions=FinanceTransaction::Search()->orderBy('user_id','desc')->where('user_id',$finance->user_id)->get();
        return view('Admin.FinanceTransAction.details',compact('financeTransactions','breadcrumbs','finance'));
    }
}
