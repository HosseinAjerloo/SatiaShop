@extends('Auth.Layout.master')


@section('content')

    <div class="flex items-center justify-center">
        <img src="{{asset('capsule/images/capsule.png')}}" alt="">
    </div>

    <section class="flex items-center justify-center">
        <form action="{{ route('post.forgotPassword') }}" class="space-y-3.5 " method="POST" id="form">
            @csrf

            <div class="flex items-center justify-between space-x-reverse space-x-2 w-full  ">
                <div class="flex items-center  border-2 px-2 h-12 rounded-md border-black">
                    <img src="{{asset('capsule/images/phone.svg')}}" alt="" class="w-6 h-6">
                    <input type="text"
                           class=" mobile w-full h-full inline-block outline-none px-2 placeholder:text-center placeholder:text-sm"
                           placeholder="شماره همراه  (*********09)" name="mobile" value="{{old('mobile')}}">
                </div>

            </div>


            <button type="submit"  class=" bg-2081F2 text-sm h-10 rounded-md text-white font-bold submit w-full">
              دریافت لینک تغییر کلمه عبور
            </button>

        </form>
    </section>
@endsection

