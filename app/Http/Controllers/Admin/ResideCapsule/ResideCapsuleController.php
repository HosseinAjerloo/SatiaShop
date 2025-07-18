<?php

namespace App\Http\Controllers\Admin\ResideCapsule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleSearchRequest;
use App\Models\Reside;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
//        dd($resides);
        foreach ($resides as $key => $reside) {
            $reside->jalalidate = \Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d');
            $reside->custumerName =($reside->user->customer_type=='natural_person' or empty($reside->user->customer_type))?$reside->user->fullName??'' : $reside->user->organizationORcompanyName??'';
            $reside->capsuleCount = $reside->reside_type=='sell'?$reside->resideItem->sum('amount'):$reside->resideItem->count();
            $reside->operatorName = $reside->operator->fullName ?? '';
            $reside->update='#';
            if ($reside->file){
                $reside->download=route('admin.resideCapsule.download',$reside);
            }
            else{
                $reside->download=false;
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
                    $reside->update=route('admin.sale.edit',$reside);


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
                    $reside->update=route('admin.chargingTheCapsule.edit',$reside);

                }
            }
        }
        return response()->json(['success' => true, 'data' => $resides]);
    }
    public function download(Reside $reside)
    {
        if (!empty($reside->file))
        {
            $path=str_replace('/',DIRECTORY_SEPARATOR,$reside->file->path);
            $path=str_replace('\\',DIRECTORY_SEPARATOR,$path);
                if (File::exists(public_path($path)))
                {
                    return response()->download(public_path($path));
                }
        }
        return redirect()->back()->withErrors('error','خطایی رخ داد فایلی برای دانلود پیدا نشدا لطفا چند دقیقه دیگر تلاش فرمایید.');

    }
}
