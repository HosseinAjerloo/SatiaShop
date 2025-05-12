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
                            <span>نام نقش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>نام الگوی دسترسی</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>ویرایش</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>حذف</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody id="tbody">
                @foreach($roles as $role)
                        <tr class=" bg-gray-200/70 ">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                  1
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                   date
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full  ">
                                    fulname
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full flex items-center justify-center ">
                                    <img src="{{asset('capsule/images/pen.svg')}}" alt="">
                                </p>
                            </td>
                            <td class="border border-gray-400   text-center p-1">
                                <p class="sm:font-normal flex items-center justify-center sm:text-sm text-[13px] p-1 w-full underline underline-sky-500 underline-offset-4 decoration-sky-500 text-sky-600">
                                    <img src="{{asset('capsule/images/delete.svg')}}" alt="">
                                </p>
                            </td>


                        </tr>
                @endforeach

                    </tbody>
                </table>

            </form>


        </article>

    </section>



@endsection
