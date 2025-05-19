<?php

namespace App\Http\Controllers\Admin\ResideCapsule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleSearchRequest;
use App\Models\Reside;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResideCapsuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('admin.resideCapsule.index');
        $breadcrumbs = Breadcrumbs::render('admin.resideCapsule.index')->getData()['breadcrumbs'];
        $resides = Reside::orderBy('created_at', 'desc')->get();
        return view('Admin.ListResideCapsule.index', compact('resides', 'breadcrumbs'));
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
        $resides = Reside::search()->orderBy('created_at', 'desc')->get();
        foreach ($resides as $key => $reside) {
            $reside->jalalidate = \Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d');
            $reside->custumerName = $reside->user->fullName ?? '';
            $reside->capsuleCount = $reside->resideItem()->count();
            $reside->operatorName = $reside->operator->fullName ?? '';
            if ($reside->reside_type == 'sell') {
                if ($reside->status == 'paid') {
                    $reside->img = asset('capsule/images/finalFactor.svg');
                    $reside->route = '#';
                    $reside->routePrint = route('admin.sale.printFactor', $reside);
                } else {
                    $reside->img = asset("capsule/images/hand-Invoice.png");
                    $reside->route = route('admin.sale.show', $reside->id);
                    $reside->routePrint = '#';

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
                }
            }
        }
        return response()->json(['success' => true, 'data' => $resides]);
    }
}
