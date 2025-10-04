@extends('Admin.Layout.master')

@section('content')

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
            <form action="{{route('admin.sale.generate.factor',$reside->id)}}" enctype="multipart/form-data"
                  method="post" class="w-full flex  justify-between flex-wrap" id="form">
                @csrf

                <div class="w-[49%] space-y-3">

                    <div class="bg-white ">
                        <h1 class="font-bold mb-3 bg-F1F1F1 py-1.5">توضیحات تخفیفی</h1>
                        <textarea name="description" id="description"
                                  class="w-full transition-all border-none p-2 py-1.5 outline-none"
                                  rows="3"></textarea>
                        <div class="flex items-center flex-wrap space-x-reverse space-x-2 image-location">

                            @foreach($reside->file as $file)
                                <a href="{{route('admin.resideCapsule.download',[$reside,$file])}}"
                                   class="relative p-2 transition-all">
                                    <img class="w-32 object-contain" data-click="no_click" src="{{asset($file->path)}}"
                                         alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-8 flex items-center  space-x-reverse space-x-4">
                        <h1 class="font-bold">فایل ضمیمه:</h1>
                        <div class="bg-white p-2 rounded-md flex items-center justify-between w-2/5	">
                            <img src="{{asset('capsule/images/uploadFile.svg')}}" alt="">
                            <span class="text-gray-400/75 file-counter">فایلی موجود نمیباشد</span>
                            <button class="bg-2081F2 text-white rounded-lg text-white p-2 btn-file" type="button">انتخاب
                                کنید
                            </button>
                        </div>


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
                                        {{$resideItem->product->getUnitOfMeasurement??''}}
                                    </p>
                                </td>

                                <td class="border border-gray-400  text-center">
                                    <p class="  text-[15px] sm:text-[13px] p-1 w-full ">
                                        {{numberFormat($resideItem->price)??0}}
                                    </p>
                                </td>
                                <td class="border border-gray-300">
                                    <p class="flex items-center justify-center"
                                       href="{{route('admin.print.capsule',$resideItem)}}">
                                        <img src="{{asset('capsule/images/qrcode.jpeg')}}" alt="">
                                    </p>

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
                                        <input name="discountChecked" type="checkbox"
                                               @if($reside->isDiscount()) checked="checked" @endif>
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
                                                               class="border w-[50px] rounded-md p-[3px] text-center outline-none discount"
                                                               value="{{$reside->discount_collection >0?$reside->discount_collection:null}}">
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
                                                               class="w-3/5	 border  rounded-md p-[3px] text-center outline-none discount"
                                                               value="{{$reside->discount_price>0?$reside->discount_price:null}}>
                                                        <h1 class=" font-bold">ریال مبلغ</h1>
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
                                    {{numberFormat($reside->total_price)??''}}
                                    ریال
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
                            <td class="border border-gray-400  text-center" colspan="3">
                                <span class="totalPricePlusTax text-[15px]  sm:text-[13px]  p-1 w-full "
                                >
                                    {{numberFormat($reside->totalPrice())??''}}
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
                                    {{numberFormat($reside->final_price)??''}}

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
    <section
        class="fixed top-0 bottom-0 left-0 right-0 bg-black/65 w-full h-full transition-all hiddenLayer final-tide ">

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

        let btnFile = document.querySelector('.btn-file');
        const removeImageLocation = () => {
            let imageLocation = document.querySelector('.image-location');
            for (const childLocation of imageLocation.children) {
                if (!childLocation.children[0].dataset.click) {

                    childLocation.children[0].addEventListener('click', function (e) {
                        childLocation.style.transform = `scale(0)`;
                        document.querySelector(`input[data-file=${e.target.dataset.file}]`).remove();
                        childLocation.addEventListener('transitionend', function () {
                            childLocation.remove();
                        });
                    })
                }

            }

        }
        removeImageLocation();
        const addImageLocation = (src, datasetValue) => {
            let imageLocation = document.querySelector('.image-location');
            let childLocation = document.createElement('div');
            childLocation.classList.add('relative', 'p-2', 'transition-all')
            let ImageLocationImgRemove = document.createElement('img');
            ImageLocationImgRemove.dataset.file = datasetValue;
            ImageLocationImgRemove.setAttribute('src', "{{asset('capsule/images/delete.svg')}}");
            ImageLocationImgRemove.classList.add('absolute', 'left-0', 'top-0', 'bg-white', 'rounded-50%', 'cursor-pointer');

            let imageFile = document.createElement('img');
            imageFile.classList.add('w-32', 'object-contain')
            imageFile.setAttribute('src', src);
            childLocation.append(ImageLocationImgRemove);
            childLocation.append(imageFile);
            imageLocation.append(childLocation)

        }
        let fileCount = 0;
        btnFile.onclick = () => {
            let file = document.createElement('input');
            // <input type="file" name="discountFile[]"
            //        class="hidden" multiple>
            file.setAttribute('name', 'discountFile[]');
            file.setAttribute('type', 'file');

            file.dataset.file = `file-${fileCount}`
            file.classList.add("hidden")
            window.form.appendChild(file);
            file.click()
            file.addEventListener('change', function (e) {
                let type = e.target.files[0].type;
                if (e.target.files[0] && type) {
                    type = type.split('/')[0];
                    if (type == 'image') {
                        addImageLocation(URL.createObjectURL(e.target.files[0]), `file-${fileCount}`);
                        removeImageLocation();
                        fileCount++;
                        document.querySelector('.file-counter').innerHTML = fileCount + ' فایل انتخاب شده است '
                    }

                }
            })

        }


    </script>
    <script>
        let darkLayer = document.querySelector('.final-tide');
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
        let totalPrice = Number("{{$reside->total_price}}");
        let finalPrice = totalPrice;
        let inputDiscounts = document.querySelectorAll('.discount');
        let showDiscount = document.querySelector('.showDiscount');
        const event = new Event('input', {bubbles: true});
        const eventChange = new Event('change', {bubbles: true});

        inputDiscounts.forEach((input) => {
            input.addEventListener('input', discount);
            if (input.value > 0)
                input.dispatchEvent(event);
        })


        function discount(event) {
            if (event.target.value > 0) {
                if (event.target.getAttribute('name') === 'discountDecimal' && event.target.value <= 100) {
                    document.querySelector('input[name="discount_price"]').value = '';
                    discountDecimal(event)
                } else if (event.target.getAttribute('name') === 'discount_price' && event.target.value <= totalPrice) {
                    document.querySelector('input[name="discountDecimal"]').value = '';
                    discountPrice(event)
                } else {
                    removeAllDiscount()
                }
                inputCommission.dispatchEvent(eventChange)
            } else {

                finalPrice = totalPrice;
                price = new Intl.NumberFormat('fa-IR', {}).format(finalPrice);

                document.querySelector('.totalPriceDiscount').innerText = price + " ریال";
                document.querySelector('.totalPricePlusTax').innerText = price + " ریال";
                document.querySelector('.final-price').innerText = price + " ریال";
            }

        }

        function discountDecimal(event) {
            if (event.target.value > 0 && event.target.value <= 100) {
                let discount = ((event.target.value * totalPrice) / 100);
                discount = totalPrice - discount;
                finalPrice = discount;
                price = new Intl.NumberFormat('fa-IR', {
                    // style: 'currency',
                    currency: 'IRR'
                }).format(discount);
                document.querySelector('.totalPriceDiscount').innerText = price;
                document.querySelector('.totalPriceDiscount').innerText += ' ریال ';
                document.querySelector('.totalPricePlusTax').innerText = price;
                document.querySelector('.totalPricePlusTax').innerText += ' ریال ';
                document.querySelector('.final-price').innerText = price;
                document.querySelector('.final-price').innerText += ' ریال ';
                showDiscount.innerText = "(%" + numberToPersian(event.target.value) + ')';

            }


        }

        function discountPrice(event) {
            let discount = totalPrice - event.target.value;
            finalPrice = discount;
            price = new Intl.NumberFormat('fa-IR', {
                // style: 'currency',
                currency: 'IRR'
            }).format(discount);
            document.querySelector('.totalPriceDiscount').innerText = price;
            document.querySelector('.totalPriceDiscount').innerText += ' ریال ';
            document.querySelector('.totalPricePlusTax').innerText = price;
            document.querySelector('.totalPricePlusTax').innerText += ' ریال ';
            document.querySelector('.final-price').innerText = price;
            document.querySelector('.final-price').innerText += ' ریال ';
            showDiscount.innerText = "(%" + numberToPersian(event.target.value) + ')';

        }

        function removeAllDiscount() {
            inputDiscounts.forEach((input) => {
                input.value = ''
                input.dispatchEvent(event)
            })
            showDiscount.innerText = 0;

        }
    </script>



    <script>
        let inputCommission = document.querySelector('input[name="commission"]');
        let commissionAmount = 0;
        let commission = Number("{{env('Commission')}}");
        let price = 0;
        inputCommission.addEventListener('change', function (event) {
            finalPrice = Number(finalPrice);
            if (event.target.checked) {
                commissionAmount = ((finalPrice * commission) / 100) + finalPrice;
            } else {
                commissionAmount = finalPrice;
            }

            price = new Intl.NumberFormat('fa-IR', {
                // style: 'currency',
                currency: 'IRR'
            }).format(commissionAmount);

            document.querySelector('.totalPricePlusTax').innerText = price;
            document.querySelector('.totalPricePlusTax').innerText += ' ریال ';
            document.querySelector('.final-price').innerText = price + " ریال";

        })
        inputCommission.dispatchEvent(eventChange)

    </script>

    <script>

        let discRadio = document.querySelectorAll('input[name="disc"]');
        discRadio.forEach((radio) => {
            if (radio.nextElementSibling) {
                radio.nextElementSibling.classList.contains('invisible') ? '' : radio.nextElementSibling.classList.add('invisible')
            }
            radio.addEventListener('change', function (e) {

                discRadio.forEach((radio) => {
                    if (radio.nextElementSibling) {
                        radio.nextElementSibling.classList.contains('invisible') ? '' : radio.nextElementSibling.classList.add('invisible')
                    }
                })
                if (e.target.nextElementSibling) {
                    e.target.nextElementSibling.classList.toggle('invisible')
                }
            })
        })
        let closeBtnDisc = document.querySelector('.close-btn-discount');
        let submitDiscount = document.querySelector('.submit-discount');
        let checkBoxDiscount = document.querySelector('input[name="discountChecked"]');
        let disCountBox = ''
        checkBoxDiscount.addEventListener('change', function (e) {
            disCountBox = e.target.nextElementSibling.nextElementSibling;

            if (e.target.checked) {
                darkLayer.classList.remove('hiddenLayer');
                darkLayer.classList.add('shownLayer');
                disCountBox.classList.add('visible');
                disCountBox.classList.remove('invisible')
            } else {
                darkLayer.classList.remove('showLayer');
                darkLayer.classList.add('hiddenLayer');
                removeAllDiscount();
                inputCommission.dispatchEvent(eventChange)
            }
        })


        closeBtnDisc.addEventListener('click', () => {
            closeDiscountBox(true);
        })

        submitDiscount.onclick = function () {
            closeDiscountBox(false)
        }
        const closeDiscountBox = (checked = false) => {
            darkLayer.classList.remove('showLayer');
            darkLayer.classList.add('hiddenLayer');

            disCountBox.classList.remove('visible');

            disCountBox.classList.add('invisible')
            if (checked) {
                checkBoxDiscount.checked = false;
                removeAllDiscount()
                inputCommission.dispatchEvent(eventChange)
            }


        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let description = document.getElementById('description');

            description.addEventListener('input', function () {
                autoResize(description)
            })


        })
        const autoResize = (e) => {
            e.style.height = 'auto';
            e.style.height = e.scrollHeight + 'px';
        };

    </script>
@endsection
