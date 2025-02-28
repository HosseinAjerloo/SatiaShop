@extends('Admin.Layout.master')

@section('content')


    <x-Search-date routeSearch="{{route('admin.product.index')}}" routeList="{{route('admin.product.create')}}"
    name='لیست محصولات' placeholder='نام کالارا وارد نمایید' imagePath='null'
    />

    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2  py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    #
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    عنوان
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    توضیحات
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نوع محصول
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    وضعیت
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    قیمت
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    برند
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    دسته محصول
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تاریخ ایجاد
                </h1>
            </div>

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($products as $key=> $product)
                <div
                    class="p-2 h-full @if((($key+1)%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div
                        class="w-1/5 h-full  text-min_sm font-bold  h-full flex items-center justify-center text-center @if(strlen($product->description)>5) overflow-hidden text-nowrap text-ellipsis @endif ">
                        {{$key+1}}
                    </div>
                    <a href="{{route('admin.product.edit',$product->id)}}" class="w-1/5">
                        <p class="text-sky-500  text-min_sm font-bold  h-full flex items-center justify-center text-center underline underline-offset-4 ">
                            {{$product->removeUnderLine??''}}
                        </p>
                    </a>
                    <div
                        class="w-1/5 h-full  text-min_sm font-bold  h-full flex items-center justify-center text-center @if(strlen($product->description)>5) overflow-hidden text-nowrap text-ellipsis @endif ">
                        {!! $product->description??''!!}

                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black   text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{($product->type=='goods'?'کالا':'سرویس')}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-sm font-bold  h-full flex items-center justify-center text-center">
                            @if($product->status=='active')
                                فعال
                            @else
                                غیرفعال
                            @endif
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{numberFormat($product->price)??''}} ریال
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$product->brand->name??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$product->category->name??''}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{\Morilog\Jalali\Jalalian::forge($product->created_at)->format('H:i:s Y/m/d')}}

                        </p>
                    </div>
                    


                </div>

            @endforeach

        </article>
    </section>
    <x-paginate :items="$products"/>

@endsection

