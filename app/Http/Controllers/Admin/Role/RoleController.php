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
        dd(\request()->all());
        dd('hossein');
    }

    public function edit(Role $role)
    {

    }


    public function destroy(Role $role)
    {
        $role->delete();
    }
}
