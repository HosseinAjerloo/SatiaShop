<?php

namespace App\Http\Controllers\Admin\ChargingOperation;

use App\Http\Controllers\Controller;
use App\Models\Reside;
use App\Models\ResideItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ChargingOperationController extends Controller
{
    public function index()
    {
        //todo اضافه کردن سطوح دسترسی
        $breadcrumbs = Breadcrumbs::render('admin.charging-operation.index')->getData()['breadcrumbs'];
        $resideItems = ResideItem::whereHas('reside', function (Builder $query) {
            $query->where('type', 'reside');
        })->doesntHave('productResidItem')->paginate(10);

        return view('Admin.ChargingOperation.index', compact('resideItems', 'breadcrumbs'));
    }
}
