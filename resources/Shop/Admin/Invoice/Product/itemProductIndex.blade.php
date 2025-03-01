@extends('Admin.Layout.master')

@section('content')

    <section class="flex items-center justify-center space-x-reverse space-x-3">
        <div class="border border-black rounded-md p-1">
            <img src="{{asset("capsule/images/1Mount.svg")}}" alt="">
        </div>
        <div>
            <img src="{{asset("capsule/images/3Mount.svg")}}" alt="">
        </div>
        <div>
            <img src="{{asset("capsule/images/6Mount.svg")}}" alt="">
        </div>
        <div>
            <img src="{{asset("capsule/images/date.svg")}}" alt="">
        </div>

    </section>
    <div class="flex items-center justify-between space-x-reverse space-x-3 px-4  mt-5">
        <div class="flex flex-col items-center space-x-reverse space-x-2">
            <h1 class="text-min font-bold ">لیست فاکتور های ثبت شده</h1>
            <a href="{{route('admin.invoice.product.edit',$invoice)}}" class="mt-2 px-4 py-1.5 bg-2081F2 rounded-lg text-white text-sm">ویرایش فاکتور</a>
        </div>
        <div class="border border-black flex items-center py-1.5  rounded-md">
            <input type="text" placeholder="نام محصول ثبت شده را وارد نمائید ..."
                   class="placeholder:text-min placeholder:text-black/35 outline-none">
            <img src="{{asset('capsule/images/search.svg')}}" alt="">

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
                            class="p-2 h-full @if(($invoiceItem->id%2)==0) bg-E9E9E9 @endif flex-wrap  flex items-center justify-between  divide-x-1 divide-black divide-x-reverse">
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
