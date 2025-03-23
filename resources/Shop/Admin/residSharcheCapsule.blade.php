@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3">
            <article class="flex justify-between items-center">
                <h1 class="font-bold w-44">مشخصات مشتری:</h1>
                <div
                    class="border border-black/40 flex items-center space-x-1 space-x-reverse py-1.5 px-2 rounded-md w-3/4">
                    <select type="text"
                            class="placeholder:text-min placeholder:text-black/50 outline-none searchInput bg-transparent w-full select2"
                            name="name" id="input_search">
                        <option>hossein</option>
                    </select>
                    <img src=" {{asset('capsule/images/search.svg')}}" alt="" class="search cursor-pointer">
                </div>
            </article>

            <form action="" class="space-y-5">
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">نام :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نام خانوادگی :</label>
                        <input type="text " class="border-0 w-full rounded-[5px] shadow">
                    </div>
                </section>
                <section class="flex items-center justify-between">
                    <div class="w-[49%] flex  flex-col  space-y-2">
                        <label for="" class="flex items-center font-bold">همراه :</label>
                        <input type="text" class="border-0 w-full rounded-[5px] shadow">
                    </div>
                    <div class="w-[49%] flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">تلفن ثابت :</label>
                        <input type="text " class="border-0 w-full rounded-[5px] shadow">
                    </div>
                </section>
                <section class="flex items-center ">

                    <div class="w-full flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">آدرس :</label>
                        <input type="text " class="border-0 w-full rounded-[5px] shadow">
                    </div>
                </section>
                <section class="flex items-center ">

                    <div class="w-full flex  flex-col space-y-2">
                        <label for="" class="flex items-center font-bold">نام صنف یا شرکت :</label>
                        <input type="text " class="border-0 w-full">
                    </div>
                </section>
            </form>
        </article>

        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex justify-between items-center">
                <h1 class="font-bold w-44">اقلام سفارش:</h1>

            </article>
            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>نوع سفارش</span>
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
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>توضیحات</span>
                        </th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 ">
                            <select name="" id="" class="select2 w-full p-1">
                                <option value="">شارژ250 گرمی</option>
                                <option value="">شارژ250 گرمی</option>
                                <option value="">شارژ250 گرمی</option>
                            </select>
                        </td>
                        <td class="border border-gray-400  text-center p-1">
                            <div class=" flex items-center justify-center space-x-reverse space-x-1">
                                <img src="{{asset('capsule/images/plus.svg')}}" alt="" class="w-[10px] h-[10px] sm:w-5 sm:h-5">
                                <input type="text" class="w-full border rounded-md border-2 border-black/40 w-[27px] sm:w-5/6">
                                <img src="{{asset('capsule/images/circle-minus.svg')}}" alt="" class="w-[10px] h-[10px] sm:w-5 sm:h-5">
                            </div>

                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                6،500،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40 ">
                                13،250،000

                            </p>
                        </td>
                        <td class="border border-gray-400 text-[11.5px]  text-center p-1">
                            <input type="text" class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5" placeholder="توضیحات">
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 ">
                            <select name="" id="" class="select2 w-full p-1">
                                <option value="">شارژ250 گرمی</option>
                                <option value="">شارژ250 گرمی</option>
                                <option value="">شارژ250 گرمی</option>
                            </select>
                        </td>
                        <td class="border border-gray-400  text-center p-1">
                            <div class=" flex items-center justify-center space-x-reverse space-x-1">
                                <img src="{{asset('capsule/images/plus.svg')}}" alt="" class="w-[10px] h-[10px] sm:w-5 sm:h-5">
                                <input type="text" class="w-full border rounded-md border-2 border-black/40 w-[27px] sm:w-5/6">
                                <img src="{{asset('capsule/images/circle-minus.svg')}}" alt="" class="w-[10px] h-[10px] sm:w-5 sm:h-5">
                            </div>

                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                6،500،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40 ">
                                13،250،000

                            </p>
                        </td>
                        <td class="border border-gray-400 text-[11.5px]  text-center p-1">
                            <input type="text" class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5" placeholder="توضیحات">
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 ">
                            <select name="" id="" class="select2 w-full p-1">
                                <option value="">شارژ250 گرمی</option>
                                <option value="">شارژ250 گرمی</option>
                                <option value="">شارژ250 گرمی</option>
                            </select>
                        </td>
                        <td class="border border-gray-400  text-center p-1">
                            <div class=" flex items-center justify-center space-x-reverse space-x-1">
                                <img src="{{asset('capsule/images/plus.svg')}}" alt="" class="w-[10px] h-[10px] sm:w-5 sm:h-5">
                                <input type="text" class="w-full border rounded-md border-2 border-black/40 w-[27px] sm:w-5/6">
                                <img src="{{asset('capsule/images/circle-minus.svg')}}" alt="" class="w-[10px] h-[10px] sm:w-5 sm:h-5">
                            </div>

                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40">
                                6،500،000
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 w-full border rounded-md border-2 border-black/40 ">
                                13،250،000

                            </p>
                        </td>
                        <td class="border border-gray-400 text-[11.5px]  text-center p-1">
                            <input type="text" class="w-full border rounded-md border-2 p-1 border-black/40 outline-none px-1.5" placeholder="توضیحات" name="test">
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-300  text-center p-1 flex items-center justify-center">
                           <div class="bg-green-600 flex items-center justify-center w-11/12 rounded-[5px] p-1.5">
                               <img src="{{asset("capsule/images/add.svg")}}" alt="" class="w-4 h-4">
                           </div>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="font-semibold sm:font-normal sm:text-sm text-[10px] p-1 ">
                                6
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1" colspan="3">
                            <p>
                                 <span class="font-semibold text-sm">قیمت نهایی:</span>
                                <span class="text-min">
                                    19،500،000 ریال
                                </span>
                            </p>
                        </td>


                    </tr>


                    </tbody>
                </table>
            </form>


        </article>

    </section>

@endsection
