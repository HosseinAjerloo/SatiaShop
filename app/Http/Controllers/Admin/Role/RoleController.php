<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('Admin.Role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('Admin.Role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $inputs=$request->all();
        try {
            $role=Role::create($inputs);
            $role->permissions()->sync($inputs['permission_id']);
            return redirect()->route('admin.role.index')->with(['success'=>'نقش جدید شما ایجاد شد و الگوی دسترسی برای ان تنظیم شدند']);
        }catch (\Exception $exception){
            return redirect()->route('admin.role.index')->withErrors(['error'=>'خطایی رخ داد لطفا چند لحظه دیگر دوباره تلاش کنید.']);
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('Admin.Role.edit', compact('permissions','role'));
    }
    public function update(RoleRequest $request,Role $role)
    {
        $inputs=$request->all();
        try {
            $role->update($inputs);
            $role->permissions()->sync($inputs['permission_id']);
            return redirect()->route('admin.role.index')->with(['success'=>'نقش جدید شما ویرایش شد و الگوی دسترسی برای ان تنظیم شدند']);
        }catch (\Exception $exception){
            return redirect()->route('admin.role.index')->withErrors(['error'=>'خطایی رخ داد لطفا چند لحظه دیگر دوباره تلاش کنید.']);
        }
    }


    public function destroy(Role $role)
    {
        $role->delete();
    }
}
