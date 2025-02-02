<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supplier\SupplierRequest;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $breadcrumbs = Breadcrumbs::render('admin.supplier.index')->getData()['breadcrumbs'];

        return view('Admin.Supplier.index', compact('suppliers','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = Breadcrumbs::render('admin.supplier.create')->getData()['breadcrumbs'];
        $supplierCategory = SupplierCategory::where("status", 'active')->get();
        return view('Admin.supplier.create', compact('supplierCategory','breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $inputs = $request->all();
        $result = Supplier::create($inputs);
        return $result ? redirect()->route('admin.supplier.index')->with(['success' => 'تامین کننده شما ایجاد شد']) : redirect()->route('admin.supplier.index')->withErrors(['error' => 'خطایی رخ داد لطفا بعدا تلاش فرمایید']);
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
    public function edit(Supplier $supplier)
    {
        $supplierCategory = SupplierCategory::where("status", 'active')->get();
        $breadcrumbs = Breadcrumbs::render('admin.supplier.edit',$supplier)->getData()['breadcrumbs'];
        return view('Admin.Supplier.edit', compact('supplier', 'supplierCategory','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $inputs = $request->all();
        $result = $supplier->update($inputs);
        return $result ? redirect()->route('admin.supplier.index')->with(['success' => 'تامین کننده شما ویرایش شد']) : redirect()->route('admin.supplier.index')->withErrors(['error' => 'خطایی رخ داد لطفا بعدا تلاش فرمایید']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
