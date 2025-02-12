@extends('Auth.Layout.master')


@section('content')

    <div class="flex items-center justify-center">
        <img src="{{asset('capsule/images/capsule.png')}}" alt="">
    </div>

    <section class="flex items-center justify-center">
        <form action="{{route('login.simple-post')}}" class="space-y-3.5 " method="POST">
            @csrf

            <div class="p-1.5 border border-black/75 rounded-md h-10">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <img src="{{asset('capsule/images/phone.svg')}}" alt="">
                    <input type="text" placeholder="نام کاربری"
                           class="px-1.5 placeholder:text-min h-full outline-none bg-transparent"  name="mobile">
                </div>
            </div>
            <div class="p-1.5 border border-black/75 rounded-md h-10">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <img src="{{asset("capsule/images/key-black.svg")}}" alt="">
                    <input type="text" placeholder="کلمه عبور"
                           class="px-1.5 placeholder:text-min h-full outline-none bg-transparent" name="password">
                    <img src="{{asset("capsule/images/eye.svg")}}" alt="">

                </div>
            </div>
            <div class="p-1.5  rounded-md h-10">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <label for="" class="text-min">مرا به خاطر بسپار</label>
                    <input type="checkbox"
                           class="px-1.5 placeholder:text-min h-full outline-none bg-transparent"  name="rememberMe">
                </div>
            </div>

            <div class="p-1.5  rounded-md h-10">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <button class="bg-2081F2 px-16 py-1.5 rounded-md text-white text-center">ورود</button>
                </div>
            </div>

            <div class="p-1.5  rounded-md h-10 space-x-reverse space-x-3">


                <a href="{{route('register')}}" class="text-min text-blue-800 font-bold  underline underline-offset-4">
                    ثبت نام </a>
                <a href="" class="text-min text-blue-800 font-bold  underline underline-offset-4">کلمه عبور را فراموش
                    کرده اید</a>


            </div>

        </form>
    </section>
@endsection
