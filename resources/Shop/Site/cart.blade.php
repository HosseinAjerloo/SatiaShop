@extends('Site.Layout.master')

@section('content')

    <section class="px-4 flex space-y-3 lg:space-y-0 flex-wrap lg:space-x-5 lg:space-x-reverse justify-center ">
        <article class="w-full lg:w-[50%] px-4 rounded-lg shadow-md border border-gray-300">
            <div class="flex items-center py-3 px-2 space-x-2 space-x-reverse">
                <h1 class="text-lg font-bold">سبدخرید شما</h1>
                <p class="text-sm">
                    <span>2</span>عددکالا
                </p>
            </div>

            <section class="flex flex-wrap ">
                <article
                    class="flex flex-wrap  items-center border-dashed border-black border-2 rounded-lg w-full mb-5 ">
                    <div class="w-full sm:w-[49%] flex items-center justify-center rounded-lg">
                        <img src="{{asset('capsule/images/clock.jpg')}}" alt="" class="w-64 h-64 object-contain">
                    </div>
                    <div class="px-4 py-1.5 rounded-lg w-full sm:w-[49%]">
                        <h1 class="text-sm  leading-6   ">
                            پاوربانک انرجایزر مدل UE10049PQ ظرفیت 10000 میلی آمپرساعت توان 22.5 وات
                        </h1>
                        <div class=" flex-col flex   ">
                            <div class=" text-min text-green-600 font-bold flex justify-between items-center ">
                                <span>قیمت هرواحد:</span>
                                <span>15000000ریال</span>
                            </div>
                        </div>

                        <div class="m-3 p-2 flex items-center justify-between shadow-equalTo rounded-md">
                            <img src="{{asset('capsule/images/add.svg')}}" alt="" class="bg-2081F2 w-5 h-5 p-1">
                            <div>
                                1
                            </div>
                            <img src="{{asset('capsule/images/test.svg')}}" alt="" class="bg-2081F2 w-5 h-5 p-1">
                        </div>
                    </div>
                </article>

            </section>

        </article>
        <article class="w-full lg:w-[24%] rounded-lg h-96 shadow-md border border-gray-300 ">
            <div class="py-3 flex items-center justify-center">
                <p class="font-bold text-lg">
                    صورت حساب
                </p>
            </div>
        </article>
    </section>

@endsection
