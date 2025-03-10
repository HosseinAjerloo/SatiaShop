@extends('Admin.Layout.master')

@section('content')


    <div class="flex items-center justify-between space-x-reverse space-x-3 px-4  mt-5">
        <div class="flex flex-col items-center space-x-reverse space-x-2">
            <h1 class="text-min font-bold ">لیست فاکتور های ثبت شده</h1>
        </div>
        <div class="flex flex-col items-center space-x-reverse space-x-2">
            <a href="{{route('admin.invoice.service.edit',$invoice)}}" class="mt-2 px-4 py-1.5 bg-2081F2 rounded-lg text-white text-sm">ویرایش فاکتور</a>
        </div>
    </div>
    <section class=" mt-5">
        <article class="border-black space-y-5 py-1.5 rounded-md px-4">

            <article
                class=" p-2 flex items-center justify-between rounded-md ">

                <div class="w-100  w-full space-y-3">
                    <h1 class="text-black text-min font-bold w-full ">
                        توضیحات مربوط به فاکتور
                    </h1>
                    <div class="text-sm w-100 leading-7" id="replace_element_1">
                        {!!$invoice->description??''!!}
                    </div>

                </div>



            </article>


            <article class="   border-black space-y-5 py-1.5 rounded-md rounded-se-none  rounded-ss-none">
                @foreach($invoice->invoiceItem  as $key=> $invoiceItem)
                    <article
                        class="bg-2081F2 px-2 py-1 flex items-center justify-between rounded-md rounded-ee-none rounded-es-none">
                        <div class="w-1/5">
                            <h1 class="text-white text-min font-bold text-center">
                                نام محصول
                            </h1>
                        </div>
                        <div class="w-1/5">
                            <h1 class="text-white text-min font-bold text-center">
                                قیمت(ریال)
                            </h1>
                        </div>
                        <div class="w-1/5">
                            <h1 class="text-white text-min font-bold text-center">
                                تعداد
                            </h1>
                        </div>
                    </article>
                    <div
                        class="p-2 h-full @if(($key%2)==0) bg-E9E9E9 @endif flex-wrap  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
                        <div class="w-1/5">
                            <p class="  text-min_sm font-bold  h-full flex items-center justify-center text-center  ">
                                {{$invoiceItem->product->removeUnderLine??''}}
                            </p>
                        </div>
                        <div class="w-1/5">
                            <p class=" text-min_sm font-bold  h-full flex items-center justify-center text-center  ">
                                {{numberFormat($invoiceItem->price)??''}}
                            </p>
                        </div>
                        <div class="w-1/5">
                            <p class="  text-min_sm font-bold  h-full flex items-center justify-center text-center ">
                                {{$invoiceItem->amount??''}}
                            </p>
                        </div>
                        <div class="w-100 mt-3 mb-3 w-full space-y-3 ">
                            <h1 class="text-black text-min font-bold w-full">
                                توضیحات
                            </h1>
                            <div class="text-sm leading-7  w-full" id="replace_element_1">
                                {!!$invoiceItem->description??''!!}

                            </div>

                        </div>
                    </div>

                @endforeach

            </article>
        </article>
    </section>

@endsection
@section('script')

    <script>
        $(document).ready(function () {
            CKEDITOR.config.readOnly = true;
        });
        CKEDITOR.replaceClass = 'ckeditor';


    </script>
@endsection
