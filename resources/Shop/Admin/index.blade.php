@extends('Admin.Layout.master')

@section('content')

    <section class="px-3 space-y-5">
        <section class="flex items-center justify-between ">
            <a href="{{route('admin.category.index')}}"
               class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset('capsule/images/category.jpg')}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        دسته بندی ها
                    </p>
                </div>
            </a>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/product.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        کالاهها
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/service.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        خدمات
                    </p>
                </div>
            </div>

        </section>
        <section class="flex items-center justify-between ">
            <a href="{{route('admin.menu.index')}}"
               class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/menu.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        منو
                    </p>
                </div>
            </a>
            <a href="{{route('admin.setting.index')}}"
               class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset('capsule/images/logo.png')}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        لگو و نام نرم افزار
                    </p>
                </div>
            </a>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset('capsule/images/order.png')}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        سفارشات
                    </p>
                </div>
            </div>

        </section>
        <section class="flex items-center justify-between ">
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/invoice.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        سفارشات
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/payment.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        پرداخت ها
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/user.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        کاربران
                    </p>
                </div>
            </div>

        </section>
        <section class="flex items-center justify-between ">
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/discount.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        کدتخفیف
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/sms.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        پیامک
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset('capsule/images/productTransaction.png')}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        گردش کالا
                    </p>
                </div>
            </div>

        </section>
        <section class="flex items-center justify-between ">
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset('capsule/images/bank.png')}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        بانک
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/supplier.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        تامین کنندگان
                    </p>
                </div>
            </div>
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/ticket.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        تیکت ها
                    </p>
                </div>
            </div>

        </section>
        <section class="flex items-center justify-between ">
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/financeTransaction.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        معین اشخاص
                    </p>
                </div>
            </div>
            <a href="{{route('admin.brand.index')}}"
               class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/brand.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        برندها
                    </p>
                </div>
            </a>


        </section>


    </section>

@endsection
