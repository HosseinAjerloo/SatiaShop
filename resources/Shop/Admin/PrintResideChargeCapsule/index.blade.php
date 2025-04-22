@extends('Admin.Layout.master')
@section('header')
    <style>
        @page  {
            size: A4;
        }
        @media print {
            .redirect-back{
                display: none;
            }
            .cpasule-count{
                font-size: 12px;
                font-weight: bold;
            }

        }
    </style>

@endsection
@section('content')

    <section class=" space-y-6  px-2 md:w-2/3 md:mx-auto print">

        <article class="space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <article class="flex justify-center items-center w-full">
                <h1>بسمه تعالی</h1>

            </article>

            <table class="border-collapse  border border-gray-400 w-full table-fixed">
                <thead class="bg-F1F1F1">
                <tr>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6  text-black font-semibold ">
                        <span>ردیف</span>
                    </th>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6  text-black font-semibold ">
                        <span>نوع سفارش</span>
                    </th>

                    <th class="border border-gray-400 text-sm font-light px-2 leading-6 text-black font-semibold max-w-max">
                        <span>وضعیت کپسول</span>
                    </th>
                    <th class="border border-gray-400 text-sm font-light px-2 leading-6 text-black font-semibold max-w-max">
                        <span>توضیحات </span>
                    </th>


                </tr>

                </thead>
                <tbody>
                @foreach($reside->resideItem as $key=>$resideItem)
                    <tr>
                        <td class="border border-gray-400 text-center  p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full">
                                {{$key+1}}
                            </p>
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                {{$resideItem->product->removeUnderline??''}}
                            </p>
                        </td>

                        <td class="border border-gray-400 text-center p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                {{$resideItem->getStatusItem()}}
                            </p>
                        </td>
                        <td class="border border-gray-400 text-center p-1">
                            <p class=" sm:font-normal sm:text-sm text-[10px] p-1 w-full ">
                                {{$resideItem->description??''}}
                            </p>
                        </td>

                    </tr>
                @endforeach
                <tr>
                    <td class="border border-gray-400 text-center  p-1" rowspan="3">
                        <div class="flex items-center space-x-reverse space-x-3 p-1">
                            <h1 class="text-gray-700 font-bold text-base">مجموع :</h1>
                            <p class="cpasule-count">{{$reside->resideItem->count()}} عدد کپسول</p>
                        </div>
                    </td>


                </tr>


                </tbody>
            </table>


            <div>
                <article class="flex items-center justify-between text-sm p-4">
                    <div class="flex items-center justify-between flex-col">
                        <p class="font-semibold">تحویل گیرنده:</p>
                        <p class="text-min">{{$reside->operator->fullName}}</p>
                    </div>
                    <div class="flex items-center justify-between flex-col">
                        <p class="font-semibold">تحویل دهنده:</p>
                        <p class="text-min">{{$reside->user->fullName}}</p>
                    </div>
                </article>
            </div>

        </article>
        <section class="flex items-center  space-x-reverse space-x-3 redirect-back">
            <div class="bg-FF3100 px-4 text-sm font-medium shadow py-1 text-white  rounded-md">
                <a>بازگشت</a>
            </div>

        </section>
    </section>

@endsection
@section('script')

    <script>
        window.addEventListener('load', function () {
            window.print();
        })
    </script>
@endsection
