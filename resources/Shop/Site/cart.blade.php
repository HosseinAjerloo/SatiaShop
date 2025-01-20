@extends('Site.Layout.master')

@section('content')

    <section class="px-4 flex space-y-3 lg:space-y-0 flex-wrap lg:space-x-5 lg:space-x-reverse justify-center ">
        <article class="w-full lg:w-[50%] px-4 rounded-lg shadow-md border border-gray-300">
            <div class="flex items-center py-3 px-2 space-x-2 space-x-reverse">
                <h1 class="text-lg font-bold">سبدخرید شما</h1>
                <p class="text-sm">
                    <span>{{$myCart->cartItem->count()}}</span>عددکالا
                </p>
            </div>

            <section class="flex flex-wrap ">
                @foreach($myCart->cartItem as $cartItem)
                    <article
                        class="flex flex-wrap  items-center border-dashed border-black border-2 rounded-lg w-full mb-5 ">
                        <div class="w-full sm:w-[49%] flex items-center justify-center rounded-lg">
                            <img src="{{asset($cartItem->product->image->path??'')}}" alt=""
                                 class="w-64 h-64 object-contain">
                        </div>
                        <div class="px-4 py-1.5 rounded-lg w-full sm:w-[49%]">
                            <h1 class="text-sm  leading-6   ">
                                {{$cartItem->product->title}}
                            </h1>
                            <div class=" flex-col flex   ">
                                <div class=" text-min text-green-600 font-bold flex justify-between items-center ">
                                    <span>قیمت هرواحد(ریال):</span>
                                    <span>{{numberFormat($cartItem->product->price)}}</span>
                                </div>
                            </div>

                            <div class="m-3 p-2 flex items-center justify-between shadow-equalTo rounded-md">
                                <img src="{{asset('capsule/images/add.svg')}}" alt="" class="bg-2081F2 w-5 h-5 p-1 plus cursor-pointer"
                                     data-product="{{$cartItem->product_id}}">
                                <div class="show-{{$cartItem->product_id}}-count">
                                    {{$cartItem->amount}}
                                </div>
                                <img src="{{asset('capsule/images/manfi.svg')}}" alt=""
                                     class="bg-2081F2 w-5 h-5 p-1 minus cursor-pointer" data-product="{{$cartItem->product_id}}">
                            </div>
                        </div>
                    </article>
                @endforeach


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
                    <p class="text-sm">تعداد کالا</p>
                    <p>
                        <span class="font-semibold count">{{$myCart->cartItem->count()}}</span>
                        <span class="text-min font-bold">عدد</span>
                    </p>
                </div>
            </article>
            <article>
                <div class="px-4 flex justify-between">
                    <p class="text-sm">قیمت محصولات</p>
                    <p>
                        <span class="font-semibold amount">0</span>
                        <span class="text-min font-bold">ریال</span>
                    </p>
                </div>
            </article>
            <form action="{{route('panel.payment.payment')}}" class="w-full" id="form" method="POST">
                @csrf
                @foreach($myCart->cartItem as $cartItem)

                    @if($cartItem->product->type=='goods')
                        <input type="number"  min="1"
                               name="product[{{$cartItem->product_id}}]" id="{{$cartItem->product_id}}"
                               value="{{$cartItem->amount}}"
                               data-productPrice="{{$cartItem->product->price}}" class="hidden">
                    @else
                        <input type="number"  min="1" name="product[{{$cartItem->product_id}}]"
                               id="{{$cartItem->product_id}}" value="{{$cartItem->amount}}"
                               data-productPrice="{{$cartItem->product->price}}" class="hidden">
                    @endif

                @endforeach
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
            var productId = $(this).attr('data-product');
            var product = $("#" + $(this).attr('data-product'));
            var number = (Number($(product).val()) + 1);


            $.ajax({
                url: "{{route('panel.cart.increase')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    product_id: productId,
                    amount: number,
                },
                success: function (response) {

                    if (!response.status) {
                        toast(response.message, response.status)
                    }
                    if (response.maxAmount > 0) {
                        $(product).val(number)
                        $('.show-' + productId + '-count').html(number)
                    }
                    priceCalculation();

                },
                error: function (error) {

                    console.log('error')
                }
            });


        });


        //  minus product
        let minus = (".minus");
        $(minus).click(function () {
            var productId = $(this).attr('data-product');
            var product = $("#" + $(this).attr('data-product'));
            var number = (Number($(product).val()) - 1);
            if ($(product).val() > 1) {
                $(product).val(number);
                $('.show-' + productId + '-count').html(number)
            }

            $.ajax({
                url: "{{route('panel.cart.decrease')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    product_id: productId,
                    amount: number,
                },
                success: function (response) {

                    if (!response.status) {
                        toast(response.message, response.status)
                    }
                    priceCalculation();

                },
                error: function (error) {

                    console.log('error')
                }
            });


        });

        function priceCalculation() {
            let totalAmount = 0;
            var inputs = $('#form').children('input');
            $(inputs).each(function (index, value) {

                if ($(value).attr('data-productPrice') && $(value).attr('data-productPrice') != 'undefined') {
                    totalAmount += Number($(value).val()) * Number($(value).attr('data-productPrice'))
                    $('.amount').html(totalAmount.toLocaleString('fa'))
                }
            })

        }

        priceCalculation();


    </script>
    <script>
        function toast(message, status) {
            showToast(message);
            if (!status) {
                $(".progress-bar div").css({'background-color': 'red'})
            }

        }
    </script>
@endsection
