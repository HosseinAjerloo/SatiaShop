<?php

namespace App\Http\Controllers\Admin\ScanQrCode;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScanQrcode\ScanQrCodeRequest;
use App\Http\Traits\HasResideChargeCapsule;
use App\Models\ResideItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ScanQrCodeController extends Controller
{
    use HasResideChargeCapsule;
    public function index($resideItemHistory){
        $breadcrumbs = Breadcrumbs::render('admin.scanQrCode.index',$resideItemHistory->first()->unique_code)->getData()['breadcrumbs'];
        return view('Admin.ScanQrCode.index',compact('resideItemHistory','breadcrumbs'));
    }
    public function create ($resideItemHistory){
        $residItem=$resideItemHistory->first();
        return view('Admin.ScanQrCode.create',compact('residItem','resideItemHistory'));

    }
    public function store(ScanQrCodeRequest $request,$resideItemHistory){
        Gate::authorize('admin.chargingTheCapsule.index');
        app('request')->merge(['user'=>$resideItemHistory->first()->reside->user,'unique_code'=>$resideItemHistory->first()->unique_code]);
        return $this->registerResideCapsule();
    }
}
