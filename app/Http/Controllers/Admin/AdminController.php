<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateUserProfile;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs=Breadcrumbs::render('panel.admin')->getData()['breadcrumbs'];
        return view('Admin.index',compact('breadcrumbs'));
    }

    public function updateUser(UpdateUserProfile $request)
    {
        $user=Auth::user();
            $inputs=$request->safe()->all();
            if (password_verify($inputs['oldPass'],$user->password))
            {
                $result=$user->update($inputs);
                return $result? redirect()->back()->with(['success'=>'اطلاعات کاربری شما با موفقیت بروز رسانی شد']):redirect()->back()->withErrors(['error'=>'خطایی رخ دادا لطفا چند دقیه دیگر تلاش فرمایید.']);
            }
            else{
                return redirect()->back()->withErrors(['error'=>'خطایی رخ دادا لطفا چند دقیه دیگر تلاش فرمایید.']);
            }
    }
    public function loginAnotherUser(Request $request,User $user)
    {
        $currentUser=Auth::user();
        if ($currentUser->type=='admin')
            session(['previous_user'=>$currentUser->id]);

        Auth::loginUsingId($user->id);
        return redirect()->route('panel.index');
    }
}
