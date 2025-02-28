@extends('Admin.Layout.master')

@section('content')

    <x-Search-date routeSearch="{{route('admin.category.index')}}" routeList="{{route('admin.category.create')}}"
        name='لیست دسته بندی ها' placeholder='نام دسته را وارد نمایید' imagePath='null'
    />
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




