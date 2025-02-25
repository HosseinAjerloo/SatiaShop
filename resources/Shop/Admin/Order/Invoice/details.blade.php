@extends('Admin.Layout.master')

@section('content')


    <section  class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5">
        <div  class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/invoice.png")}}" alt="">
            <h1 class="text-min font-bold">لیست جزئیات سفارشات  کاربر</h1>
        </div>
        <input type="hidden" name="date" id="input_date">

    </section>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    #
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    شماره سفارش
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام محصول
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                 مبلغ
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   تعداد
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نوع محصول
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                تاریخ
              </h1>
            </div>


        </article>

        <article class="  border border-t-0 border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
            @foreach($invoice->invoiceItem as $key=> $invoiceItem)
                <div class="p-2 h-full @if(($key%2)==0) bg-E9E9E9 @endif  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$key+1}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$invoiceItem->invoice_id??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                          {{ $invoiceItem->product->removeUnderLine}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{numberFormat(($invoiceItem->price / 10))}}
                            تومان
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$invoiceItem->amount??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{($invoiceItem->product->type=='goods'?'کالا':'سرویس')}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{\Morilog\Jalali\Jalalian::forge($invoiceItem->created_at)->format(' H:i:s Y/m/d')}}
                        </p>
                    </div>

                </div>


            @endforeach

        </article>
    </section>

@endsection
@push('search')
    <script>
        $(document).ready(function () {
            $(".submit_date").click(function () {
                $(".submit_date").removeClass('border')
                $(this).addClass('border')
                $('#input_date').val($(this).data('date'))
                permissionRequest();
                $('#form').submit()

            });

            $(".search").click(function () {
                permissionRequest();
                $('#form').submit();
            })

            function permissionRequest() {
                if ($('#input_search').val() === '')
                    $("#input_search").removeAttr('name')

                if ($('#input_date').val() === '')
                    $("#input_date").removeAttr('name')
            }
        })

    </script>
@endpush
