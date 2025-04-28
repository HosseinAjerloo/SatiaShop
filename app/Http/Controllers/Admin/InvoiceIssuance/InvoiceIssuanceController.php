<?php

namespace App\Http\Controllers\Admin\InvoiceIssuance;

use App\Http\Controllers\Controller;
use App\Models\Reside;
use Illuminate\Http\Request;

class InvoiceIssuanceController extends Controller
{
    public function index(Reside $reside)
    {
        return view('Admin.InvoiceIssuance.index',compact('reside'));
    }
}
