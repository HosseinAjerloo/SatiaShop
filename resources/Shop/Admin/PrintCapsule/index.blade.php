@extends('Admin.Layout.master')
@section('header')
    <style>
        @page {
            size: A5;
            margin: 0;
        }


        @media print {
            body {
                border: none;
            }
            .print{
                width: 500px!important;
            }
        }
    </style>

@endsection
@section('content')

    <section class=" space-y-3 relative">
        <article class="flex items-center justify-center">
            <div class=" w-1/3 border-2 border-black rounded-md p-4 space-y-2.5 print">
                <div class="flex items-center justify-between">
                    <p class="font-semibold text-sms">سازمان آتش نشانی و خدمات ایمنی شهرداری اردبیل</p>
                    <img src="{{asset('capsule/images/logo-125.png')}}" alt="" class="w-8">
                </div>
                <div class="  w-5/6 mx-auto">
                    <div class="flex items-center justify-center border border-black rounded-md p-1.5 ">
                        <p class="font-semibold text-sms leading-6">توجه : مدت اعتبار این کارت یکسال از تاریخ شارژ می باشد</p>
                    </div>
                </div>

                <div class="  w-5/6 mx-auto">
                    <div class="flex items-center justify-center  rounded-md p-1.5 space-x-reverse space-x-6">
                        <p class="font-bold text-lg">شناسه یکتا :</p>
                        <canvas class="qrcode !w-full sm:!w-[150px] !h-auto "
                                data-product="{{$resideItem->changeToQrcodeNameProduct()}}"></canvas>
                    </div>
                </div>
                <div>
                    <ul class="space-y-4">
                        <li>
                            <span class="font-bold">نوع کپسول :</span>
                            <span>{{$resideItem->product->removeUnderline}}</span>
                        </li>
                        <li>
                            <span class="font-bold">تاریخ شارژ :</span>
                            <span>{{\Morilog\Jalali\Jalalian::forge($resideItem->created_at)->format('Y/m/d')}}</span>

                        </li>
                        <li>
                            <span class="font-bold">تاریخ انقضا :</span>
                            <span>{{\Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::make($resideItem->created_at)->addYear())->format('Y/m/d')}}</span>

                        </li>
                        <li>
                            <span class="font-bold">مسئول کنترل نهایی :</span>
                            <span>{{$resideItem->reside->operator->fullName}}</span>

                        </li>
                    </ul>
                </div>

                <div class="flex items-center justify-center">
                    <img src="{{asset('capsule/images/accept.png')}}" alt="" class="w-40">
                </div>
                <div class="flex items-center justify-center space-x-reverse space-x-2">
                    <img src="{{asset('capsule/images/location.png')}}" alt="" class="w-5">
                    <p class="font-semibold text-sms leading-6">آدرس : اردبیل ، میدان بعثت ، روبروی آهن فروشان تلفن 33619000</p>
                </div>
            </div>

        </article>

        <section class="flex items-center justify-center  redirect-back ">
            <div class="bg-FF3100 px-4 text-sm font-medium shadow py-1 text-white   rounded-md">
                <a href="{{route('admin.resideCapsule.index')}}">بازگشت</a>
            </div>

        </section>
    </section>

@endsection
@section('script')

    @section('script')
        <script>
            function generateQrCode() {
                let qrCodeElement = document.querySelectorAll('.qrcode');
                for (const imgQr of qrCodeElement) {

                    color = '#ffffff';

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
            // window.addEventListener('load',function (){
            //     window.print();
            // })
        </script>
    @endsection
