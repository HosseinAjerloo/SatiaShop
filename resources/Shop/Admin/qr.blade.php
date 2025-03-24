@extends('Admin.Layout.master')
@section('header')
    <style>
       @media print {
           header{
               display: none;
           }
           @page  {
               size: A5;
           }
           .print-item{
               page-break-after: always;
           }
           .print-item:last-child{
               page-break-after: auto;
           }

       }
    </style>
@endsection
@section('content')

    <section class=" space-y-6  px-2">

        <article class="print-item space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <article class="flex justify-center items-center w-full border border-2 rounded-md border-black/65  bg-F1F1F1">
                <h1 class="text-center px-2 font-semibold">حمید کرمیان</h1>
                <p class="px-2 py-2 border-r-2 border-r border-r-black/65  text-sm flex items-center justify-center">سازمان تبلیغات اسلامی استان مرکزی</p>
            </article>

            <div class="flex items-center justify-between">
                <div class="space-y-3">
                    <p>
                        <span class="font-semibold text-sm">
                            شماره کپسول:
                        </span>
                        <span class="text-[12px]">1257521</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ اعتبارشارژ:
                        </span>
                        <span class="text-[12px]">2024/12/01</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ مراجعه:
                        </span>
                        <span class="text-[12px]">
                            2024/12/01
                        </span>
                    </p>
                </div>
                <img src="{{asset('capsule/images/qr.png')}}" alt="" class="w-24 h-24">
            </div>

        </article>
        <article class="print-item space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <article class="flex justify-center items-center w-full border border-2 rounded-md border-black/65  bg-F1F1F1">
                <h1 class="text-center px-2 font-semibold">حمید کرمیان</h1>
                <p class="px-2 py-2 border-r-2 border-r border-r-black/65  text-sm flex items-center justify-center">سازمان تبلیغات اسلامی استان مرکزی</p>
            </article>

            <div class="flex items-center justify-between">
                <div class="space-y-3">
                    <p>
                        <span class="font-semibold text-sm">
                            شماره کپسول:
                        </span>
                        <span class="text-[12px]">1257521</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ اعتبارشارژ:
                        </span>
                        <span class="text-[12px]">2024/12/01</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ مراجعه:
                        </span>
                        <span class="text-[12px]">
                            2024/12/01
                        </span>
                    </p>
                </div>
                <img src="{{asset('capsule/images/qr.png')}}" alt="" class="w-24 h-24">
            </div>

        </article>
        <article class="print-item space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <article class="flex justify-center items-center w-full border border-2 rounded-md border-black/65  bg-F1F1F1">
                <h1 class="text-center px-2 font-semibold">حمید کرمیان</h1>
                <p class="px-2 py-2 border-r-2 border-r border-r-black/65  text-sm flex items-center justify-center">سازمان تبلیغات اسلامی استان مرکزی</p>
            </article>

            <div class="flex items-center justify-between">
                <div class="space-y-3">
                    <p>
                        <span class="font-semibold text-sm">
                            شماره کپسول:
                        </span>
                        <span class="text-[12px]">1257521</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ اعتبارشارژ:
                        </span>
                        <span class="text-[12px]">2024/12/01</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ مراجعه:
                        </span>
                        <span class="text-[12px]">
                            2024/12/01
                        </span>
                    </p>
                </div>
                <img src="{{asset('capsule/images/qr.png')}}" alt="" class="w-24 h-24">
            </div>

        </article>
        <article class="print-item space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <article class="flex justify-center items-center w-full border border-2 rounded-md border-black/65  bg-F1F1F1">
                <h1 class="text-center px-2 font-semibold">حمید کرمیان</h1>
                <p class="px-2 py-2 border-r-2 border-r border-r-black/65  text-sm flex items-center justify-center">سازمان تبلیغات اسلامی استان مرکزی</p>
            </article>

            <div class="flex items-center justify-between">
                <div class="space-y-3">
                    <p>
                        <span class="font-semibold text-sm">
                            شماره کپسول:
                        </span>
                        <span class="text-[12px]">1257521</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ اعتبارشارژ:
                        </span>
                        <span class="text-[12px]">2024/12/01</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ مراجعه:
                        </span>
                        <span class="text-[12px]">
                            2024/12/01
                        </span>
                    </p>
                </div>
                <img src="{{asset('capsule/images/qr.png')}}" alt="" class="w-24 h-24">
            </div>

        </article>
        <article class="print-item space-y-5 rounded-md border border-2 border-black border-black/65  p-2">
            <article class="flex justify-center items-center w-full border border-2 rounded-md border-black/65  bg-F1F1F1">
                <h1 class="text-center px-2 font-semibold">حمید کرمیان</h1>
                <p class="px-2 py-2 border-r-2 border-r border-r-black/65  text-sm flex items-center justify-center">سازمان تبلیغات اسلامی استان مرکزی</p>
            </article>

            <div class="flex items-center justify-between">
                <div class="space-y-3">
                    <p>
                        <span class="font-semibold text-sm">
                            شماره کپسول:
                        </span>
                        <span class="text-[12px]">1257521</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ اعتبارشارژ:
                        </span>
                        <span class="text-[12px]">2024/12/01</span>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">
                            تاریخ مراجعه:
                        </span>
                        <span class="text-[12px]">
                            2024/12/01
                        </span>
                    </p>
                </div>
                <img src="{{asset('capsule/images/qr.png')}}" alt="" class="w-24 h-24">
            </div>

        </article>

    </section>

@endsection

@section('script')

    <script>
        window.addEventListener('load',function (){
            window.print();
        })
    </script>
@endsection
