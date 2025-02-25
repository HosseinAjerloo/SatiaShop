@extends('Auth.Layout.master')


@section('content')

    <div class="flex items-center justify-center">
        <img src="{{asset('capsule/images/capsule.png')}}" alt="">
    </div>

    <section class="flex items-center justify-center">
        <form action="{{ route('post.update.Password',$otp->token) }}" class="space-y-3.5 " method="POST" id="form">
            @csrf

           
            <div class="flex items-center space-x-reverse space-x-2 w-full border-black border-2 px-2 h-12 rounded-md">
                <img src="{{asset('capsule/images/key-black.svg')}}" alt="" class="w-6 h-6">
                <input type="password"
                       class="w-full h-full py-1.5 outline-none px-2  placeholder:text-center  placeholder:text-sm"
                       placeholder="کلمه عبور جدید (حروف و عدد)" name="password">
            </div>
            <div class="flex items-center space-x-reverse space-x-2 w-full border-black border-2 px-2 h-12 rounded-md">
                <img src="{{asset('capsule/images/key-black.svg')}}" alt="" class="w-6 h-6">
                <input type="password"
                       class="w-full h-full py-1.5 outline-none px-2  placeholder:text-center  placeholder:text-sm"
                       placeholder="تکرار کلمه عبور جدید (حروف و عدد)" name="password_confirmation">
            </div>
           
            <button class=" bg-2081F2 text-sm w-full h-10 rounded-md text-white font-bold submit">
                ویرایش کلمه عبور
            </button>

        </form>
    </section>
@endsection

