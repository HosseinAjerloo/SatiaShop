
@extends('Admin.Layout.master')

@section('content')


    <section class="px-2 mt-5 space-y-12">
        <article class="p-4 flex flex-wrap space-y-6 bg-F1F1F1 rounded-md">
            <div class="flex flex-wrap justify-between items-center w-full space-y-4 sm:space-y-0">
                <div class="flex  items-center sm:justify-start space-x-reverse space-x-2 w-full sm:w-1/3">
                    <img src="{{asset('capsule/images/blueUserIcon.svg')}}" alt="" class="w-6">
                    <h2 class="font-bold ">نام مشتری</h2>
                    <p class="font-thin">حسین آجرلو</p>
                </div>
                <div class="flex  items-center sm:justify-center space-x-reverse space-x-2 w-full sm:w-1/3">

                    <h2 class="font-bold ">نوع کپسول</h2>
                    <p class="font-thin">پودروگاز</p>
                </div>

                <div class="flex  items-center space-x-reverse sm:justify-end space-x-2 w-full sm:w-1/3">
                    <h2 class="font-bold ">تلفن همراه:</h2>
                    <p class="font-thin">09186414452</p>
                </div>
            </div>

            <div class="flex flex-wrap justify-between items-center w-full">
                <div class="flex justify-between items-center space-x-reverse space-x-2">
                    <h2 class="font-bold ">آدرس</h2>
                    <p class="font-thin">اراک رودکی کوچه شهید طاهری پلاک 15</p>
                </div>
                <div class="flex justify-between items-center space-x-reverse space-x-2 mt-2">
                    <a href="" class="px-6 py-2 rounded-lg text-white shadow-lg bg-2081F2 text-min_sm">شارژ جدید</a>
                </div>

            </div>
        </article>


        <article class="p-4 flex flex-wrap space-y-6 bg-F1F1F1 rounded-md">
            <table class="border-collapse  border border-gray-400 w-full table-fixed">
                <thead class="bg-2081F2">
                <tr>
                    <th class=" text-sm font-light px-2 py-2 leading-6 text-white ">
                        <span>ردیف</span>
                    </th>
                    <th class=" text-sm font-light px-2 py-2 leading-6 text-white ">
                        <span>آخرین شارژ</span>
                    </th>
                    <th class=" text-sm font-light px-2 py-2 leading-6 text-white ">
                        <span>نوع عملیات انجام شده</span>
                    </th>
                    <th class=" text-sm font-light px-2 py-2 leading-6 text-white ">
                        <span>شماره رسید</span>
                    </th>
                </tr>

                </thead>
                <tbody id="tbody">

                    @foreach($resideItemHistory as $key=> $residItem)
                    <tr class=" bg-white bg-gray-200/70 ">
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                {{$key +1}}
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                               {{\Morilog\Jalali\Jalalian::forge($residItem->created_at)->format('Y/m/d')}}
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                               {{$residItem->getResideItemProduct()}}
                            </p>
                        </td>
                        <td class="border border-gray-400  text-center  p-1">
                            <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                               {{$residItem->reside_id}}
                            </p>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </article>
    </section>


@endsection

