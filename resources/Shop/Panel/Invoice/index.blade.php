@extends('Panel.Layout.Master')

@section('content')


    <section id="parent">
        <section class=" px-4 md:mt-3 w-full flex items-center justify-center space-y-2">
            <div class="w-full   p-4 rounded-lg border border-black bg-F1F1F1 space-y-4 ">
                <div class="flex flex-wrap justify-between items-center space-y-3 ">
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">نام و نام خانوادگی :</h1>
                        <span class="text-min_sm sm:w-1/2">{{$invoice->user->fullName}} </span>
                    </div>
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">کد ملی :</h1>
                        <span class="text-min_sm sm:w-1/2">{{$invoice->user->national_code??''}}</span>
                    </div>
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">تاریخ :</h1>
                        <span class="text-min_sm sm:w-1/2">1403/02/25</span>
                    </div>
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">مجموع خرید :</h1>
                        <span class="text-min_sm sm:w-1/2">{{numberFormat( ($invoice->final_amount/10) )}}</span>
                    </div>
                </div>
                <div class="flex flex-wrap justify-between items-center space-y-3 ">
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">نوع طرف حساب :</h1>
                        <span class="text-min_sm sm:w-1/2">حقیقی</span>
                    </div>
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">شماره موبایل :</h1>
                        <span class="text-min_sm sm:w-1/2">{{$invoice->user->mobile??''}}</span>
                    </div>
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">شماره ثابت :</h1>
                        <span class="text-min_sm sm:w-1/2">08632786560</span>
                    </div>
                    <div
                        class="w-full sm:w-2/4 md:w-2/5 lg:w-1/5 xl:w-1/4 flex justify-between items-center sm:justify-center">
                        <h1 class="font-bold text-sm sm:w-1/2">شماره فاکتور :</h1>
                        <span class="text-min_sm sm:w-1/2">{{$invoice->id}}</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="px-4 mt-3 md:mt-8 w-full flex items-center justify-center space-y-2 flex-col">
            <div class="w-full flex items-center space-x-reverse space-x-4">
                <h1 class="font-bold">فرم تحویل اقلام :</h1>
            </div>
        </section>
        <section class="px-4 md:mt-3 w-full flex items-center justify-center mt-5 flex-col">
            <article
                class="bg-ff253a  w-full py-3 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
                <div class="w-1/5">
                    <h1 class="text-white text-min font-bold text-center">
                        ردیف
                    </h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-white text-min font-bold text-center">
                        کالایاخدمات مصرفی
                    </h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-white text-min font-bold text-center">
                        تعداد
                    </h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-white text-min font-bold text-center">
                        بهای واحد(ریال)
                    </h1>
                </div>
                <div class="w-1/5">
                    <h1 class="text-white text-min font-bold text-center">
                        جمع کل(ریال)
                    </h1>
                </div>


            </article>
            <article class="  w-full   border border-t-0 border-black space-y-5  rounded-md rounded-se-none  rounded-ss-none">
                @foreach($invoice->invoiceItem as $key=> $invoiceItem)
                    <div
                        class="p-2 py-2.5 h-full @if(($key%2)==0) bg-E9E9E9 @endif border-b border-gray-100  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                        <a href="" class="w-1/5">
                            <p class="  text-min_sm font-bold  h-full flex items-center justify-center text-center  ">
                                {{$key+1}}
                            </p>
                        </a>
                        <div
                            class="w-1/5 h-full  text-min_sm font-bold  h-full flex items-center justify-center text-center @if(strlen('سرویس کپسول 6 کیلوئی پودر و گاز')>5) overflow-hidden text-nowrap text-ellipsis @endif ">
                            {{$invoiceItem->product->title??''}}

                        </div>
                        <div class="w-1/5 h-full">
                            <p class="text-black   text-min_sm font-bold  h-full flex items-center justify-center text-center">
                                {{$invoiceItem->amount??''}}
                            </p>
                        </div>
                        <div class="w-1/5 h-full">
                            <p class="text-black text-min_sm sm:text-sm font-bold  h-full flex items-center justify-center text-center">
                                {{numberFormat($invoiceItem->price)}}
                            </p>
                        </div>
                        <div class="w-1/5 h-full">
                            <p class="text-black  text-min_sm sm:text-sm font-bold  h-full flex items-center justify-center text-center">
                                {{numberFormat(($invoiceItem->price*$invoiceItem->amount))}}
                            </p>
                        </div>

                    </div>
                @endforeach
                <div class="text-sm font-semibold w-full flex items-center justify-center p-2">
                    <p class="bg-green-500 px-4 py-1.5 rounded-md text-white tracking-wide cursor-pointer copy ">
                        چاپ فاکتور
                    </p>
                </div>

            </article>

        </section>
    </section>

@endsection

@section('script')
    <script>
        $(".copy").click(function (){
            let contentBody='';
            contentBody=$('body').html();
            $(this).attr('class','hidden');
            let contentPrint=$("#parent").html();
            $('body').html('')
            $('body').html(contentPrint)
            window.print();
            $(this).removeClass('hidden');
            $('body').html(contentBody)


        })
    </script>
    <script>
        // window.onfocus=function(){ alert('ad')}

    </script>
@endsection
