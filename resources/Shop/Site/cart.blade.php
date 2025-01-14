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
                            <img src="{{asset('capsule/images/add.svg')}}" alt="" class="bg-2081F2 w-5 h-5 p-1 plus"
                                 data-product="product-1">
                            <div class="show-product-1-count">
                                1
                            </div>
                            <img src="{{asset('capsule/images/minus-svgrepo-com.svg')}}" alt=""
                                 class="bg-2081F2 w-5 h-5 p-1 minus"  data-product="product-1" >
                        </div>
                    </div>
                </article>
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
                            <img src="{{asset('capsule/images/add.svg')}}" alt="" class="bg-2081F2 w-5 h-5 p-1 plus"
                                 data-product="product-2">
                            <div class="show-product-2-count">
                                1
                            </div>
                            <img src="{{asset('capsule/images/minus-svgrepo-com.svg')}}" alt=""
                                 class="bg-2081F2 w-5 h-5 p-1 minus"  data-product="product-2" >
                        </div>
                    </div>
                </article>


            </section>

        </article>
        <article class="w-full lg:w-[24%] rounded-lg shadow-md border py-3 border-gray-300 max-h-max space-y-3">
            <div class="py-3 flex items-center justify-start">
                <p class="font-bold text-lg px-4">
                    صورت حساب
                </p>
            </div>
            <article>
                <div class="px-4 flex justify-between">
                    <p class="text-sm">تعداد محصول</p>
                    <p>
                        <span class="font-semibold count">4</span>
                        <span class="text-min font-bold">عدد</span>
                    </p>
                </div>
            </article>
            <article>
                <div class="px-4 flex justify-between">
                    <p class="text-sm">قیمت محصولات</p>
                    <p>
                        <span class="font-semibold amount">150000</span>
                        <span class="text-min font-bold">ریال</span>
                    </p>
                </div>
            </article>
            <form action="" class=" w-full" id="form">
                <input type="number" max="5" min="1" name="product[1]" id="product-1" value="1" data-productPrice="15000000" class="hidden">
                <input type="number" max="7" min="1" name="product[1]" id="product-2" value="1" data-productPrice="25000000" class="hidden">

                <div class="px-4 flex justify-between w-full">
                    <button
                        class="rounded-lg border border-2081F2 text-black w-full py-2 flex items-center justify-center hover:bg-2081F2 hover:text-white transition-all ">
                        پرداخت
                    </button>
                </div>
            </form>
        </article>
    </section>

@endsection

@section('script')
    <script>
        // add product
        let plus = (".plus");
        $(plus).click(function () {
            console.log()
            var product = $("#" + $(this).attr('data-product'));
            var productMax = $(product).attr('max');
            var number = (Number($(product).val()) + 1);
            if (number <= productMax) {
                $(product).val(number);
            }
            $('.show-' + $(this).attr('data-product') + '-count').html($(product).val())
            priceCalculation();

        });


        //  minus product
        let minus = (".minus");
        $(minus).click(function () {
            var product = $("#" + $(this).attr('data-product'));
            var number = (Number($(product).val()) - 1);
            if ($(product).val()>1) {
                $(product).val(number);
            }
            $('.show-' + $(this).attr('data-product') + '-count').html($(product).val())
            priceCalculation();

        });

        function priceCalculation(){
            let totalAmount = 0;
             var inputs=$('#form').children('input');
            $(inputs).each(function (index,value){

               if ($(value).attr('data-productPrice') && $(value).attr('data-productPrice')!='undefined')
               {
                   totalAmount+=Number($(value).val()) * Number($(value).attr('data-productPrice'))
                   $('.amount').html(totalAmount.toLocaleString('fa'))
               }
            })

        }
        priceCalculation();

    </script>
@endsection
