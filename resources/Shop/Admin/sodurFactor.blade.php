@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-3 relative">
        <article class="space-y-5 bg-F1F1F1 p-3 ">

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
                    <span class="text-sm sm:tetx-base">1403/12/20</span>
                </div>
            </article>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex justify-between items-center">
                <div class="flex items-center space-x-reverse space-x-2">
                    <img src="{{asset("capsule/images/plus.svg")}}" alt="" class="plus cursor-pointer">
                    <h1 class="font-medium w-44">اقلام فاکتور</h1>
                </div>
                <div class="flex items-center space-x-reverse space-x-2">
                    <h1 class="font-bold text-sm sm:tetx-base">شماره فاکتور:</h1>
                    <span class="text-sm sm:tetx-base">12587</span>
                </div>
            </article>
            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>سفارش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>تعداد</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span class="text-min sm:text-sm text-nowrap">قیمت واحد</span>
                            <span class="text-[11px]">(ریال)</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span class="text-min sm:text-sm text-nowrap">قیمت کل</span>
                            <span class="text-[11px]">(ریال)</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                شارژ کپسول 2 کیلوئی
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                3،250،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full  ">
                                6،500،000

                            </p>
                        </td>


                    </tr>
                    <tr>

                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                2
                            </p>
                        </td>
                        <td colspan="2" class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                جمع کل :19،500،000
                            </p>
                        </td>


                    </tr>

                    </tbody>
                </table>
                <section class="flex items-center justify-center space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور فاکتورنهایی</button>
                    </div>
                    <div class="bg-2081F2 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button>صدور و پرینت</button>
                    </div>
                </section>
            </form>


        </article>

        <article class="circle-page invisible  absolute w-full h-full top-0 bg-black/65 ">
            <div
                class="absolute  top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] shadow bg-white p-2 rounded-md w-11/12">
                <div class="flex items-center justify-between">
                    <h1 class="p-1 font-bold">
                        لیست کالاها و خدمات :
                    </h1>
                    <img src="{{asset("capsule/images/close.svg")}}" alt="" class="close-page">
                </div>
                <div class="flex items-center justify-between">
                    <h1 class="p-1 font-bold">
                        نام کالا و خدمات :
                    </h1>
                    <select class="search-tags w-2/3" multiple="multiple">
                        <option value="hossein" data-price="170000">hossein</option>
                        <option value="satia" data-price="170000">satia</option>
                        <option value="test" data-price="170000">test</option>
                        <option value="mashin" data-price="170000">mashin</option>


                    </select>

                </div>
                <div class="flex items-center justify-between mt-5">
                    <table class="border-collapse  border border-gray-400 w-full table-fixed">
                        <thead class="bg-2081F2">
                        <tr>
                            <th class=" text-sm font-light px-2 leading-6 text-white ">
                                <span> سفارش</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                                <span>تعداد</span>
                            </th>
                            <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                                <span>قیمت کل (ریال)</span>
                            </th>

                        </tr>

                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>


                </div>
                <section class="flex items-center  space-x-reverse space-x-3 p-5">
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button class="cursor-pointer px-4" onclick="changeInput()">اضافه کردن موارد انتخاب شده</button>
                    </div>
                    <div class="bg-268832 px-2 text-sm font-medium shadow py-1 text-white  rounded-md">
                        <button class="cursor-pointer px-4" onclick="changeInput()">ذخیره</button>
                    </div>

                </section>
            </div>


        </article>
    </section>

@endsection
@section('script')

    <script>
        let plusBtn = document.querySelector('.plus');
        let closePage = document.querySelector('.close-page');
        let circle = document.querySelector('.circle-page');
        let elementAppend = [];

        plusBtn.onclick = function () {

            circle.style.clipPath = `circle(100% at center)`;
            // circle.style.zIndex=`11`;
            circle.style.visibility = `visible`;
        }
        closePage.onclick = function () {
            circle.style.webkitClipPath = 'circle(50px at center)';
            circle.style.visibility = `hidden`;

        }
        let tagValue = [];
        $(".search-tags").select2({
            tags: true,

        })


        function changeInput() {
            let tbody = document.getElementById('tbody');
            // tbody.innerHTML = '';
            let dataAll = $('.search-tags').select2('data');
            for (const data of dataAll) {
                if (!elementAppend.includes(data.id)) {
                    let row = document.createElement('tr')
                    let tdOne = document.createElement('td');
                    tdOne.classList.add("border", 'border-gray-400', 'text-center', 'p-1');
                    tdOne.classList.add("border");
                    tdOne.classList.add("border");
                    tdOne.classList.add("border");

                    tdOne.innerHTML = `
                                 <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                    ${data.id}
                                </p>`;
                    let tdTwo = document.createElement('td');

                    tdTwo.classList.add('border', 'border-gray-400', 'text-center', 'p-1')
                    tdTwo.innerHTML = `<div class=" flex items-center justify-center space-x-reverse space-x-1">
                                    <img src="{{asset('capsule/images/plus.svg')}}" alt=""
                                         class="w-[10px] h-[10px] text-center sm:w-5 sm:h-5 cursor-pointer plus">
                                    <input type="number" min="1" value="1"
                                           class="text-center w-full border rounded-md border-2 border-black/40 w-[27px] sm:w-5/6">
                                    <img src="{{asset('capsule/images/circle-minus.svg')}}" alt=""
                                         class="w-[10px] h-[10px] sm:w-5 sm:h-5 cursor-pointer minus">
                                </div>`;
                    let tdThree = document.createElement('td');

                    tdThree.classList.add("border", 'border-gray-400', 'text-center', 'p-1');
                    tdThree.innerHTML = `
                                <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                    ${data.element.getAttribute("data-price")}
                                </p>`;
                    row.append(tdOne);
                    row.append(tdTwo);
                    row.append(tdThree);
                    tbody.append(row);
                    elementAppend.push(data.id);
                    let minusBtn = document.getElementsByClassName('minus');
                    let plusBtn = document.getElementsByClassName('plus');

                    for (const minus of minusBtn) {
                        minus.onclick = function () {
                            if (minus.previousElementSibling.value > 1) {
                                minus.previousElementSibling.value = +minus.previousElementSibling.value - 1;
                            }
                        }
                    }
                    for (const plus of plusBtn) {
                        plus.onclick = function () {
                            plus.nextElementSibling.value = +plus.nextElementSibling.value + 1;

                        }
                    }
                }


            }

        }


    </script>
@endsection
