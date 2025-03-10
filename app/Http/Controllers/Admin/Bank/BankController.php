<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function  index()
    {
        $banks=Bank::orderBy('created_at','desc')->paginate(20,['*'],'page')->withQueryString();
        return view('Admin.Bank.index',compact('banks'));
    }
}
