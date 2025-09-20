@extends('Admin.Layout.master')
@section('header')
    <style>

        @media print {
            /* تنظیمات صفحه پرینت */
            @page {
                size: A4 portrait;
                margin: 0mm;
            }
            #toast-container {
                display: none;
            }
            header {
                display: none !important;
            }

            html, body {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                height: 100% !important;
                overflow: hidden !important;
                box-sizing: border-box;
                background-color: white !important;

            }

            .wrapper, .container, .print-area {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                height: 100% !important;
                box-sizing: border-box;
            }

            table {
                width: 100% !important;
                max-width: 100% !important;
                table-layout: fixed !important;
                border-collapse: collapse !important;
                font-size: 9pt !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            th, td {
                padding: 2px !important;
                width: 100% !important;
                margin: 0 !important;
                border: 1px solid #000 !important;
                white-space: normal !important;
                word-wrap: break-word !important;
            }

            * {
                print-color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
            }

            .printScale {
                width: 100% !important;
            }
            .print-btn{
                display: none;
            }
        }


    </style>

@endsection

@section('content')

    <section class=" space-y-3 relative">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md ">

            <section class=" printScale mx-auto w-[49%] space-y-5  flex flex-col items-center justify-center">
                <article class="flex w-full    items-center  border-b-2 border-black ">
                    <div class="flex items-center space-x-reverse space-x-2 py-1.5">
                        <img src="{{asset('capsule/images/logo.svg')}}" alt="">
                        <p>سازمان آتش نشانی و خدمات ایمنی شهرداری اردبیل</p>
                    </div>

                </article>
                <article class="flex  w-full   items-center justify-between ">

                    <div class="flex items-center space-x-reverse space-x-2 ">
                        <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                            <span class="text-sm sm:tetx-base">{{$reside->user->fullName??''}}</span>
                        </div>

                    </div>
                    <div class="flex items-center justify-end space-x-reverse  space-x-2 ">
                        <h1 class="font-bold text-sm sm:tetx-base">تاریخ:</h1>
                        <span
                            class="text-sm sm:tetx-base">{{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d')}}</span>
                    </div>

                </article>
                <article class="flex  w-[49%]   items-center justify-between ">
                    <div class="flex items-center space-x-reverse space-x-2 ">

                        <div class="flex items-center space-x-2 space-x-reverse">
                            <h1 class="font-bold text-sm sm:tetx-base">اقلام:</h1>
                        </div>

                    </div>
                    <div class="flex items-center justify-start space-x-reverse  space-x-2 ">
                        <h1 class="font-bold text-sm sm:tetx-base">شماره فاکتور:</h1>
                        <span
                            class="text-sm sm:tetx-base">{{$reside->id??""}}</span>
                    </div>

                </article>

            </section>

            <div  class="w-full flex  justify-center flex-wrap" id="form">
                @csrf

                <div class="w-[50%] printScale">
                    <table class="border-collapse   border border-gray-400 table-fixed w-full">
                        <thead class="bg-2081F2 ">
                        <tr>
                            <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                                <span class="font-bold">ردیف</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                                <span class="text-min sm:text-sm text-nowrap font-bold">کدیکتا</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                                <span class="text-min sm:text-sm text-nowrap font-bold">شرح کالا</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                                <span class="text-min sm:text-sm text-nowrap font-bold">تعداد</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                                <span class="text-min sm:text-sm text-nowrap font-bold">قیمت کل</span>
                                <span class="text-[11px]">(ریال)</span>
                            </th>

                            <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                                <span class="text-min sm:text-sm text-nowrap font-bold">QR</span>
                            </th>

                        </tr>

                        </thead>
                        <tbody>
                        @foreach($reside->resideItem as $index=> $resideItem)

                            <tr class=" bg-white">

                                <td class="border border-gray-400  text-center">
                                    <p class="text-[15px]  sm:text-[13px] p-1 w-full font-bold">
                                        {{$index+1 }}
                                    </p>
                                </td>
                                <td class="border border-gray-400  text-center  "
                                    rowspan="{{$resideItem->productResidItem->count()+1}}">
                                    <p
                                        class=" text-[15px] sm:text-[13px]  p-1 w-full ">
                                        {{$resideItem->unique_code??''}}
                                    </p>
                                </td>
                                <td class="border border-gray-400  text-center">
                                    <p class="text-[15px]  sm:text-[13px]  p-1 w-full ">
                                        {{$resideItem->product->removeUnderline??''}}
                                    </p>
                                </td>
                                <td class="border border-gray-400  text-center">
                                    <p class="  text-[15px] sm:text-[13px] p-1 w-full ">
                                        {{$resideItem->amount??0}}
                                    </p>
                                </td>

                                <td class="border border-gray-400  text-center">
                                    <p class="  text-[15px] sm:text-[13px] p-1 w-full ">
                                        {{numberFormat($resideItem->price)??0}}
                                    </p>
                                </td>
                                <td class="border border-gray-300">

                                    <canvas class="qrcode !w-full sm:!w-[95px] !h-auto "
                                            data-product="{{$resideItem->product->removeUnderline}}"></canvas>

                                </td>
                            </tr>
                        @endforeach
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class="text-[15px]  sm:text-[13px]  p-1 w-full font-bold">
                                    جمع
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class=" text-[15px]  sm:text-[13px]  p-1 w-full ">
                                    {{numberFormat($reside->total_price)??''}}
                                    ریال
                                </p>
                            </td>
                        </tr>
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <div class="text-[15px]  sm:text-[13px]  p-1 w-full ">
                                    <div class="text-[15px]  sm:text-[13px]  p-1 w-full font-bold relative">
                                        <span>
                                            <span>تخفیف</span>
                                            <span class="showDiscount ">({{$reside->resideDiscountAmount}})</span>
                                        </span>
                                        <div
                                            class="invisible transition-all absolute z-[101] w-5/6	 h-75  top-0 right-[60%] rounded-lg  bg-white shadow-md shadow-black/35 ">
                                            <div
                                                class="flex items-center justify-start space-x-reverse space-x-2 bg-E0E0E0  border-2 border-b-black p-2">
                                                <p class="font-medium">
                                                    تعیین تخفیف برای :
                                                </p>
                                                <span class="font-semibold">
                                                      {{numberFormat($reside->total_price)??''}}
                                                </span>
                                            </div>
                                            <div class="px-1.5 py-2 space-y-4">
                                                <div class="flex items-center space-x-2 space-x-reverse">
                                                    <label class="w-1/4 flex items-center justify-start">بدون
                                                        تخفیف</label>
                                                    <input type="radio" name="disc">

                                                </div>
                                                <div class="flex items-center space-x-2 space-x-reverse">
                                                    <label class="w-1/4 flex items-center justify-start">% قیمت</label>
                                                    <input type="radio" name="disc">
                                                    <div
                                                        class="invisible flex items-center   space-x-reverse space-x-4 ">
                                                        <input type="number" min="0" max="100" name="discountDecimal"
                                                               class="border w-[50px] rounded-md p-[3px] text-center outline-none discount">
                                                        <h1 class="font-bold">درصد</h1>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2 space-x-reverse ">
                                                    <label class="w-1/4 flex items-center justify-start">کسر از
                                                        قیمت</label>
                                                    <input type="radio" name="disc">
                                                    <div
                                                        class="invisible flex items-center w-3/5  space-x-reverse space-x-4 ">
                                                        <input type="number" min="0" max="100" name="discount_price"
                                                               class="w-3/5	 border  rounded-md p-[3px] text-center outline-none discount">
                                                        <h1 class="font-bold">ریال مبلغ</h1>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center space-x-4 space-x-reverse text-white ">
                                                    <button type="button"
                                                            class="px-10 py-1.5 rounded-lg bg-268832 submit-discount">
                                                        ذخیره
                                                    </button>
                                                    <button type="button"
                                                            class="px-10 py-1.5 rounded-lg bg-FF3100 close close-btn-discount">
                                                        لغو
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class="totalPriceDiscount text-[15px] space-x-reverse space-x-2  sm:text-[13px]  p-1 w-full flex items-center justify-center">
                                    {{numberFormat($reside->calculationWithDiscount())??''}}

                                    ریال
                                </p>
                            </td>
                        </tr>
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <div
                                    class="text-[15px] space-x-reverse space-x-2  sm:text-[13px]  p-1 w-full font-bold flex items-center justify-center">

                                    <span>  {{$reside->commission}}%مالیات</span>
                                </div>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="3">
                                <span class="totalPricePlusTax text-[15px]  sm:text-[13px]  p-1 w-full "
                                >
                                    {{numberFormat($reside->final_price)??0}}
                                    ریال
                                </span>
                            </td>
                        </tr>
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class="text-[15px]  sm:text-[13px]  p-1 w-full font-bold">
                                    جمع کل
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class="final-price  text-[15px]  sm:text-[13px]  p-1 w-full ">
                                    {{numberFormat($reside->final_price)??0}}
                                    ریال

                                </p>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <div class="w-full mt-8 space-x-4 space-x-reverse flex items-center print-btn">
                        <button class="rounded-md px-4 py-1.5 flex items-center justify-center text-white bg-268832" onclick="print()">چاپ مجدد</button>
                        <a href="{{route('admin.invoice-list.index')}}" class="rounded-md px-4 py-1.5 flex items-center justify-center text-white bg-FF3100">بازگشت</a>
                    </div>
                </div>

            </div>


        </article>

    </section>

@endsection
@section('content-blur')
    <section
        class="fixed top-0 bottom-0 left-0 right-0 bg-black/65 w-full h-full transition-all hiddenLayer final-tide ">

    </section>
@endsection

@section('script')

{{--    <script>--}}
{{--        function generateQrCode() {--}}
{{--            let qrCodeElement = document.querySelectorAll('.qrcode');--}}
{{--            let color = '#ffffff';--}}

{{--            for (const imgQr of qrCodeElement) {--}}

{{--                QRCode.toCanvas(imgQr, imgQr.dataset.product, {--}}
{{--                    color: {--}}
{{--                        dark: '#000000',--}}
{{--                        light: color,--}}

{{--                    }--}}
{{--                });--}}

{{--            }--}}
{{--        }--}}

{{--        generateQrCode();--}}
{{--    </script>--}}
    <script>
        let element=document.querySelectorAll('.printScale')
        window.addEventListener('load', function () {

            window.print();
        })
        window.addEventListener('beforeprint',function (){
            element.forEach(ele=>{
                ele.style.width='100%';
            })
        });
        window.addEventListener('afterprint',function (){
            element.forEach(ele=>{
                ele.style.width='49%';
                ele.style.margin='auto';
            })
        })
    </script>


@endsection
