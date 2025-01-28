@extends('Panel.Layout.Master')
@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9 mb-3">
                            @foreach($myCart->cartItem as $cartItem)
                                <section class="content-wrapper bg-white p-3 rounded-2">

                                    <section class="cart-item d-md-flex py-3">
                                        <section class="cart-img align-self-start flex-shrink-1">
                                            <img
                                                src="{{$cartItem->product->image->path??''}}" alt="">
                                        </section>
                                        <section class="align-self-start w-100 space-y-3">
                                            <p class="fw-bold">{{$cartItem->product->title??''}}</p>
{{--                                            <p>--}}
{{--                                                <span style="background-color: #523e02;"--}}
{{--                                                     class="cart-product-selected-color me-1"></span>--}}
{{--                                                <span> قهوه ای</span>--}}
{{--                                            </p>--}}
{{--                                            <p>--}}
{{--                                                <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>--}}
{{--                                                <span> گارانتی اصالت و سلامت فیزیکی کالا</span>--}}
{{--                                            </p>--}}
                                            <p>
                                                <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                                <span>قیمت هرواحد:{{numberFormat(($cartItem->product->price / 10))}} تومان </span>
                                            </p>
                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <button class="cart-number-down minus" type="button"  data-product="{{$cartItem->product_id}}" >-</button>
                                                    <span class="show-{{$cartItem->product_id}}-count">
                                                           {{$cartItem->amount}}
                                                    </span>
                                                    <button class="cart-number-up plus"   data-product="{{$cartItem->product_id}}" type="button">+</button>
                                                </section>
                                                <a class="text-decoration-none ms-4 cart-delete" href="{{route('panel.cart.destroy',$cartItem->id)}}"><i
                                                        class="fa fa-trash-alt"></i> حذف از سبد</a>
                                            </section>
                                        </section>

                                    </section>

                                    @endforeach


                                </section>
                        </section>
                        <form class="col-md-3" action="{{route('panel.payment.payment')}}"  id="form" method="POST">
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
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">



                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder amount">320,000 تومان</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>
                                    کاربر گرامی خرید شما هنوز نهایی نشده است.
                                    برای ثبت سفارش و تکمیل خرید ابتدا باید وارد سایت شوید و از قسمت تکمیل پروفایل
                                    اطلاعات
                                    پروفایلی خودتان را تکمیل کنید تا در صورت بروز مشکل کارشناسان ما بتوانند با شما
                                    تماس حاصل فرماییند باتشکر تیم توسعه دهنده سایتا
                                </p>


                                <section class="">
                                    <a href="address.html" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                                </section>



                            </section>
                        </form>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

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

                }
            });


        });

        function priceCalculation() {
            let totalAmount = 0;
            var inputs = $('#form').children('input');
            $(inputs).each(function (index, value) {

                if ($(value).attr('data-productPrice') && $(value).attr('data-productPrice') != 'undefined') {
                    totalAmount += Number($(value).val()) * Number($(value).attr('data-productPrice'))
                    totalAmount=(totalAmount / 10)
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
