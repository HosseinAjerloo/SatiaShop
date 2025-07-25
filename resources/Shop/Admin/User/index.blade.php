@extends('Admin.Layout.master')

@section('content')

    <x-Search-date routeSearch="{{route('admin.user.index')}}" routeList="{{route('admin.user.create')}}"
                   name="لیست کاربران"  placeholder='شماره موبایل کاربر را وارد نمائید ...' imagePath='{{asset("capsule/images/plus.svg")}}'/>

    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2  py-3 hidden sm:flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-[7%] max-w-[7%]">
                <h1 class="text-white text-min font-bold text-right">
                    #
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    نام
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    نام خانوادگی
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    شماره موبایل
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    شماره ثابت
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    کدملی
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    ایمیل
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    آدرس
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    تاریخ ثبت نام
                </h1>
            </div>


        </article>

        <article class=" border-0 sm:border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($users as $key=> $user)
                <div class="p-2 shadow-md shadow-gray-400 border-2 border-black/20 sm:border-none rounded-md sm:rounded-none sm:shadow-none h-full space-y-3 sm:space-y-0 flex-wrap sm:flex-row @if($key%2==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class=" border-b border-black/35 sm:border-none py-1.5  w-full justify-between  sm:w-[7%] sm:max-w-[7%]    h-full flex items-center  text-right whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm font-bold ">
                            #
                        </p>
                        <p class="sm:text-min_sm sm:font-bold">
                            {{$key+1}}
                        </p>
                    </div>
                    <div  class="border-b border-black/35 sm:border-none w-full justify-between flex  sm:w-[11%] sm:max-w-[11%]">
                        <p class="sm:hidden text-min_sm font-bold">
                            نام
                        </p>
                        <p class="text-sky-500  text-min_sm sm:font-bold  h-full flex items-center text-right leading-8 underline underline-offset-4   whitespace-normal break-words ">
                            <a href="{{route('admin.user.edit',$user)}}">
                                {{$user->name??''}}
                            </a>
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between   sm:w-[11%] sm:max-w-[11%] text-min_sm   h-full flex items-center text-right whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm font-bold">نام خانوادگی</p>
                        {{$user->family??''}}

                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">شماره موبایل</p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right ">
                            {{$user->mobile??''}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">
                            شماره ثابت
                        </p>
                        <p class="text-black  text-sm sm:font-bold  h-full flex items-center text-right">
                            {{$user->tel??''}}
                        </p>
                    </div>

                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">
                            کدملی
                        </p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-words">
                            {{$user->national_code??''}}
                        </p>

                    </div>

                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm font-bold">
                            ایمیل
                        </p>
                        <p class="text-black  text-sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-all">
                            {{$user->email??''}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full  justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">آدرس</p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-words">
                            {{$user->address??''}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">تاریخ ثبت نام</p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-words">
                            {{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>



                </div>

            @endforeach

        </article>
    </section>

    <x-paginate :items="$users"/>

@endsection

