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
        <div class="border-black rounded-md p-1 submit_date cursor-pointer">
            <img src="{{asset("capsule/images/date.svg")}}" alt="">
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
    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   #
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام دسته بندی
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    محل نمایش در منو
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                  دسته والد
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    ترتیب نمایش
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    وضعیت
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تاریخ ایجاد
                </h1>
            </div>

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($categories as $key=> $category)
                <div class="p-2 h-full @if(($key+1)%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$key+1}}
                        </p>
                    </div>
                    <a href="{{route('admin.category.edit',$category->id)}}" class="w-1/5">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center underline underline-offset-4 text-sky-500">
                            {{$category->removeUnderLine??''}}
                        </p>
                    </a>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                           {{$category->menu->name??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$category->parent->name??'دسته اصلی'}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$category->view_sort??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            @if($category->status=='active')
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{\Morilog\Jalali\Jalalian::forge($category->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>
                </div>


            @endforeach

        </article>
    </section>

@endsection


@push('search')
    <script>
        $(document).ready(function(){
            $(".submit_date").click(function (){
                $(".submit_date").removeClass('border')
                $(this).addClass('border')
                $('#input_date').val($(this).data('date'))
                permissionRequest();
                $('#form').submit()

            });

            $(".search").click(function (){
                permissionRequest();
                $('#form').submit();
            })

            function permissionRequest()
            {
                if ($('#input_search').val()==='')
                    $("#input_search").removeAttr('name')

                if ($('#input_date').val()==='')
                    $("#input_date").removeAttr('name')
            }
        })

    </script>
@endpush

