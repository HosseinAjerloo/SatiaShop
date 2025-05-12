@extends('Admin.Layout.master')

@section('content')

    <section class="px-3 space-y-5">
        <section class="flex items-center justify-between ">
            <a href="{{route('admin.my-menu')}}"
               class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[23%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/service.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        تنظیمات برنامه
                    </p>
                </div>
            </a>
            <a href="{{route('admin.resideCapsule.index')}}" class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[23%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/daryaft-capsule.svg")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        لیست کپسول ها
                    </p>
                </div>
            </a>
            <a href="{{route('admin.sale.index')}}" class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[23%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/sale.png")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        فروش کپسول
                    </p>
                </div>
            </a>

{{--            <a href="{{route('admin.resideCapsule.index')}}" class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[18%]">--}}
{{--                <div class="p-2">--}}
{{--                    <img src="{{asset("capsule/images/list-resid.svg")}}" alt="" class="w-14 h-14">--}}
{{--                </div>--}}
{{--                <div--}}
{{--                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">--}}
{{--                    <p class="text-sm font-bold text-center ">--}}
{{--                        لیست رسید ها--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </a>--}}
            <div class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[23%]">
                <div class="p-2">
                    <img src="{{asset("capsule/images/list-factor.svg")}}" alt="" class="w-14 h-14">
                </div>
                <div
                    class="flex items-center justify-center mt-3 bg-F1F1F1 w-full py-1.5 px-1 rounded-md rounded-se-none rounded-ss-none h-10">
                    <p class="text-sm font-bold text-center ">
                        لیست فاکتور ها
                    </p>
                </div>
            </div>
        </section>




    </section>

@endsection
