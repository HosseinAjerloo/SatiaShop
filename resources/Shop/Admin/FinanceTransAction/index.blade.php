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
        <div  class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/productTransaction.png")}}" alt="">
            <h1 class="text-min font-bold">لیست انبار</h1>
        </div>
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="شماره موبایل کاربر را وارد کنید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none">
            <img src="{{asset('capsule/images/search.svg')}}" alt="">

        </div>
    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
           
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام و نام خانوادگی
                </h1>
            </div>
              
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    موبایل
                </h1>
            </div>
         
          
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   مشاهده جزئیات
                </h1>
            </div>
         

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($financeTransactions as $financeTransaction)
                <div class="p-2 h-full @if(($financeTransaction->id%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                           {{$financeTransaction->user->fullName??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                           {{$financeTransaction->user->mobile??''}}
                        </p>
                    </div>
                

                
                    <a href="{{route('admin.finance.transaction.details',$financeTransaction->id)}}" class="w-1/5 h-full">
                        <p class="text-sky-500 cursor-pointer underline underline-offset-2 decoration-solid  text-sm font-bold  h-full flex items-center justify-center text-center">
                           ....
                        </p>
                    </a>
                </div>


            @endforeach

        </article>
    </section>

@endsection
