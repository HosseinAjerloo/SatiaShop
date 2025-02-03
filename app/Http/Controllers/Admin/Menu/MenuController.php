<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuRequest;
use App\Models\Menu;
use Diglactic\Breadcrumbs\Breadcrumbs;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus=Menu::Search()->orderBy('view_sort','asc')->get();
        $breadcrumbs=Breadcrumbs::render('admin.menu.index')->getData()['breadcrumbs'];

        return view('Admin.Menu.index',compact('menus','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs=Breadcrumbs::render('admin.menu.create')->getData()['breadcrumbs'];

        return view('Admin.Menu.create',compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
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
        $breadcrumbs=Breadcrumbs::render('admin.menu.edit',$menu)->getData()['breadcrumbs'];

        return view('Admin.Menu.edit', compact('menu','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $result = $menu->update($inputs);
        return $result ? redirect()->route('admin.menu.index')->with(['success'=>'منوی شما باموفقیت ویرایش شد']) : redirect()->route('admin.menu.index')->withErrors(['error' => 'خطایی رخ داد لطفا مجددا تلاش فرمایید']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
