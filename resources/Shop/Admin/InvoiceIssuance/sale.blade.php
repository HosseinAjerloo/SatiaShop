@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-3 relative">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md">

            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2 w-1/2">
                    <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                        <span class="text-sm sm:tetx-base">حسین آجرلو</span>
                    </div>

                </div>
                <div class="flex items-center justify-end space-x-reverse  space-x-2 w-1/2">
                    <h1 class="font-bold text-sm sm:tetx-base">تاریخ:</h1>
                    <span
                        class="text-sm sm:tetx-base">{{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d')}}</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md ">
            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2">
                    <h1 class="font-bold">سفارش شارژ کپسول :</h1>
                </div>
                <div class="flex items-center space-x-reverse space-x-2">
                    <h1 class="font-bold text-sm sm:tetx-base">شماره فاکتور:</h1>
                    <span class="text-sm sm:tetx-base">{{$reside->id??""}}</span>
                </div>
            </article>
            <form action="{{route('admin.sale.generate.factor',$reside->id)}}" method="post" class="w-full" id="form">
                @csrf

                <table class="border-collapse   border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2 ">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span>سفارش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span>تعداد</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span class="text-min sm:text-sm text-nowrap">قمیت کل(ریال)</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white  p-2">
                            <span class="text-min sm:text-sm text-nowrap">چاپ بارکد</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody>
                    @foreach($reside->resideItem as $key=> $resideItem)
                        <tr class="@if($key%2==0) bg-white @else bg-gray-200/70 @endif">

                            <td class="border border-gray-400  text-center  p-1">
                                <p class="font-extrabold sm:text-[15px] text-[15px]  p-1 w-full ">
                                    {{$key+=1}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="font-extrabold sm:text-[15px] text-[15px]  p-1 w-full ">
                                    {{$resideItem->product->removeUnderline??''}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="font-extrabold sm:text-[15px] text-[15px]  p-1 w-full ">
                                    {{$resideItem->amount??''}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="font-extrabold sm:text-[15px] text-[15px]  p-1 w-full ">
                                    {{ numberFormat($resideItem->price??0)}}
                                </p>
                            </td>

                            <td class="border border-gray-300/75 flex items-center justify-center  text-center">
                                <a href="{{route('admin.print.capsule',$resideItem)}}">
                                    <canvas class="qrcode !w-full sm:!w-[80px] !h-auto "
                                            data-product="{{$resideItem->product->removeUnderline}}"></canvas>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    <tr class="@if($key%2==0) bg-white @else bg-gray-200/70 @endif">

                        <td class="border border-gray-400  text-center  p-1">
                            <div class="flex items-center justify-center">
                                <p class="sm:text-[15px] text-[10px] p-1 w-full max-w-max space-x-reverse space-x-2">
                                    {{env('Commission')}}% مالیات بر ارزش افزوده
                                </p>
                                <input name="commission" type="checkbox" value="yes" @if($reside->commission>0) checked="checked" @endif>
                            </div>
                        </td>
                        <td class="border border-gray-400  text-center  p-1" colspan="3">
                            <div class="flex items-center justify-center">
                                <p class="sm:text-[15px] text-base font-semibold p-1 w-full max-w-max ">
                                    جمع کل:
                                </p>
                                <span class="totalPrice">{{numberFormat($reside->total_price)}} ریال </span>
                            </div>
                        </td>

                    </tr>


                    </tbody>
                </table>
                <div class="mt-8 flex items-center  space-x-reverse space-x-4">
                    <h1 class="font-bold">تخفیف:</h1>
                    <input type="number" min="0" max="100" name="discount"
                           class="w-[50px] p-[3px] text-center outline-none">
                    <h1 class="font-bold">درصد</h1>
                </div>
                <div class="mt-8 w-full">
                    <h1 class="font-bold mb-3">توضیحات تخفیفی</h1>
                    <textarea name="description" id="description" class="w-full"></textarea>
                </div>
                <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button class="sodurFactor" type="button">صدور فاکتورنهایی</button>
                    </div>

                </section>
            </form>


        </article>

    </section>

@endsection
@section('script')
    <script>
        function generateQrCode() {
            let qrCodeElement = document.querySelectorAll('.qrcode');
            let count = 0;
            let color = '';
            for (const imgQr of qrCodeElement) {
                if (count % 2 === 0) {
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
        CKEDITOR.replace('description', {
            versionCheck: false,
            language: 'fa',
            removeButtons: 'Image,Link,Source,About'
        });
    </script>
    <script>

        let sodurFactor = document.querySelector('.sodurFactor');
        sodurFactor.onclick = function (event) {
            event.preventDefault();
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('value', 'yes');
            input.setAttribute('name', 'sodurFactor');
            window.form.append(input);
            window.form.submit();
        }
    </script>
    <script>
        let inputCommission = document.querySelector('input[name="commission"]');
        let commissionAmount = 0;
        let commission = "{{env('Commission')}}";
        let totalPrice = "{{$reside->total_price}}";
        let price = 0;
        commission = Number(commission);
        totalPrice = Number(totalPrice);
        inputCommission.addEventListener('change', function (event) {
            if (event.target.checked) {
                commissionAmount = ((totalPrice * commission) / 100) + totalPrice;
            } else {
                commissionAmount = totalPrice;
            }
            price = new Intl.NumberFormat('fa-IR', {
                style: 'currency',
                currency: 'IRR'
            }).format(commissionAmount);
            document.querySelector('.totalPrice').innerText = price;
        })
    </script>
@endsection
