@extends('Admin.Layout.master')

@section('content')

    <section class="flex items-center justify-center space-x-reverse space-x-3">
        <div class=" border-black rounded-md p-1 submit_date cursor-pointer" data-date="1">
            <img src="{{asset("capsule/images/1Mount.svg")}}" alt="">
        </div>
        <div class="submit_date cursor-pointer border-black rounded-md p-1" data-date="3">
            <img src="{{asset("capsule/images/3Mount.svg")}}" alt="">
        </div>
        <div class="submit_date cursor-pointer border-black rounded-md p-1" data-date="6">
            <img src="{{asset("capsule/images/6Mount.svg")}}" alt="">
        </div>
        <div class="border-black rounded-md p-1 observer-example cursor-pointer">
            <img src="{{asset("capsule/images/date.svg")}}" alt="">
        </div>

    </section>
    <form id="form" class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5"
          action="{{route('admin.user.index')}}">
        <div  class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/user.png")}}" alt="">
            <h1 class="text-min font-bold">لیست کاربران</h1>
        </div>
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="موبایل کاربر را وارد نمائید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none" name="name" id="input_search">
            <img src="{{asset('capsule/images/search.svg')}}" alt="" class="search cursor-pointer">

        </div>
        <input type="hidden" name="date" id="input_date">
        <input class="customDate" type="hidden" name="customDate" id="customDate"/>

    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    #
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   نام
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام خانوادگی
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    شماره موبایل
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    شماره ثابت
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    کدملی
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    ایمیل
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تاریخ ثبت نام
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    آدرس
                </h1>
            </div>


        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($users as $key=> $user)
                <div class="p-2 h-full @if((($key+1)%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$key+1}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->name??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->family??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->mobile??''}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->tel??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->national_code??''}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->email??''}}

                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            {{$user->address??''}}

                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            {{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>

                </div>


            @endforeach

        </article>
    </section>
    <x-paginate :items="$users"/>

@endsection

