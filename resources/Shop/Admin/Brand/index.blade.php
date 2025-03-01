@extends('Admin.Layout.master')

@section('content')

    <x-Search-date routeSearch="{{route('admin.brand.index')}}" routeList="{{route('admin.brand.create')}}"
                   name="لیست برند های موجود"  placeholder='نام برند را وارد نمائید ...' imagePath='null'/>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام برند
                </h1>
            </div>

            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    وضعیت
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تاریخ
                </h1>
            </div>

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($brands as $key=> $brand)
                <div
                    class="p-2 h-full @if(($key%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <a href="{{route('admin.brand.edit',$brand->id)}}" class="w-1/5">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center underline underline-offset-4 text-sky-500">
                            {{$brand->name??''}}
                        </p>
                    </a>


                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            @if($brand->status=='active')
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">

                                {{\Morilog\Jalali\Jalalian::forge($brand->created_at)->format('H:i:s Y/m/d')}}

                        </p>
                    </div>
                </div>

            @endforeach

        </article>
    </section>
    <x-paginate :items="$brands"/>

@endsection

