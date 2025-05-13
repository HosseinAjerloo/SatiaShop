@extends('Admin.Layout.master')

@section('content')



    <x-Search-date routeSearch="{{route('admin.menu.index')}}" routeList="{{route('admin.menu.create')}}"
    name="لیست منو ها"  placeholder='نام منو را وارد نمایید' imagePath='null'/>




    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2   py-3 hidden sm:flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-[7%] max-w-[7%]">
                <h1 class="text-white text-min font-bold text-right">
                    #
                </h1>
            </div>
            <div class="w-[20%] max-w-[20%]">
                <h1 class="text-white text-min font-bold text-right">
                    نام منو
                </h1>
            </div>
            <div class="w-[20%] max-w-[20%]">
                <h1 class="text-white text-min font-bold text-right">
                    ترتیب نمایش
                </h1>
            </div>
            <div class="w-[20%] max-w-[20%]">
                <h1 class="text-white text-min font-bold text-right">
                    وضعیت
                </h1>
            </div>

            <div class="w-[20%] max-w-[20%]">
                <h1 class="text-white text-min font-bold text-right">
                    تاریخ ایجاد
                </h1>
            </div>

        </article>

        <article class=" border-0 sm:border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($menus as $key=> $menu)
                <div class="p-2 shadow-md shadow-gray-400 border-2 border-black/20 sm:border-none rounded-md sm:rounded-none sm:shadow-none  space-y-3 sm:space-y-0 flex-wrap sm:flex-row @if($key%2==0)) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class=" border-b border-black/35 sm:border-none py-1.5  w-full justify-between  sm:w-[7%] sm:max-w-[7%]     flex items-center  text-right whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm  ">
                            #
                        </p>
                        <p class="sm:text-min_sm ">
                            {{$key+1}}
                        </p>
                    </div>
                    <a href="{{route('admin.menu.edit',$menu->id)}}" class="border-b border-black/35 sm:border-none w-full justify-between flex  sm:w-[20%] sm:max-w-[20%]">
                        <p class="sm:hidden text-min_sm ">
                            عنوان
                        </p>
                        <p class="text-sky-500  text-min_sm   h-full flex items-center text-right leading-8 underline underline-offset-4   whitespace-normal break-words ">
                            {{$menu->name??''}}
                        </p>
                    </a>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between   sm:w-[20%] sm:max-w-[20%] text-min_sm   h-full flex items-center text-right whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm ">توضیحات</p>
                        <p class="text-black  text-min_sm   h-full flex items-center text-right ">
                            &nbsp;{{$menu->view_sort??''}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[20%] sm:max-w-[20%] whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm ">نوع محصول</p>
                        <p class="text-black  text-min_sm   h-full flex items-center text-right ">
                            &nbsp;  @if($menu->status=='active')
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>



                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[20%] sm:max-w-[20%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm ">
                            تاریخ ایجاد
                        </p>
                        <p class="text-black  text-min_sm  h-full flex items-center text-right whitespace-normal break-words">
                            {{\Morilog\Jalali\Jalalian::forge($menu->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>



                </div>

            @endforeach

        </article>
    </section>

    <x-paginate :items="$menus"/>


@endsection

