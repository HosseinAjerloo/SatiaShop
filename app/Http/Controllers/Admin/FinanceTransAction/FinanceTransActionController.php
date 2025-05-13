<?php

namespace App\Http\Controllers\Admin\FinanceTransAction;

use App\Http\Controllers\Controller;
use App\Models\FinanceTransaction;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FinanceTransActionController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('admin.finance.transaction.index');

        $query=FinanceTransaction::search()->select(DB::raw('Max(id) as id'))->groupBy('user_id')->pluck('id')->toArray();
        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.index')->getData()['breadcrumbs'];
        $financeTransactions=FinanceTransaction::whereIn('id',$query)->paginate(20,['*'],'page')->withQueryString();

        return view('Admin.FinanceTransAction.index',compact('financeTransactions','breadcrumbs'));
    }
    public function details(FinanceTransaction $finance){

        Gate::authorize('admin.finance.transaction.details');
        $breadcrumbs=Breadcrumbs::render('admin.finance.transaction.details',$finance)->getData()['breadcrumbs'];
        $financeTransactions=FinanceTransaction::Search()->orderBy('user_id','desc')->where('user_id',$finance->user_id)->get();
        return view('Admin.FinanceTransAction.details',compact('financeTransactions','breadcrumbs','finance'));
    }
}
