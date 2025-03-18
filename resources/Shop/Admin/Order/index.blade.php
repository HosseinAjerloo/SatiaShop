@extends('Admin.Layout.master')

@section('content')



    <x-Search-date routeSearch="{{route('admin.order.index')}}" routeList="null"
    name='لیست تمامی سفارشات' placeholder='شماره موبایل کاربر را وارد نمائید ...' imagePath='{{asset("capsule/images/order.png")}}'
    />



    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2  py-3 hidden sm:flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-[7%] max-w-[7%]">
                <h1 class="text-white text-min font-bold text-right">
                    #
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    نام و نام خانوادگی
                </h1>
            </div>

            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                   موبایل کاربر
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    بانک
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    وضعیت پرداخت
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    میلغ کل(تومان)
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    مشاهده جزئیات
                </h1>
            </div>
            <div class="w-[11%] max-w-[11%]">
                <h1 class="text-white text-min font-bold text-right">
                    تاریخ
                </h1>
            </div>

        </article>

        <article class=" border-0 sm:border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($orders as $key=> $order)
                <div class="p-2 shadow-md shadow-gray-400 border-2 border-black/20 sm:border-none rounded-md sm:rounded-none sm:shadow-none h-full space-y-3 sm:space-y-0 flex-wrap sm:flex-row @if($key%2==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class=" border-b border-black/35 sm:border-none py-1.5  w-full justify-between  sm:w-[7%] sm:max-w-[7%]    h-full flex items-center  text-right whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm font-bold ">
                            #
                        </p>
                        <p class="sm:text-min_sm sm:font-bold">
                            {{$key+1}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex  sm:w-[11%] sm:max-w-[11%]">
                        <p class="sm:hidden text-min_sm font-bold">
                            نام و نام خانوادگی
                        </p>
                        <p class="text-sky-500  text-min_sm sm:font-bold  h-full flex items-center text-right leading-8 underline underline-offset-4   whitespace-normal break-words ">
                            {{$order->user->fullName??''}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between   sm:w-[11%] sm:max-w-[11%] text-min_sm   h-full flex items-center text-right whitespace-normal break-words ">
                        <p class="sm:hidden text-min_sm font-bold">موبایل کاربر</p>
                        {{$order->user->mobile??''}}

                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">بانک</p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right ">
                            {{$order->invoice->bank->name??''}}
                        </p>
                    </div>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">
                            وضعیت پرداخت
                        </p>
                        <p class="text-black  text-sm sm:font-bold  h-full flex items-center text-right">
                            {{$order->invoice->statusPayment()?'پرداخت شده':'پرداخت انجام نشده'}}
                        </p>
                    </div>

                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">
                            مبلغ کل(تومان)
                        </p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-words">
                            {{numberFormat(($order->total_price/10))}}

                        </p>

                    </div>
                    <a href="{{route('admin.order.invoiceDetails',$order->invoice_id)}}" class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">مشاهده جزئیات</p>
                        <p class="text-sky-500  text-min_sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-words">
                            ...
                        </p>
                    </a>
                    <div class="border-b border-black/35 sm:border-none w-full justify-between flex sm:w-[11%] sm:max-w-[11%] h-full whitespace-normal break-words">
                        <p class="sm:hidden text-min_sm font-bold">تاریخ</p>
                        <p class="text-black  text-min_sm sm:font-bold  h-full flex items-center text-right whitespace-normal break-words">
                            {{\Morilog\Jalali\Jalalian::forge($order->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>




                </div>

            @endforeach

        </article>
    </section>

    <x-paginate :items="$orders"/>

@endsection
