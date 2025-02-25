@extends('Auth.Layout.master')


@section('content')

    <div class="flex items-center justify-center">
        <img src="{{asset('capsule/images/capsule.png')}}" alt="">
    </div>

    <section class="flex items-center justify-center">
        <form action="{{route('login.simple-post')}}" class="space-y-3.5 flex items-center justify-center flex-col" method="POST" >
            @csrf

            <div class="p-1.5 border border-black/75 rounded-md h-10  w-3/4">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <img src="{{asset('capsule/images/phone.svg')}}" alt="" >
                    <input type="text" placeholder="نام کاربری"
                           class="px-1.5 placeholder:text-min h-full outline-none bg-transparent focus:text-black focus:bg-white" name="mobile">
                </div>
            </div>
            <div class="p-1.5 border border-black/75 rounded-md h-10   w-3/4 ">
                <div class=" flex items-center justify-between h-full  ">
                    <img src="{{asset("capsule/images/key-black.svg")}}" alt="">
                    <input type="password" placeholder="کلمه عبور"
                           class="px-1.5 placeholder:text-min h-full outline-none focus:text-black focus:bg-white" name="password">
                    <img src="{{asset("capsule/images/eye.svg")}}" alt="" class="cursor-pointer eye password-img w-[25px]">

                </div>
            </div>
            <div class="p-1.5  rounded-md h-10">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <label for="" class="text-min">مرا به خاطر بسپار</label>
                    <input type="checkbox"
                           class="px-1.5 placeholder:text-min h-full outline-none " name="rememberMe">
                </div>
            </div>

            <div class="p-1.5 flex items-center space-x-4 space-x-reverse  rounded-md h-10">
                <div class=" flex items-center  space-x-1 space-x-reverse h-full">
                    <button class="bg-2081F2 px-16 py-1.5 rounded-md text-white text-center">ورود</button>
                </div>

                <a  href="{{route('login.ssoLink')}}" class="flex items-center  h-full">
                    <div class="bg-rose-500 px-16 py-1.5 rounded-md text-white text-center flex items-center justify-center space-x-3 space-x-reverse">
                        <span class="block text-sm">ورود با پنجره ساتیا</span>
                    </div>
                </a>
            </div>

            <div class="p-1.5  rounded-md h-10 space-x-reverse space-x-3">


                <a href="{{route('register')}}" class="text-min text-blue-800 font-bold  underline underline-offset-4">
                    ثبت نام </a>
                <a href="{{ route('forgotPassword') }}" class="text-min text-blue-800 font-bold  underline underline-offset-4">کلمه عبور را فراموش
                    کرده اید</a>


            </div>

        </form>
    </section>
@endsection
@section('script-tag')

    <script>
        $(document).ready(function () {
            $(".eye").click(function () {
                let inputPassword = $(this).siblings()[1];
                if ($(inputPassword).attr('type') === 'text') {
                    $(inputPassword).attr('type', 'password')
                    let eyeUnderLien="{{asset("capsule/images/eye.svg")}}";
                    $(".password-img").attr('src',eyeUnderLien);
                } else {
                    $(inputPassword).attr('type', 'text');
                    let eyePath="{{asset('capsule/images/eye2_1740308666.svg')}}";
                    $(".password-img").attr('src',eyePath);

                }
            })
        })
    </script>
@endsection
