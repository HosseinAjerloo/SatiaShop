@extends('Admin.Layout.master')

@section('content')

    <section class="px-3 space-y-5">
        <section class="flex items-center justify-between ">
            <a href="{{route('admin.my-menu')}}"
               class="border border-black/30 rounded-md  flex items-center justify-center flex-col w-[32%]">
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
        </section>




    </section>

@endsection
