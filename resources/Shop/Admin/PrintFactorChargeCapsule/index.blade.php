@extends('Admin.Layout.master')
@section('header')
    <style>


        @media print {
            @page {
                size: A4;
                margin: 0;
                padding: 0;

            }

            body {
                margin: 0;
                padding: 0;
            }
            .redirect-back {
                display: none;
            }

            .cpasule-count {
                font-size: 12px;
                font-weight: bold;
            }

            #toast-container {
                display: none;
            }
            .print{
                width: 100%!important;
            }
            .qrcode {
                background-color: white!important;
                width: 115px!important;
            }
            canvas{
                background-color: white!important;
            }

        }
    </style>

@endsection
@section('content')

    <section class=" space-y-6  px-2 md:w-1/2 md:mx-auto print">

        <article class="space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <div class="space-y-5 py-1.5 px-5">
                <article class="flex items-center justify-between text-sm ">
                    <div class="flex items-center  justify-between space-x-2 space-x-reverse">
                        <p class="font-bold text-base">تحویل گیرنده :</p>
                        <p class="text-sm font-semibold">{{$reside->operator->fullName}}</p>
                    </div>
                    <div class="flex items-center justify-between space-x-2 space-x-reverse ">
                        <p class="font-bold text-base">تاریخ :</p>
                        <p class="text-sm font-semibold">{{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d')}}</p>
                    </div>
                </article>
                <article class="flex items-center justify-between text-sm ">
                    <div class="flex items-center justify-between flex-col space-y-1">
                        <p class="font-bold text-base">اقلام :</p>
                    </div>
                    <div class="flex items-center justify-between space-x-2 space-x-reverse">
                        <p class="font-bold text-base">شماره فاکتور :</p>
                        <p class="text-sm font-semibold">{{$reside->id}}</p>
                    </div>
                </article>
            </div>

            <table class="border-collapse  border border-gray-400 w-full table-fixed">
                <thead class="bg-F1F1F1">
                <tr>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6  text-black font-semibold ">
                        <span>ردیف</span>
                    </th>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6  text-black font-semibold ">
                        <span> سفارش</span>
                    </th>

                    <th class="border border-gray-400 text-sm font-light px-2 leading-6 text-black font-semibold max-w-max">
                        <span>بارکد  </span>
                    </th>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6 text-black font-semibold max-w-max">
                        <span>کدیکتا هرکپسول  </span>
                    </th>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6 text-black font-semibold max-w-max">
                        <span>قیمت </span>
                    </th>


                </tr>

                </thead>
                <tbody>
                @foreach($reside->resideItem as $key=>$resideItem)
                    <tr class="@if($key%2==0) bg-gray-200 @endif">
                        <td class="border border-gray-400 text-center  p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full">
                                {{$key+1}}
                            </p>
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                {{$resideItem->product->removeUnderline??''}}
                            </p>
                        </td>

                        <td class="border border-gray-400 text-center p-1">
                            <div class="flex items-center justify-center">
                                <canvas class="qrcode !w-full sm:!w-[130px] !h-auto "
                                        data-product="{{$resideItem->changeToQrcodeNameProduct()}}"></canvas>
                            </div>
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <div class="flex items-center justify-center">
                                {{$resideItem->unique_code??''}}
                            </div>
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                {{numberFormat($resideItem->getTotalProductPriceItems())}}
                            </p>
                        </td>

                    </tr>
                @endforeach
                <tr>
                    <td class="border border-gray-400 text-center  p-1" colspan="2">
                        <div class="flex items-center justify-center space-x-reverse space-x-3 p-1">
                            <p class="font-semibold"> @if($reside->commission>0) با احتساب مالیات بر ارزش افزوده @else بدون احتساب مالیات بر ارزش افزوده @endif</p>
                        </div>
                    </td>
                    <td class="border border-gray-400 text-center  p-1" colspan="4">
                        <div class="flex items-center space-x-reverse space-x-3 p-1">
                            <h1 class="font-semibold text-base">مجموع کل :</h1>
                            <p class="cpasule-count font-semibold">{{numberFormat($reside->final_price)??0}} ریال </p>
                        </div>
                    </td>

                </tr>


                </tbody>
            </table>


        </article>
        <section class="flex items-center  space-x-reverse space-x-3 redirect-back">
            <div class="bg-FF3100 px-4 text-sm font-medium shadow py-1 text-white  rounded-md">
                <a href="{{route('admin.resideCapsule.index')}}">بازگشت</a>
            </div>

        </section>
    </section>

@endsection
@section('script')
    <script>
        function generateQrCode() {
            let qrCodeElement = document.querySelectorAll('.qrcode');
            let count = 0;
            let color = '';
            for (const imgQr of qrCodeElement) {
                if (count % 2 !== 0) {
                    color = '#ffffff';
                } else {
                    color = '#e5e7eb';
                }
                count += 1;
                QRCode.toCanvas(imgQr, imgQr.dataset.product, {
                    color: {
                        dark: '#000000',
                        light: color,

                    }
                });

            }
        }

        generateQrCode();
    </script>

        <script>
            window.addEventListener('load', function () {
                window.print();
            })
        </script>
@endsection
