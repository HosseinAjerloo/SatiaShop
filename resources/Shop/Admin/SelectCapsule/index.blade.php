@extends('Admin.Layout.master')
@section('content')
    <section class=" space-y-3 relative w-4/5 mx-auto test">
        <article class="space-y-5 bg-F1F1F1 p-6 rounded-md">

            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2 w-1/2">
                    <img src="{{asset("capsule/images/blue-user.svg")}}" alt="">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <h1 class="font-bold text-sm sm:tetx-base">نام مشتری:</h1>
                        <span class="text-sm sm:tetx-base">{{$reside->user->fullName}}</span>
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

            <form action="{{route('admin.invoice.issuance.storeProductItem',[$reside,$resideItem])}}" method="post"
                  class="w-full" id="form">
                @csrf
                @if( isset($resideItem->product->relatedGoods->id))

                    <section class="space-y-5">
                        <div>
                            <h1 class="text-rose-600  font-black">{{$resideItem->product->removeUnderline}}</h1>
                        </div>
                        <article class=" w-full flex flex-col justify-center md:w-3/4 lg:w-3/5 xl:w-[50%] space-y-4">


                            @foreach($resideItem->product->relatedGoods->productes as $product)
                                <div data-value="value"
                                     class=" flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-start space-y-2 space-x-reverse space-x-2 sm:space-y-0">
                                    <label
                                        class=" font-semibold text-sm w-[30%] leading-6">{{$product->removeUnderline}}
                                        :</label>

                                    <div
                                        class="flex  justify-between items-center space-x-4 space-x-reverse w-[80%] ">
                                        @if($product->unit_of_measurement)
                                            <div class="max-w-max flex items-center justify-center ">
                                                <button
                                                    class="minus flex items-center justify-center font-bold w-[25px] h-[25px] text-white shadow-md shadow-black/35 bg-sky-500 rounded-lg"
                                                    type="button" data-target="target-{{$product->id}}">
                                                    -
                                                </button>
                                            </div>
                                        @endif
                                        <div class="w-full  flex items-center justify-center">
                                            @if($product->unit_of_measurement)
                                                <input id="target-{{$product->id}}"
                                                       name="product_id[id_{{$product->id}}]" type="text"
                                                       readonly
                                                       class="w-full text-center rounded-md border border-black/50 focus:outline-none outline-none"
                                                       value="0">
                                            @else
                                                <select class="select2 w-full " name="product_id[]">
                                                    <option value="" selected="selected">تعویض نشده</option>
                                                    <option value="{{$product->id}}"
                                                            @if(in_array($product->id,$resideItem->productResidItem->pluck('id')->toArray())) selected="selected" @endif>
                                                        تعویض شده
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                        @if($product->unit_of_measurement)
                                            <div
                                                class="max-w-max  flex items-center justify-center space-x-2 space-x-reverse">
                                                <span>{{$product->getUnitOfMeasurement}}</span>
                                                <button
                                                    data-target="target-{{$product->id}}"
                                                    class="increase flex items-center justify-center font-bold w-[25px] h-[25px] text-white shadow-md shadow-black/35 bg-sky-500 rounded-lg"
                                                    type="button">+
                                                </button>

                                            </div>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                            <div data-value="value"
                                 class="flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-start  sm:space-y-0">
                                <label class="font-semibold text-sm  w-[30%]">بالن :</label>
                                <div class="flex justify-center items-center space-x-4 space-x-reverse w-[87%]">
                                    <div class="flex justify-center items-center space-x-4 space-x-reverse w-full">
                                        <select class="select2 w-full" name="balloons">
                                            <option value="">انتخاب کنید</option>
                                            <option value="internal"
                                                    @if($resideItem->balloons=='internal') selected="selected" @endif>
                                                داخلی
                                            </option>
                                            <option value="external"
                                                    @if($resideItem->balloons=='external') selected="selected" @endif>
                                                بغل
                                                دار
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div data-value="value"
                                 class="flex justify-center items-start flex-col sm:flex-row sm:items-center sm:justify-start  sm:space-y-0">
                                <label class="font-semibold text-sm w-[30%]">اجرت (ریال) :</label>
                                <input type="hidden" name="salary" min="0"
                                       value="{{(float)$resideItem->product->salary??0}}">
                                <div class="flex justify-center items-center space-x-4 space-x-reverse w-[80%]">
                                    <p class="w-full  outline-none p-[2.5px] text-center border-black/50 border rounded-[5px]">
                                        {{numberFormat((float)$resideItem->product->salary??0)}}
                                    </p>
                                </div>
                            </div>
                        </article>

                        <article class="flex items-center space-x-reverse space-x-4">
                            <button type="button" class="px-6 py-1 bg-268832 text-white rounded-md save">ذخیره</button>
                            <a href="{{route('panel.admin')}}"
                               class="px-6 py-1 bg-FF3100 text-white rounded-md">بازگشت</a>
                        </article>
                    </section>
                @endif


            </form>


        </article>

    </section>
@endsection
@section('content-blur')
    <section class="fixed top-0 right-0 bg-black/65 w-full h-full transition-all hiddenLayer final-tide ">
        <div
            class=" absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] bg-white info-box w-4/12 rounded-md">
            <div class="h-10 bg-2081F2 flex justify-between items-center p-2 py-3 rounded-md">
                <div class="flex items-center space-x-2 space-x-reverse text-white">
                    <img src="{{asset('capsule/images/logo.svg')}}" alt="">
                    <span class="font-semibold text-md">{{$resideItem->product->removeUnderline}}</span>
                </div>
                <div class="flex items-center space-x-reverse space-x-2 text-white">
                    <h2 class="font-semibold text-md">کدیکتا</h2>
                    <span class="tex-sm font-medium">{{$resideItem->unique_code}}</span>
                </div>
            </div>

            <article class="p-3 space-y-2 ">
                <div class="item-list space-y-3">

                </div>

                <div class="flex items-center space-x-4 space-x-reverse text-white">
                    <button class="px-4 py-1.5 rounded-lg bg-268832 submit">تایید نهایی</button>
                    <button class="px-4 py-1.5 rounded-lg bg-FF3100 close">بستن</button>
                </div>
            </article>

        </div>
    </section>

@endsection
@section('script')
    <script>
        let btnSave = document.querySelector('.save');
        let finalTide = document.querySelector('.final-tide');

        btnSave.addEventListener('click', function (e) {
            e.preventDefault();
            finalTide.classList.remove('hiddenLayer')
            finalTide.classList.add('showLayer')
            let items = document.querySelectorAll("div[data-value='value']");
            let itemList = document.querySelector(".item-list");
            itemList.innerHTML = '';
            items.forEach((item) => {
                let parentDiv = document.createElement("div");
                parentDiv.classList.add('space-x-reverse', 'space-x-4');
                let spanTitle = document.createElement('span');
                spanTitle.classList.add('text-sm', 'font-semibold');
                let spanValue = document.createElement('span');

                if (item.children[1].children[0] && item.children[1].children[0].children[0].nodeName == 'SELECT') {
                    spanTitle.innerText = item.children[0].innerHTML;
                    spanValue.innerText = item.children[1].children[0].children[0].options[item.children[1].children[0].children[0].selectedIndex].text
                } else if (item.children[1].children[1] && item.children[1].children[1].children[0]) {
                    spanTitle.innerText = item.children[0].innerHTML;
                    spanValue.innerText=`${item.children[1].children[1].children[0].value} ${item.children[1].children[2].children[0].innerText}`

                }
                parentDiv.appendChild(spanTitle)
                parentDiv.appendChild(spanValue)
                itemList.append(parentDiv)


            })
        })


        document.querySelector('.close').addEventListener('click', function () {
            finalTide.classList.remove('showLayer')
            finalTide.classList.add('hiddenLayer')
        })
        document.querySelector('.submit').addEventListener('click', function () {
            window.form.submit();
        })

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
                QRCode.toCanvas(imgQr, 'hossein Ajerloo', {
                    width: 50,
                    color: {
                        dark: '#000000',
                        light: color
                    }
                });

            }
        }

        generateQrCode();


        function format(value) {
            price = new Intl.NumberFormat('fa-IR', {

                currency: 'IRR'
            }).format(value);
            return price;
        }
    </script>
    <script>
        const operations = (e, operation) => {
            let input = document.getElementById(e.target.dataset.target);
            let inputValue = input.value;
            let context = `${inputValue} ${operation} 1`;
            let result = eval(context);
            if (result >= 0)
                input.value = result
        }
        const increase = document.querySelectorAll('.increase');
        increase.forEach((elem) => {
            elem.addEventListener('click', (e) => {
                operations(e, '+')
            });
        })
        const minus = document.querySelectorAll('.minus');
        minus.forEach((elem) => {
            elem.addEventListener('click', (e) => {
                operations(e, '-')
            });
        })
    </script>

@endsection
