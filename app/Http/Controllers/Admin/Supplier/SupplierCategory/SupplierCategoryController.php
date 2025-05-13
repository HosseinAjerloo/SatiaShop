<?php

namespace App\Http\Controllers\Admin\Supplier\SupplierCategory;

use App\Http\Controllers\Controller;
use App\Models\SupplierCategory;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SupplierCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.supplier.category.index');
        $categories = SupplierCategory::orderBy('created_at', 'desc')->paginate(20);
        $breadcrumbs = Breadcrumbs::render('admin.supplier.category.index')->getData()['breadcrumbs'];

        return view('Admin.supplier.suppliercategory.index' ,compact('breadcrumbs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.supplier.category.create');
        $breadcrumbs = Breadcrumbs::render('admin.supplier.category.create')->getData()['breadcrumbs'];
        return view('Admin.supplier.suppliercategory.create' ,compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin.supplier.category.create');

        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $category = SupplierCategory::create($validated);

        return $category
            ? redirect()->route('admin.supplier.category.index')->with('success', 'دسته‌بندی با موفقیت ایجاد شد')
            : redirect()->route('admin.supplier.category.index')->withErrors(['error' => 'خطا در ایجاد دسته‌بندی']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierCategory $category)
    {
        Gate::authorize('admin.supplier.category.edit');
        $breadcrumbs = Breadcrumbs::render('admin.supplier.category.edit', $category)->getData()['breadcrumbs'];
        return view('Admin.supplier.suppliercategory.edit' ,compact('breadcrumbs', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierCategory $category)
    {
        Gate::authorize('admin.supplier.category.edit');

        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $result = $category->update($validated);

        return $result
            ? redirect()->route('admin.supplier.category.index')->with('success', 'دسته‌بندی با موفقیت بروزرسانی شد')
            : redirect()->route('admin.supplier.category.index')->withErrors(['error' => 'خطا در بروزرسانی دسته‌بندی']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierCategory $category)
    {
        $result = $category->delete();

        return $result
            ? redirect()->route('admin.supplier.category.index')->with('success', 'دسته‌بندی با موفقیت حذف شد')
            : redirect()->route('admin.supplier.category.index')->withErrors(['error' => 'خطا در حذف دسته‌بندی']);
    }
}
