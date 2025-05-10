@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-3 relative">
        <article class="flex items-center justify-center">
            <div class=" w-1/3 border-2 border-black rounded-md p-4 space-y-5">
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
                        <canvas class="qrcode !w-full sm:!w-[130px] !h-auto "
                                data-product="جسین- آجرلو ماشین  - تست - گل"></canvas>
                    </div>
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

    @endsection
