<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\SearchRequest;
use App\Http\Requests\Admin\User\UpdateUserProfile;
use App\Models\Role;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('admin.user.index');
        $users=User::Search()->orderBy('created_at','desc')->paginate(20,['*'],'userPage')->withQueryString();
        $breadcrumbs=Breadcrumbs::render('admin.user.index')->getData()['breadcrumbs'];

        return view('Admin.User.index',compact('users','breadcrumbs'));
    }
    public function inactive(User $user)
    {
        $result=$user->update(['is_active'=>$user->is_active==1?0:1]);
        return $result?redirect()->route('panel.admin.user.index')->with('success','اطلاعات کاربر بروز رسانی شد'):route('panel.admin.user.index')->with('error','اطلاعات کاربر بروز رسانی نشد لطفا چند دقیه دیگه دوباره تلاش کنید.');
    }
    public function search(SearchRequest $request)
    {
        $inputs=$request->all();
        $users=User::Search($inputs)->get();
        return view('Admin.User.search',compact('users'));
    }

    public function edit(User $user)
    {
        $roles=Role::all();
        return view('Admin.User.edit',compact('user'),compact('roles'));
    }

    public function update(User $user,UpdateUserProfile $request)
    {
        dd('hossien ajerloo',$user);
    }
}
