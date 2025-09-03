<?php

namespace App\Http\Controllers\Admin\ChargingOperation;

use App\Http\Controllers\Controller;
use App\Models\Reside;
use App\Models\ResideItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChargingOperationController extends Controller
{
    public function index()
    {
        //todo اضافه کردن سطوح دسترسی
        $breadcrumbs = Breadcrumbs::render('admin.charging-operation.index')->getData()['breadcrumbs'];
        $resideItems = ResideItem::whereHas('reside', function (Builder $query) {
            $query->where('type', 'reside')->orderBy('user_id','desc');
        })->orderBy('reside_id')->doesntHave('productResidItem')->paginate(20);

        return view('Admin.ChargingOperation.index', compact('resideItems', 'breadcrumbs'));
    }
    public function searchAjax(Request $request)
    {

        $resideItems = ResideItem::Search()->whereHas('reside',function ($q){
            $q->where('type', 'reside');
        })->doesntHave('productResidItem')->cursorPaginate(20);
        if ($resideItems->count())
        {
            foreach ($resideItems->items() as $resideItem)
            {
             $resideItem->fullName=$resideItem->reside->user->fullName;
             $resideItem->image=asset('capsule/images/activecharging.svg');
             $resideItem->link=route('admin.invoice.issuance.operation', [$resideItem->reside,$resideItem]);
            }
            return response()->json(['status'=>true, 'data' => $resideItems->items(), 'nexPageUrl' => $resideItems->nextPageUrl(), 'hasMorePages'=>$resideItems->hasMorePages()]);
        }
        else
            return response()->json(['status'=>false]);
    }
}
