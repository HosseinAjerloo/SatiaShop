<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admin.menu.index');
        $menus=Menu::Search()->orderBy('created_at','desc')->paginate(20,['*'],'page')->withQueryString();

        $breadcrumbs=Breadcrumbs::render('admin.menu.index')->getData()['breadcrumbs'];

        return view('Admin.Menu.index',compact('menus','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin.menu.create');

        $breadcrumbs=Breadcrumbs::render('admin.menu.create')->getData()['breadcrumbs'];

        return view('Admin.Menu.create',compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        Gate::authorize('admin.menu.create');

        $inputs = $request->all();
        $result = Menu::create($inputs);
        return $result ? redirect()->route('admin.menu.index')->with(['success'=>'منوی جدید باموفقیت اضافه شد']) : redirect()->route('admin.menu.index')->withErrors(['error' => 'خطایی رخ داد لطفا مجددا تلاش فرمایید']);
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
    public function edit(Menu $menu)
    {
        Gate::authorize('admin.menu.edit');
        $breadcrumbs=Breadcrumbs::render('admin.menu.edit',$menu)->getData()['breadcrumbs'];

        return view('Admin.Menu.edit', compact('menu','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        Gate::authorize('admin.menu.edit');
        $inputs = $request->all();
        $result = $menu->update($inputs);
        return $result ? redirect()->route('admin.menu.index')->with(['success'=>'منوی شما باموفقیت ویرایش شد']) : redirect()->route('admin.menu.index')->withErrors(['error' => 'خطایی رخ داد لطفا مجددا تلاش فرمایید']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        Gate::authorize('admin.menu.destroy');

        if ($menu->category()->count())
        {
            return redirect()->route('admin.menu.index')->withErrors(['error' => 'این منو دسته هایی مرتبط با خود دارد لطفا محل نمایش دسته های مربوط به این منو را در منو دیگر قرار دهید']);
        }
        $result = $menu->delete();
        return $result ? redirect()->route('admin.menu.index')->with(['success' => 'حذف منو با موفقیت انجام شد']) : redirect()->route('admin.category.index')->withErrors(['error' => 'حذف منو با خطا مواجه شد']);
    }

}
