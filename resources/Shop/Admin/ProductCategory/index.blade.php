@extends('Admin.Layout.master')

@section('content')

    <section class="flex w-full items-center justify-center flex-wrap ">
        <div class="w-1/4 md:w-[5%] flex  items-center justify-center border-black rounded-md p-1 submit_date cursor-pointer" data-date="1">
            <img src="{{asset("capsule/images/1Mount.svg")}}" alt="">
        </div>
        <div class="w-1/4 md:w-[5%] flex items-center justify-center submit_date cursor-pointer border-black rounded-md p-1" data-date="3">
            <img src="{{asset("capsule/images/3Mount.svg")}}" alt="">
        </div>
        <div class="w-1/4 md:w-[5%] flex items-center justify-center submit_date cursor-pointer border-black rounded-md p-1" data-date="6">
            <img src="{{asset("capsule/images/6Mount.svg")}}" alt="">
        </div>
        <div class="w-1/4 md:w-[5%] flex items-center justify-center border-black rounded-md p-1  date cursor-pointer">
            <img src="{{asset("capsule/images/date.svg")}}" alt="">
        </div>

           <div class="  flex flex-wrap items-center justify-between w-full lg:w-3/4   px-2 py-4 picker  md:space-y-0">
               <div class="w-full justify-center lg:justify-between flex-wrap md:w-[33%] flex items-center space-x-2 space-x-reverse space-y-2 ">
                   <span class="w-full lg:w-[20%] text-center">از تاریخ</span>
                   <input type="text"  class=" lg:w-[75%] py-1.5 border border-black/25 rounded-lg px-2 text-center startDate">
               </div>
               <div class="w-full justify-center flex-wrap md:w-[33%] flex items-center space-x-2 space-x-reverse space-y-2 ">
                    <span class="w-full lg:w-[20%] text-center">تا تاریخ</span>
                   <input type="text"  class=" lg:w-[75%] py-1.5 border border-black/25 rounded-lg px-2 text-center endDate">
               </div>
               <div class="w-full md:w-[33%] justify-center flex-wrap  flex items-center space-x-2 space-x-reverse space-y-2">
                   <span class="w-full lg:w-[20%] text-center">&nbsp;</span>
                   <button class="w-full lg:w-[75%] mt-4 md:mt-0 bg-green-400  py-1.5  rounded-lg  border border-gray-600 text-white affect-shadow">گزارش گیری</button>
               </div>
           </div>



    </section>
    <form id="form" class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5" action="{{route('admin.category.index')}}">
        <a href="{{route('admin.category.create')}}" class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/plus.svg")}}" alt="">
            <h1 class="text-min font-bold">لیست دسته بندی</h1>
        </a>
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="نام دسته را وارد نمائید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none" name="name" id="input_search">
            <img src="{{asset('capsule/images/search.svg')}}" alt="" class="search cursor-pointer">

        </div>
        <input type="hidden" name="date" id="input_date">
        <input class="customDate" type="hidden" name="customDate" id="customDate"/>

    </form>
    <section class="px-2 mt-5 ">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                   #
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                    نام دسته بندی
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                    محل نمایش در منو
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                  دسته والد
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                    ترتیب نمایش
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                    وضعیت
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-right">
                    تاریخ ایجاد
                </h1>
            </div>

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($categories as $key=> $category)
                <div class="p-2 h-full @if(($key+1)%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center  text-right">
                            {{$key+1}}
                        </p>
                    </div>
                    <a href="{{route('admin.category.edit',$category->id)}}" class="w-1/5">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center  text-right underline underline-offset-4 text-sky-500">
                            {{$category->removeUnderLine??''}}
                        </p>
                    </a>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center  text-right">
                           {{$category->menu->name??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center  text-right">
                            {{$category->parent->removeUnderLine??'دسته اصلی'}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center  text-right">
                            {{$category->view_sort??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center  text-right">
                            @if($category->status=='active')
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center text-right">
                            {{\Morilog\Jalali\Jalalian::forge($category->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>
                </div>


            @endforeach

        </article>
    </section>
    <x-paginate :items="$categories"/>
@endsection




