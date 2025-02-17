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
        <a href="{{route('admin.invoice.product.create')}}" class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/plus.svg")}}" alt="">

            <h1 class="text-min font-bold">لیست فاکتور های ثبت شده</h1>
        </a>
        <div class="border border-black flex items-center py-1.5 px-2 rounded-md">
            <input type="text" placeholder="کاربر  ثبت کننده را وارد نمائید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none">
            <img src="{{asset('capsule/images/search.svg')}}" alt="">

        </div>
    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    کاربر ثبت کننده
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تامین کننده
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    مجموعه قیمت خریداری شده
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    توضیحات مربوط به فاکتور
                </h1>
            </div>

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($invoices as $key=> $invoice)
                <div
                    class="p-2 h-full @if(($key%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <a href="{{route('admin.invoice.product.invoiceProduct',$invoice->id)}}" class="w-1/5">
                        <p class="text-sky-500  text-min_sm font-bold  h-full flex items-center justify-center text-center underline underline-offset-4 ">
                            {{$invoice->operator->fullName??''}}
                        </p>
                    </a>
                    <div class="w-1/5">
                        <p class=" text-min_sm font-bold  h-full flex items-center justify-center text-center   ">
                            {{$invoice->supplier->name??''}}
                        </p>
                    </div>
                    <div class="w-1/5">
                        <p class="  text-min_sm font-bold  h-full flex items-center justify-center text-center  ">
                            {{numberFormat($invoice->final_amount)??''}}
                        </p>
                    </div>
                    <div
                        class="w-1/5 h-full  text-min_sm font-bold  h-full flex items-center justify-center text-center @if(strlen($invoice->description)>5) overflow-hidden text-nowrap text-ellipsis @endif ">
                        {!! $invoice->description??''!!}

                    </div>


                </div>

            @endforeach

        </article>
    </section>

@endsection
