<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('admin.role.index');
        $breadcrumbs = Breadcrumbs::render('admin.role.index')->getData()['breadcrumbs'];

        $roles = Role::all();
        return view('Admin.Role.index', compact('roles','breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = Breadcrumbs::render('admin.role.create')->getData()['breadcrumbs'];

        Gate::authorize('admin.role.create');
        $permissions = Permission::all();
        return view('Admin.Role.create', compact('permissions','breadcrumbs'));
    }

    public function store(RoleRequest $request)
    {
        Gate::authorize('admin.role.create');
        $inputs = $request->all();
        try {
            $role = Role::create($inputs);
            $role->permissions()->sync($inputs['permission_id']);
            return redirect()->route('admin.role.index')->with(['success' => 'نقش جدید شما ایجاد شد و الگوی دسترسی برای ان تنظیم شدند']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.role.index')->withErrors(['error' => 'خطایی رخ داد لطفا چند لحظه دیگر دوباره تلاش کنید.']);
        }
    }

    public function edit(Role $role)
    {
        $breadcrumbs = Breadcrumbs::render('admin.role.edit',$role)->getData()['breadcrumbs'];

        Gate::authorize('admin.role.edit');
        $permissions = Permission::all();
        return view('Admin.Role.edit', compact('permissions', 'role','breadcrumbs'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        Gate::authorize('admin.role.edit');
        $inputs = $request->all();
        try {
            $role->update($inputs);
            $role->permissions()->sync($inputs['permission_id']);
            return redirect()->route('admin.role.index')->with(['success' => 'نقش جدید شما ویرایش شد و الگوی دسترسی برای ان تنظیم شدند']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.role.index')->withErrors(['error' => 'خطایی رخ داد لطفا چند لحظه دیگر دوباره تلاش کنید.']);
        }
    }


    public function destroy(Role $role)
    {
        Gate::authorize('admin.role.destroy');
        $role->delete();
        return redirect()->route('admin.role.index')->with(['success' => 'عملیات با موفقیت انجام شد و نقش مورد نظر پاک شد']);

    }
}
