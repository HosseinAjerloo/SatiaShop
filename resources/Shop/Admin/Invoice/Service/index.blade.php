@extends('Admin.Layout.master')

@section('content')



    <x-Search-date routeSearch="{{route('admin.invoice.service.index')}}" routeList="{{route('admin.invoice.service.create')}}"
    name="لیست سرویس ها"  placeholder='شماره موبایل کاربر ثبت کننده را وارد فرمایید' imagePath='null'/>

    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
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
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    تاریخ ایجاد
                </h1>
            </div>

        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($invoices as $key=> $invoice)
                <div
                    class="p-2 h-full @if(($key%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <a href="{{route('admin.invoice.service.invoiceService',$invoice->id)}}" class="w-1/5">
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
                    <div class="w-1/5 h-full  text-min_sm font-bold   flex items-center justify-center text-center @if(strlen($invoice->description)>5) overflow-hidden text-nowrap text-ellipsis @endif ">
                        {!! $invoice->description??''!!}

                    </div>


                    <div class="w-1/5 h-full  text-min_sm font-bold   flex items-center justify-center text-center @if(strlen($invoice->description)>5) overflow-hidden text-nowrap text-ellipsis @endif ">
                        {{\Morilog\Jalali\Jalalian::forge($invoice->created_at)->format('H:i:s Y/m/d')}}

                    </div>

                </div>

            @endforeach

        </article>
    </section>
    <x-paginate :items="$invoices"/>

@endsection
