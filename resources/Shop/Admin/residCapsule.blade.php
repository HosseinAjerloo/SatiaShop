@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex items-center space-x-reverse space-x-2">
                <img src="{{asset('capsule/images/plus.svg')}}" alt="">
                <h1 class="font-semibold w-44">رسیدهای کپسول</h1>
            </article>
            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>تاریخ</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>تحویل دهنده</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>تعداد کپسول</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>صدورفاکتور</span>
                        </th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-400  text-center  p-1">
                            <div class="w-full flex items-center  ">
                                <img src="{{asset('capsule/images/date.svg')}}" alt="" class="w-5 h-5 sm:w-7 sm:h-7">
                                <input type="text" class="w-full border border-black/60 outline-none rounded-md startDate text-min text-center py-1 sm:w-4/5 mr-[2px] sm:mr-[15px]">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text" class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text" class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center justify-center p-1">
                                <img src="{{asset("capsule/images/hand-Invoice.svg")}}" alt="" class="w-8 h-8">
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                1403/12/20
                                09:22
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                حمید کرمیان

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                6

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center justify-center p-1">
                                <img src="{{asset("capsule/images/hand-Invoice.svg")}}" alt="" class="w-8 h-8">
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                1403/12/20
                                09:22
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                حمید کرمیان

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                6

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center justify-center p-1">
                                <img src="{{asset("capsule/images/hand-Invoice.svg")}}" alt="" class="w-8 h-8">
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                1403/12/20
                                09:22
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                حمید کرمیان

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                6

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center justify-center p-1">
                                <img src="{{asset("capsule/images/hand-Invoice.svg")}}" alt="" class="w-8 h-8">
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                1403/12/20
                                09:22
                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                حمید کرمیان

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                6

                            </p>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center justify-center p-1">
                                <img src="{{asset("capsule/images/hand-Invoice.svg")}}" alt="" class="w-8 h-8">
                            </div>
                        </td>

                    </tr>



                    </tbody>
                </table>
             
            </form>


        </article>

    </section>

@endsection
