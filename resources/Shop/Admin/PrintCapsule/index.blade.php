@extends('Admin.Layout.master')
@section('header')
    <style>


        @media print {
            @page {
                size: A5;
                margin: 0;
                padding: 0;
                background-color: red;

            }
            body {
                margin: 0;
                padding: 0;
            }



        }
    </style>

@endsection
@section('content')

    <section class=" space-y-3 relative">
        <article class="flex items-center justify-center">
            <div class=" w-1/3 border-2 border-black rounded-md p-4 space-y-3">
                <div class="flex items-center justify-between">
                    <p class="font-semibold text-sms">سازمان آتش نشانی و خدمات ایمنی شهرداری اردبیل</p>
                    <img src="{{asset('capsule/images/logo-125.png')}}" alt="" class="w-8">
                </div>
                <div class="  w-5/6 mx-auto">
                    <div class="flex items-center justify-center border border-black rounded-md p-1.5 ">
                        <p class="font-semibold text-sms">توجه : مدت اعتبار این کارت یکسال از تاریخ شارژ می باشد</p>
                    </div>
                </div>

                <div class="  w-5/6 mx-auto">
                    <div class="flex items-center justify-center  rounded-md p-1.5 space-x-reverse space-x-6">
                        <p class="font-bold text-lg">شناسه یکتا :</p>
                        <canvas class="qrcode !w-full sm:!w-[150px] !h-auto "
                                data-product="جسین- آجرلو ماشین  - تست - گل"></canvas>
                    </div>
                </div>
                <div>
                    <ul class="space-y-4">
                        <li>
                            <span class="font-bold">نوع کپسول :</span>
                            <span>test</span>
                        </li>
                        <li>
                            <span class="font-bold">تاریخ شارژ :</span>
                            <span>test</span>

                        </li>
                        <li>
                            <span class="font-bold">تاریخ انقضا :</span>
                            <span>test</span>

                        </li>
                        <li>
                            <span class="font-bold">مسئول کنترل نهایی :</span>
                            <span>test</span>

                        </li>
                    </ul>
                </div>

                <div class="flex items-center justify-center">
                    <img src="{{asset('capsule/images/accept.png')}}" alt="" class="w-40">
                </div>
                <div class="flex items-center justify-center space-x-reverse space-x-2">
                    <img src="{{asset('capsule/images/location.png')}}" alt="" class="w-5">
                    <p class="font-semibold text-sms">آدرس : اردبیل ، میدان بعثت ، روبروی آهن فروشان تلفن 33619000</p>
                </div>
            </div>
        </article>

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
            window.addEventListener('load',function (){
                window.print();
            })
        </script>
    @endsection
