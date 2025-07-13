<?php

namespace App\Http\Controllers\Admin\ScanQrCode;

use App\Http\Controllers\Controller;
use App\Models\ResideItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ScanQrCodeController extends Controller
{
    public function index($resideItemHistory){
        $breadcrumbs = Breadcrumbs::render('admin.scanQrCode.index',$resideItemHistory->first()->unique_code)->getData()['breadcrumbs'];
        return view('Admin.ScanQrCode.index',compact('resideItemHistory','breadcrumbs'));
    }
    public function create ($resideItemHistory){
        $residItem=$resideItemHistory->first();
        return view('Admin.ScanQrCode.create',compact('residItem','resideItemHistory'));

    }
}
