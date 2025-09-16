<?php

namespace App\Http\Controllers\Admin\ChargingOperation;

use App\Http\Controllers\Controller;
use App\Models\Reside;
use App\Models\ResideItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class ChargingOperationController extends Controller
{
    public function index()
    {
        Gate::authorize('admin.charging-operation.index');
        $breadcrumbs = Breadcrumbs::render('admin.charging-operation.index')->getData()['breadcrumbs'];
        $resideItems = ResideItem::whereHas('reside', function (Builder $query) {
            $query->where('type', 'reside')->orderBy('user_id', 'desc');
        })->where(function ($query) {
            $query->where('status', 'recharge')->orWhere('status', 'used');
        })->doesntHave('productResidItem')->orderBy('reside_id', 'desc')->paginate(20);

        return view('Admin.ChargingOperation.index', compact('resideItems', 'breadcrumbs'));
    }

    public function searchAjax(Request $request)
    {
        $resideItems = ResideItem::Search()->whereHas('reside', function (Builder $query) {
            $query->where('type', 'reside')->orderBy('user_id', 'desc');
        })->where(function ($query) {
            $query->where('status', 'recharge')->orWhere('status', 'used');
        })->doesntHave('productResidItem')->orderBy('reside_id', 'desc')->cursorPaginate(20);
        if ($resideItems->count()) {
            foreach ($resideItems->items() as $resideItem) {
                $resideItem->fullName = $resideItem->reside->user->fullName;
                $resideItem->image = asset('capsule/images/activecharging.svg');
                $resideItem->link = route('admin.invoice.issuance.operation', [$resideItem->reside, $resideItem]);
            }
            return response()->json(['status' => true, 'data' => $resideItems->items(), 'nexPageUrl' => $resideItems->nextPageUrl(), 'hasMorePages' => $resideItems->hasMorePages()]);
        } else
            return response()->json(['status' => false]);
    }
}
