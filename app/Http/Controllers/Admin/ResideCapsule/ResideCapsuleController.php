<?php

namespace App\Http\Controllers\Admin\ResideCapsule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleSearchRequest;
use App\Models\Reside;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class ResideCapsuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = Breadcrumbs::render('admin.resideCapsule.index')->getData()['breadcrumbs'];
        $resides=Reside::all();
        return view('Admin.ListResideCapsule.index',compact('resides','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(ResidChargeCapsuleSearchRequest $request)
    {
        $resides = Reside::search()->get();
        foreach ($resides as $key => $reside){
                        $reside->jalalidate= \Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d');
                        $reside->custumerName= $reside->user->fullName ?? '';
                        $reside->capsuleCount= $reside->resideItem()->where('status','recharge')->count();
                        $reside->operatorName= $reside->operator->fullName ?? '';
                        $reside->route= route('admin.invoice.issuance.index',$reside);
        }
        return response()->json(['success'=>true,'data'=>$resides]);
    }
}
