<?php

namespace App\Http\Controllers\Admin\ScanQrCode;

use App\Http\Controllers\Controller;
use App\Models\ResideItem;
use Illuminate\Http\Request;

class ScanQrCodeController extends Controller
{
    public function index(ResideItem $resideItem){

        return view('Admin.ScanQrCode.index',compact('resideItem'));
    }
}
