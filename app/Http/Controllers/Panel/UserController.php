<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\RegisterRequest;
use App\Http\Requests\Panel\User\UpdateUserRequest;
use App\Http\Requests\Panel\UserRequest;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user=Auth::user();
        return view('Panel.myProfile',compact('user'));
    }
    public function update(UserRequest $request)
    {
        $user=Auth::user();
       $inputs=$request->all();
       $inputs['password']=password_hash($inputs['password'],PASSWORD_DEFAULT);
       $result=$user->update($inputs);
       return $result? redirect()->route('panel.my-profile.index')->with(['success-SweetAlert'=>'ویرایش انجام شد']):redirect()->route('panel.my-profile.index')->with(['error-SweetAlert'=>'خطایی رخ داد لطفا بعدا تلاش فرمایید']);
    }
}
