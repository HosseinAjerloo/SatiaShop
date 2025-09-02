@extends('Admin.Layout.master')

@section('content')

    <section class=" space-y-6 ">

        <article class="px-3 space-y-1.5">
            <div class="flex items-center space-x-reverse space-x-2">
                <img src="{{asset('capsule/images/charging-operation-desc.svg')}}" alt="">
                <h2 class="font-bold">لیست کپسول های در انتظار شارژ</h2>
            </div>
            <p class="mr-8 font-thin">
                در صورت انجام عملیات شارژ ، کپسول از لیست زیر <span class="text-red-700">حذف</span> می شود
            </p>
        </article>
        <article class="space-y-5 bg-F1F1F1 p-3 ">

            <form action="" method="post" class="w-full">
                @csrf

                <table class="border-collapse  border border-gray-400 w-full table-fixed">
                    <thead class="bg-2081F2">
                    <tr>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>ردیف</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white ">
                            <span>کدیکتا</span>
                        </th>

                        <th class=" text-sm font-light px-2 leading-6 text-white text-nowrap max-w-max">
                            <span>نام مشتری/سازمان</span>
                        </th>
                        <th class=" text-sm font-light px-2 leading-6 text-white max-w-max">
                            <span>عملیات شارژ</span>
                        </th>

                    </tr>

                    </thead>
                    <tbody id="tbody">

                    <tr class="bg-white ">
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center  ">
                                <div class="w-full flex items-center ">
                                    <input type="text"
                                           class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                           disabled>
                                </div>
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="customer_name">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       data-name="reside_type">
                            </div>
                        </td>
                        <td class="border border-gray-400   text-center p-1">
                            <div class="w-full flex items-center ">
                                <input type="text"
                                       class="w-full border border-black/60 outline-none rounded-md  text-min text-center py-1"
                                       disabled>
                            </div>
                        </td>




                    </tr>
                    @foreach($resideItems as  $resideItem)
                        <tr class="@if( $resideItems->firstItem() + $loop->index%2==0) bg-white @else bg-gray-200/70 @endif">
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{ $resideItems->firstItem() + $loop->index}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                  {{$resideItem->unique_code}}
                                </p>
                            </td>
                            <td class="border border-gray-400  text-center  p-1">
                                <p class="sm:font-normal sm:text-sm text-[13px] p-1 w-full ">
                                    {{$resideItem->reside->user->fullName??''}}

                                </p>
                            </td>
                            <td class="border border-gray-400 flex items-center justify-center cursor-pointer text-center  p-1">
                                <a href="{{route('admin.invoice.issuance.operation', [$resideItem->reside,$resideItem])}}">
                                    <img src="{{asset('capsule/images/activecharging.svg')}}" alt="" class="w-10 border-none">

                                </a>
                            </td>


                    @endforeach


                    </tbody>
                </table>

            </form>


        </article>
        <x-paginate :items="$resideItems"/>
    </section>

@endsection
@section('script')

@endsection
