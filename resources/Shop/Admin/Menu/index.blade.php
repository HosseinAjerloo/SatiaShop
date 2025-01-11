@extends('Admin.Layout.master')

@section('content')

    <section class="flex items-center justify-center space-x-reverse space-x-3">
        <div class="border border-black rounded-md p-1">
            <img src="{{asset("capsule/images/1Mount.svg")}}" alt="">
        </div>
        <div>
            <img src="{{asset("capsule/images/3Mount.svg")}}" alt="">
        </div>
        <div>
            <img src="{{asset("capsule/images/6Mount.svg")}}" alt="">
        </div>
        <div>
            <img src="{{asset("capsule/images/date.svg")}}" alt="">
        </div>

    </section>
    <form class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5">
        <a href="{{route('admin.menu.create')}}" class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/plus.svg")}}" alt="">
            <h1 class="text-min font-bold">لیست منوها</h1>
        </a>
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="نام منو را وارد کنید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none">
            <img src="{{asset('capsule/images/search.svg')}}" alt="">

        </div>
    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام منو
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

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($menus as $menu)
                <div class="p-2 h-full @if(($menu->id%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <a href="{{route('admin.menu.edit',$menu->id)}}" class="w-1/5">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center underline underline-offset-4 text-sky-500">
                            {{$menu->name??''}}
                        </p>
                    </a>



                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$menu->view_sort??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            @if($menu->status=='active')
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>
                </div>


            @endforeach

        </article>
    </section>

@endsection
