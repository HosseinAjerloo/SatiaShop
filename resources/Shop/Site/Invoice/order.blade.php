@extends('Site.Layout.master')

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
        <a href="{{route('admin.category.create')}}" class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/plus.svg")}}" alt="">
            <h1 class="text-min font-bold">لیست محصولات</h1>
        </a>
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="نام محصول را وارد نمائید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none">
            <img src="{{asset('capsule/images/search.svg')}}" alt="">

        </div>
    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام خریدار
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    شماره فاکتور
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    مبلغ پرداخت شده
                </h1>
            </div>


        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($orders as $order)
                <div
                    class="p-2 h-full @if(($order->id%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">


                    <div class="w-1/5 h-full">
                        <p class="text-black   text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{($order->user->fullName??'')}}
                        </p>
                    </div>

                    <a href="{{route('panel.order.order.item',$order->invoice_id)}}" class="w-1/5 h-full">
                        <p class="text-sky-500 underline underline-offset-4  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{($order->invoice->id)}}
                        </p>
                    </a>

                    <div class="w-1/5 h-full">
                        <p class="text-black   text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{(numberFormat($order->total_price))}}
                        </p>
                    </div>







                </div>

            @endforeach

        </article>
    </section>

@endsection
