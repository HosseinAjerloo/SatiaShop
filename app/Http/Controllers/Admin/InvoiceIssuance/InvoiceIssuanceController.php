<?php

namespace App\Http\Controllers\Admin\InvoiceIssuance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceIssuance\InvoiceIssuanceRequest;
use App\Models\Category;
use App\Models\Reside;
use App\Models\ResideItem;
use Illuminate\Http\Request;

class InvoiceIssuanceController extends Controller
{
    public function index(Reside $reside)
    {
        return view('Admin.InvoiceIssuance.index',compact('reside'));
    }
    public function operation(Reside $reside,ResideItem $resideItem)
    {
        $categories=Category::class;
        return view('Admin.SelectCapsule.index',compact('reside','resideItem','categories'));
    }
    public function store(Reside $reside,ResideItem $resideItem,InvoiceIssuanceRequest $request)
    {
        try {

            $inputs=$request->all();
            $allData=[];
            foreach ($inputs['product_id'] as $product)
            {
                $allData[$product]=[
                    'balloons'=>$inputs['balloons'],
                    'salary'=>$inputs['salary'],
                ];
            }
            $resideItem->productResidItem()->attach($allData);
        }
        catch (\Exception $exception){
            dd($exception->getMessage());
        }
        dd($request->all(),'controller');
    }
}
