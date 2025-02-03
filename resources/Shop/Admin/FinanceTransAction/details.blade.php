@extends('Admin.Layout.master')

@section('content')

    <section class="flex items-center justify-center space-x-reverse space-x-3">
        <div class=" border-black rounded-md p-1 submit_date cursor-pointer" data-date="1">
            <img src="{{asset("capsule/images/1Mount.svg")}}" alt="">
        </div>
        <div class="submit_date cursor-pointer border-black rounded-md p-1" data-date="3">
            <img src="{{asset("capsule/images/3Mount.svg")}}" alt="">
        </div>
        <div class="submit_date cursor-pointer border-black rounded-md p-1" data-date="6">
            <img src="{{asset("capsule/images/6Mount.svg")}}" alt="">
        </div>
        <div class="border-black rounded-md p-1 submit_date cursor-pointer">
            <img src="{{asset("capsule/images/date.svg")}}" alt="">
        </div>

    </section>
    <form id="form" class="flex items-center justify-between space-x-reverse space-x-3 px-2 mt-5"
          action="{{route('admin.finance.transaction.details',$finance)}}">
        <div  class="flex items-center space-x-reverse space-x-2">
            <img src="{{asset("capsule/images/financeTransaction.png")}}" alt="">
            <h1 class="text-min font-bold">لیست جزئیات تراکنش های کاربر</h1>
        </div>
        <input type="hidden" name="date" id="input_date">

    </form>
    <section class="px-2 mt-5">
        <article
            class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نام کاربر
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    نوع
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                 مبلغ
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                   مبلغ کیف پول
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                    توضیحات
                </h1>
            </div>
            <div class="w-1/5">
                <h1 class="text-white text-min font-bold text-center">
                تاریخ
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
                          {{ $financeTransaction->getType()}}
                        </p>
                    </div>

                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{numberFormat(($financeTransaction->amount / 10))}}
                            تومان
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{numberFormat(($financeTransaction->creadit_balance / 10))}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{$financeTransaction->description??''}}
                        </p>
                    </div>
                    <div class="w-1/5 h-full">
                        <p class="text-black  text-min_sm font-bold  h-full flex items-center justify-center text-center">
                            {{\Morilog\Jalali\Jalalian::forge($financeTransaction->created_at)->format(' H:i:s Y/m/d')}}
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
