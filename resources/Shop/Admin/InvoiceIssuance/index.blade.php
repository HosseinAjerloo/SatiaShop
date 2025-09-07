@extends('Admin.Layout.master')

@section('content')
    @php
        $count=1;
    @endphp
    <section class=" space-y-3 relative">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md">

            <article class="flex justify-between items-center">
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
                <div class="flex items-center justify-end space-x-reverse  space-x-2 ">
                    <h1 class="font-bold text-sm sm:tetx-base">شماره فاکتور:</h1>
                    <span
                        class="text-sm sm:tetx-base">{{$reside->id??""}}</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md ">
            <form action="{{route('admin.invoice.issuance.store',$reside->id)}}" enctype="multipart/form-data"
                  method="post" class="w-full flex  justify-between flex-wrap" id="form">
                @csrf

                <div class="w-[49%]">
                    <div>
                        <h1 class="font-bold mb-3">توضیحات تخفیفی</h1>
                        <textarea name="description" id="description" class="w-full border-none p-2 outline-none"
                                  cols="30"></textarea>
                    </div>
                    <div class="mt-8 flex items-center  space-x-reverse space-x-4">
                        <h1 class="font-bold">فایل ضمیمه:</h1>
                        <div class="bg-white p-2 rounded-md flex items-center justify-between w-2/5	">
                            <img src="{{asset('capsule/images/uploadFile.svg')}}" alt="">
                            <span class="text-gray-400/75">فایلی موجود نمیباشد</span>
                            <button class="bg-2081F2 text-white rounded-lg text-white p-2">انتخاب کنید</button>
                        </div>
                        <input type="file" name="discountFile"
                               class="hidden">

                    </div>

                    <div class="mt-8 flex items-center  space-x-reverse space-x-4">
                        <h1 class="font-bold">تخفیف:</h1>
                        <input type="number" min="0" max="100" name="discount"
                               class="w-[50px] p-[3px] text-center outline-none discount">
                        <h1 class="font-bold">درصد</h1>
                    </div>

                </div>
                <div class="w-[49%]">
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
                                <span class="text-min sm:text-sm text-nowrap font-bold">شرح کالاو خدمات</span>
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
                        @foreach($reside->resideItem as $key=> $resideItem)

                            @foreach($resideItem->productResidItem as $index=>$productItem)

                                <tr class=" bg-white">

                                    <td class="border border-gray-400  text-center">
                                        <p class="text-[15px]  sm:text-[13px] p-1 w-full font-bold">
                                            {{$count }}
                                        </p>
                                    </td>
                                    @if($index==0)
                                        <td class="border border-gray-400  text-center  "
                                            rowspan="{{$resideItem->productResidItem->count()}}">
                                            <p class=" text-[15px] sm:text-[13px]  p-1 w-full ">
                                                {{$resideItem->unique_code??''}}
                                            </p>
                                        </td>
                                    @endif
                                    <td class="border border-gray-400  text-center">
                                        <p class="text-[15px]  sm:text-[13px]  p-1 w-full ">
                                            {{$productItem->removeUnderline??''}}
                                        </p>
                                    </td>
                                    <td class="border border-gray-400  text-center">
                                        <p class="  text-[15px] sm:text-[13px] p-1 w-full ">
                                            {{numberFormat(($productItem->price+$resideItem->product->salary)??0)}}
                                        </p>
                                    </td>

                                    @if($index==0)
                                        <td class="border border-gray-300"
                                            rowspan="{{$resideItem->productResidItem->count()}}">
                                            <a class="flex items-center justify-center"
                                               href="{{route('admin.print.capsule',$resideItem)}}">
                                                <img src="{{asset('capsule/images/qrcode.jpeg')}}" alt="">
                                            </a>

                                        </td>
                                    @endif
                                </tr>
                                @php
                                    $count++
                                @endphp
                            @endforeach
                        @endforeach
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class="text-[15px]  sm:text-[13px]  p-1 w-full font-bold">
                                    جمع کل
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="2">
                                <p class="text-[15px]  sm:text-[13px]  p-1 w-full ">
                                    {{numberFormat($reside->totalPrice())??''}}
                                    ریال
                                </p>
                            </td>
                        </tr>
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <div class="text-[15px]  sm:text-[13px]  p-1 w-full ">
                                    <div class="text-[15px]  sm:text-[13px]  p-1 w-full font-bold relative">
                                        <input name="discountChecked" type="checkbox">
                                        <span>تخفیف</span>
                                        <div
                                            class="invisible transition-all absolute z-[101] w-2/3 h-75  top-0 right-[60%] rounded-lg  bg-white shadow-md shadow-black/35 ">
                                            <div
                                                class="flex items-center justify-start space-x-reverse space-x-2 bg-E0E0E0  border-2 border-b-black p-2">
                                                <p class="font-medium">
                                                    تعیین تخفیف برای :
                                                </p>
                                                <span class="font-semibold">
                                                      {{numberFormat($reside->totalPricePlusTax())??''}}
                                                </span>
                                            </div>
                                            <div class="px-1.5 py-2 space-y-5">
                                                <div class="flex items-center space-x-2 space-x-reverse">
                                                    <label class="w-1/4 flex items-center justify-start">بدون
                                                        تخفیف</label>
                                                    <input type="radio" name="disc">
                                                </div>
                                                <div class="flex items-center space-x-2 space-x-reverse">
                                                    <label class="w-1/4 flex items-center justify-start">% قیمت</label>
                                                    <input type="radio" name="disc">
                                                </div>
                                                <div class="flex items-center space-x-2 space-x-reverse">
                                                    <label class="w-1/4 flex items-center justify-start">کسر از
                                                        قیمت</label>
                                                    <input type="radio" name="disc">
                                                </div>
                                                <div class="flex items-center justify-center space-x-4 space-x-reverse text-white ">
                                                    <button type="button" class="px-10 py-1.5 rounded-lg bg-268832 submit">ذخیره</button>
                                                    <button type="button" class="px-10 py-1.5 rounded-lg bg-FF3100 close close-btn-discount">لغو</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="2">
                                <p class="text-[15px] space-x-reverse space-x-2  sm:text-[13px]  p-1 w-full font-bold flex items-center justify-center">
                                    {{numberFormat($reside->totalPricePlusTax())??''}}
                                </p>
                            </td>
                        </tr>
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <div
                                    class="text-[15px] space-x-reverse space-x-2  sm:text-[13px]  p-1 w-full font-bold flex items-center justify-center">
                                    <input name="commission" type="checkbox" value="yes"
                                           @if($reside->commission>0) checked="checked" @endif>
                                    <span>  {{env('Commission')}}%مالیات</span>
                                </div>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="2">
                                <span class="text-[15px]  sm:text-[13px]  p-1 w-full totalPrice"
                                      data-totalPrice="{{$reside->totalPricePlusTax()}}">
                                    {{numberFormat($reside->totalPricePlusTax())??''}}
                                </span>
                            </td>
                        </tr>
                        <tr class=" bg-white">
                            <td class="border border-gray-400  text-center" colspan="3">
                                <p class="text-[15px]  sm:text-[13px]  p-1 w-full font-bold">
                                    جمع کل
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center" colspan="2">
                                <p class="text-[15px]  sm:text-[13px]  p-1 w-full ">
                                    {{numberFormat($reside->totalPricePlusTax())??''}}
                                </p>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <section class="flex items-center justify-center w-full space-x-reverse space-x-3 p-5">
                        <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                            <button class="sodurFactor" type="button">صدور فاکتورنهایی وپرینت</button>
                        </div>
                        <div class="bg-2081F2 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                            <button>صدور فاکتور</button>
                        </div>
                    </section>
                </div>

            </form>


        </article>

    </section>

@endsection
@section('content-blur')
    <section class="absolute top-0 right-0 bg-black/65 w-full h-full transition-all hiddenLayer final-tide ">

    </section>
@endsection

@section('script')
    <script>
        // function generateQrCode() {
        //     let qrCodeElement = document.querySelectorAll('.qrcode');
        //     let count = 0;
        //     let color = '';
        //     for (const imgQr of qrCodeElement) {
        //         if (count % 2 === 0) {
        //             color = '#ffffff';
        //         } else {
        //             color = '#e5e7eb';
        //         }
        //         count += 1;
        //         QRCode.toCanvas(imgQr, imgQr.dataset.product, {
        //             color: {
        //                 dark: '#000000',
        //                 light: color,
        //
        //             }
        //         });
        //
        //     }
        // }
        //
        // generateQrCode();
    </script>


    <script>
        let darkLayer=document.querySelector('.final-tide');
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
        let totalPrice = "{{$reside->totalPrice()}}";
        let price = 0;
        commission = Number(commission);
        totalPrice = Number(totalPrice);
        inputCommission.addEventListener('change', function (event) {
            if (event.target.checked) {
                commissionAmount = ((totalPrice * commission) / 100) + totalPrice;
            } else {
                commissionAmount = totalPrice;
            }
            document.querySelector('.totalPrice').setAttribute('data-totalPrice', commissionAmount);

            price = new Intl.NumberFormat('fa-IR', {
                // style: 'currency',
                currency: 'IRR'
            }).format(commissionAmount);

            document.querySelector('.totalPrice').innerText = price;
            document.querySelector('.totalPrice').innerText += ' ریال ';
        })
    </script>
    <script>

        let inputDiscount = document.querySelector('.discount');
        inputDiscount.addEventListener('input', discount);

        function discount(event) {
            let totalPrice = document.querySelector('.totalPrice').dataset.totalprice

            if (event.target.value > 0 && event.target.value <= 100) {
                let discount = ((event.target.value * totalPrice) / 100);
                discount = totalPrice - discount;
                price = new Intl.NumberFormat('fa-IR', {
                    // style: 'currency',
                    currency: 'IRR'
                }).format(discount);
                document.querySelector('.totalPrice').innerText = price;
                document.querySelector('.totalPrice').innerText += ' ریال ';

            } else {
                price = new Intl.NumberFormat('fa-IR', {
                    style: 'currency',
                    currency: 'IRR'
                }).format(totalPrice);
                document.querySelector('.totalPrice').innerText = price;
            }
        }
    </script>
    <script>

        let closeBtnDisc=document.querySelector('.close-btn-discount');
        let checkBoxDiscount=document.querySelector('input[name="discountChecked"]');
        let disCountBox=''
        checkBoxDiscount.addEventListener('change',function (e){
             disCountBox =e.target.nextElementSibling.nextElementSibling;

            if (e.target.checked)
            {
                darkLayer.classList.remove('hiddenLayer');
                darkLayer.classList.add('shownLayer');
                disCountBox.classList.add('visible');
                disCountBox.classList.remove('invisible')
            }
            else {
                darkLayer.classList.remove('showLayer');
                darkLayer.classList.add('hiddenLayer');
            }
        })
        closeBtnDisc.addEventListener('click',function (){
            darkLayer.classList.remove('showLayer');
            darkLayer.classList.add('hiddenLayer');

            disCountBox.classList.remove('visible');

            disCountBox.classList.add('invisible')
            checkBoxDiscount.checked=false
        })
    </script>
@endsection
