<?php

namespace App\Http\Controllers\Admin\InvoiceList;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleSearchRequest;
use App\Models\Reside;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class InvoiceListController extends Controller
{
        public function index(){
            $breadcrumbs = Breadcrumbs::render('admin.invoice-list.index')->getData()['breadcrumbs'];
            $resides = Reside::whereHas('resideItem', function ($query) {
                    $query->whereHas('productResidItem');
                })
                ->whereDoesntHave('resideItem', function ($query) {
                    $query->doesntHave('productResidItem');
                })->orWhere('reside_type', 'sell')->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('Admin.InvoiceList.index', compact('resides', 'breadcrumbs'));
        }
    public function search(ResidChargeCapsuleSearchRequest $request)
    {
        $resides = Reside::search()->orderBy('created_at', 'desc')->whereHas('resideItem', function ($query) {
            $query->whereHas('productResidItem');
        })->whereDoesntHave('resideItem', function ($query) {
                $query->doesntHave('productResidItem');
            })->orWhere('reside_type', 'sell')->get();
        foreach ($resides as $key => $reside) {
            $reside->jalalidate = \Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d');
            $reside->custumerName = ($reside->user->customer_type == 'natural_person' or empty($reside->user->customer_type)) ? $reside->user->fullName ?? '' : $reside->user->organizationORcompanyName ?? '';
            $reside->capsuleCount = $reside->reside_type == 'sell' ? $reside->resideItem->sum('amount') : $reside->resideItem->count();
            $reside->operatorName = $reside->operator->fullName ?? '';
            $reside->final_pricePersian = numberFormat($reside->final_price) ?? 0;
            $reside->update = '#';
            $reside->invoiceRoute = $reside->reside_type=='sell' ? route('admin.sale.show', $reside)  : route('admin.invoice.issuance.index', $reside);
            if ($reside->file) {
                $reside->download = route('admin.resideCapsule.download', $reside);
            } else {
                $reside->download = false;
            }
            $reside->type_change = $reside->reside_type == 'recharge' ? 'شارژ و تمدید کپسول' : 'فروش';
            if ($reside->reside_type == 'sell') {
                if ($reside->status == 'paid') {
                    $reside->img = asset('capsule/images/finalFactor.svg');
                    $reside->route = '#';
                    $reside->routePrint = route('admin.sale.printFactor', $reside);
                } else {
                    $reside->img = asset("capsule/images/hand-Invoice.png");
                    $reside->route = route('admin.sale.show', $reside->id);
                    $reside->routePrint = '#';
                    $reside->update = route('admin.sale.edit', $reside);


                }
            } else {
                if ($reside->status == 'paid') {
                    $reside->img = asset('capsule/images/finalFactor.svg');
                    $reside->route = '#';
                    $reside->routePrint = route('admin.invoice.issuance.printFactor', $reside);
                } else {
                    $reside->img = asset("capsule/images/hand-Invoice.png");
                    $reside->route = route('admin.invoice.issuance.index', $reside->id);
                    $reside->routePrint = route('admin.chargingTheCapsule.printReside', $reside);
                    $reside->update = route('admin.chargingTheCapsule.edit', $reside);

                }
            }
        }
        return response()->json(['success' => true, 'data' => $resides]);
    }

}
