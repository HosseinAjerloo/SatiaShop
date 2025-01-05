<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuRequest;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('MenuSeeder.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('MenuSeeder.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $result = Menu::create($inputs);
        return $result ? redirect()->route('admin.menu.index')->with('success', 'منوی جدید باموفقیت اضافه شد') : dd('no');
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
        return view('MenuSeeder.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $result = $menu->update($inputs);
        return $result ? redirect()->route('admin.menu.index')->with('success', 'منوی شماویرایش شد') : dd('no');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
