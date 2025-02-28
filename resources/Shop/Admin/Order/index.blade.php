@extends('Admin.Layout.master')

@section('content')



    <x-Search-date routeSearch="{{route('admin.menu.index')}}" routeList="null"
    name='لیست تمامی سفارشات' placeholder='شماره موبایل کاربر را وارد نمائید ...' imagePath='{{asset("capsule/images/order.png")}}'
    />
    
    
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   #
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام و نام خانوادگی
                </h1>
            </div>

            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    موبایل کاربر
                </h1>
            </div>



            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   بانک
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    وضعیت پرداخت
                </h1>
            </div>


            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    مبلغ کل (تومان)
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    مشاهده جزئیات
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تاریخ
                </h1>
            </div>


        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($orders as $key=> $order)
                <div class="p-2 h-full @if((($key+1)%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$key+1}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                           {{$order->user->fullName??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                           {{$order->user->mobile??''}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$order->invoice->bank->name??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$order->invoice->statusPayment()?'پرداخت شده':'پرداخت انجام نشده'}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{numberFormat(($order->total_price/10))}}
                        </p>
                    </div>


                    <a href="{{route('admin.order.invoiceDetails',$order->invoice_id)}}" class="w-1/5 h-full">
                        <p class="text-sky-500 cursor-pointer underline underline-offset-2 decoration-solid  text-sm font-bold  h-full flex items-center justify-center text-center">
                           ....
                        </p>
                    </a>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{\Morilog\Jalali\Jalalian::forge($order->created_at)->format('H:i:s Y/m/d')}}
                        </p>
                    </div>
                </div>


            @endforeach

        </article>
    </section>
    <x-paginate :items="$orders"/>

@endsection
