@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">
        <article class="space-y-5 bg-F1F1F1 p-3 ">
            <article class="flex items-center space-x-reverse space-x-2">
                <a href="{{route('admin.chargingTheCapsule.index')}}">
                    <img src="{{asset('capsule/images/plus.svg')}}" alt="">
                </a>
                <h1 class="font-semibold w-44">رسیدهای کپسول</h1>
            </article>
            <form action="{{route('hossein.back')}}" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>تاریخ</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>نام مشتری</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>تعداد کپسول</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>شماره رسید</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>صدور فاکتور</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>نام پذیرنده</span>
                        </th>
                    </tr>

                    </thead>
                    <tbody>

                    <tr class="bg-white ">
                        <td class="border border-gray-400  text-center  p-1">
                            <div class="w-full flex items-center  justify-center">
                                <img src="{{asset('capsule/images/searchIcon.svg')}}" alt="" class="w-5 h-5">

                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center  ">
                                <img src="{{asset('capsule/images/date.svg')}}" alt="" class="w-5 h-5 sm:w-7 sm:h-7">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md startDate text-min text-center py-1 sm:w-4/5 mr-[2px] sm:mr-[15px]">
                                <input type="hidden" id="startDate">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center ">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       disabled>
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1">
                            </div>
                        </td>

                    </tr>
                    @foreach($resides as $key=> $reside)
                        <tr class="@if($key%2==0) bg-white @else bg-gray-200/70 @endif">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$key+1}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{\Morilog\Jalali\Jalalian::forge($reside->created_at)->format('H:i:s Y/m/d')}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    {{$reside->user->fullName??''}}

                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    {{$reside->resideItem()->count()}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-700 text-sky-600">
                                    {{$reside->id}}
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center ">
                                <div class="w-full flex items-center justify-center p-1">
                                    <img src="{{asset("capsule/images/hand-Invoice.svg")}}" alt="" class="w-10 h-10">
                                </div>
                            </td>
                            <td class="border border-gray-400   text-center ">
                                <div class="w-full flex items-center justify-center p-1">
                                    {{$reside->operator->fullName??''}}
                                </div>
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </form>


        </article>

    </section>

@endsection
@section('script')

    <script>
        let firstTrTbodyTable = document.querySelector('table tbody tr:first-child');
        let allInputs = firstTrTbodyTable.querySelectorAll('input');
        let getDate = firstTrTbodyTable.querySelector('input[type="hidden"]');


        for (const input of allInputs)
        {
                input.addEventListener('change',function (){
                    alert('hossein ajerloo')
                })
        }


    </script>
@endsection
