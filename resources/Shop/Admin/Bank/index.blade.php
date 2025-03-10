@extends('Admin.Layout.master')

@section('content')

    <x-Search-date routeSearch="{{route('admin.category.index')}}" routeList="{{route('admin.category.create')}}"
        name='لیست دسته بندی ها' placeholder='نام دسته را وارد نمایید' imagePath='null'
    />
    <section class="px-2 mt-5 ">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                   #
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                    نام بانک
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right ">
                    url
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                  نام کاربری
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                   رمز عبور
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                    وضعیت
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                    ترمینال
                </h1>
            </div>
            <div class="w-[12%] max-w-[12%]">
                <h1 class="text-white text-min font-bold text-right">
                    تاریخ ایجاد
                </h1>
            </div>

        </article>

        <article class="border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($banks as $key=> $bank)
                <div class="p-2 h-full @if(($key%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  ">
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black  text-min font-bold text-right">
                            {{$key+1??''}}
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black  text-min font-bold text-right">
                           {{$bank->name??''}}
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black  text-min font-bold text-right">
                            {{$bank->url??''}}
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black text-min font-bold text-right">
                            {{$bank->username??''}}
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black text-min font-bold text-right">
                            {{$bank->password??''}}
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black text-min font-bold text-right">
                            @if($bank->is_active==1)
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black text-min font-bold text-right">
                            {{$bank->terminal_id??''}}
                        </p>
                    </div>
                    <div class="w-[12%] max-w-[12%] whitespace-normal break-words">
                        <p class="w-full text-black text-min font-bold text-right">
                            {{\Morilog\Jalali\Jalalian::forge($bank->created_at)->format('Y/m/d H:i:s')}}
                        </p>
                    </div>

                </div>


            @endforeach

        </article>
    </section>
    <x-paginate :items="$banks"/>
@endsection




