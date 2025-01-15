@extends('Site.Layout.master')

@section('content')


    <section class="flex  w-full items-center justify-between py-5 px-2 border-b border-b-black/35">
        <div class="flex items-center space-x-2 space-x-reverse w-3/5 md:w-2/5  ">
            <div class="flex items-center border border-black/35 rounded-md p-2 w-full">
                <input type="text" placeholder="به دنبال چی میگردی..."
                       class="placeholder:text-min bg-transparent w-full outline-none">
                <img src="{{asset("capsule/images/search.svg")}}" alt="">
            </div>
        </div>
        <div class="flex  items-center space-x-2 space-x-reverse">
            <div class="">
                <a href="" class="border border-2081F2 rounded-md py-1.5 px-2 text-min">
                    ثبت نام / ورود
                </a>
            </div>
            <img src="{{asset('capsule/images/order.png')}}" alt="" class="w-6 h-6">

        </div>

    </section>


    <section class="p-4">
        <article class="flex items-center justify-between flex-wrap ">

            @foreach($products as $product)
                <a href="{{route('panel.product',$product->title)}}" class="w-full sm:w-[49%] md:w-[32%] lg:w-[24%] xl:w-[15%] shadow shadow-black/35 rounded-md p-2 mb-5">
                    <div class=" w-full flex items-center justify-center">
                        <img src="{{asset($product->image->path??'')}}" alt="" class="w-44 h-44">
                    </div>
                    <p class="text-min mt-2 overflow-hidden text-nowrap text-ellipsis  ">
                        {{$product->title}}

                    </p>
                    <div class="mt-2 ">
                        <div class="flex justify-between items-center">

                            <span class="py-1.5 px-2 flex items-center justify-center text-min bg-2081F2 text-white rounded-md">5%</span>
                            <p>
                                {{numberFormat($product->price)}}
                                <span>ریال</span>
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach



        </article>
    </section>


@endsection
