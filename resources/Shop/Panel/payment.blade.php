@extends('Panel.Layout.Master')
@section('content')
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>انتخاب نوع پرداخت </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            {{--                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">--}}

                            {{--                                <!-- start vontent header -->--}}
                            {{--                                <section class="content-header mb-3">--}}
                            {{--                                    <section class="d-flex justify-content-between align-items-center">--}}
                            {{--                                        <h2 class="content-header-title content-header-title-small">--}}
                            {{--                                            کد تخفیف--}}
                            {{--                                        </h2>--}}
                            {{--                                        <section class="content-header-link">--}}
                            {{--                                            <!--<a href="#">مشاهده همه</a>-->--}}
                            {{--                                        </section>--}}
                            {{--                                    </section>--}}
                            {{--                                </section>--}}

                            {{--                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">--}}
                            {{--                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>--}}
                            {{--                                    <secrion>--}}
                            {{--                                        کد تخفیف خود را در این بخش وارد کنید.--}}
                            {{--                                    </secrion>--}}
                            {{--                                </section>--}}

                            {{--                                <section class="row">--}}
                            {{--                                    <section class="col-md-5">--}}
                            {{--                                        <section class="input-group input-group-sm">--}}
                            {{--                                            <input type="text" class="form-control" placeholder="کد تخفیف را وارد کنید">--}}
                            {{--                                            <button class="btn btn-primary" type="button">اعمال کد</button>--}}
                            {{--                                        </section>--}}
                            {{--                                    </section>--}}

                            {{--                                </section>--}}
                            {{--                            </section>--}}


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نوع پرداخت
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="payment-select changeBank">

                                    {{--                                    <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">--}}
                                    {{--                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>--}}
                                    {{--                                        <secrion>--}}
                                    {{--                                            برای پیشگیری از انتقال ویروس کرونا پیشنهاد می کنیم روش پرداخت اینترنتی رو پرداخت کنید.--}}
                                    {{--                                        </secrion>--}}
                                    {{--                                    </section>--}}
                                    @foreach($banks as $bank)

                                        <label for="b{{$bank->id}}" class="col-12 col-md-4 payment-wrapper mb-2 pt-2" selected="selected">
                                            <section class="mb-2"><i class="fa fa-credit-card mx-1"></i>پرداخت آنلاین</section>
                                            <section class="mb-2"><i class="fa fa-calendar-alt mx-1"></i>{{$bank->name??''}}</section>
                                        </label>
                                        <section class="mb-2"></section>

                                    @endforeach


                                </section>
                            </section>


                        </section>
                            <form action="{{route('panel.payment.payment')}}" class="col-md-3" id="form" method="POST">

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
                                @foreach($banks as $bank)
                                    <input type="radio" class="hidden"  name="payment_type" value="{{$bank->id}}" id="b{{$bank->id}}"/>
                                @endforeach

                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
{{--                                <section class="d-flex justify-content-between align-items-center">--}}
{{--                                    <p class="text-muted">قیمت کالاها (2)</p>--}}
{{--                                    <p class="text-muted">398,000 تومان</p>--}}
{{--                                </section>--}}

{{--                                <section class="d-flex justify-content-between align-items-center">--}}
{{--                                    <p class="text-muted">تخفیف کالاها</p>--}}
{{--                                    <p class="text-danger fw-bolder">78,000 تومان</p>--}}
{{--                                </section>--}}

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder amount">0 تومان</p>
                                </section>

{{--                                <section class="d-flex justify-content-between align-items-center">--}}
{{--                                    <p class="text-muted">هزینه ارسال</p>--}}
{{--                                    <p class="text-warning">54,000 تومان</p>--}}
{{--                                </section>--}}

{{--                                <section class="d-flex justify-content-between align-items-center">--}}
{{--                                    <p class="text-muted">تخفیف اعمال شده</p>--}}
{{--                                    <p class="text-danger">100,000 تومان</p>--}}
{{--                                </section>--}}

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>
                                    کاربرگرامی تمامی کالاهای خریداری شده شما به صورت حضوری تحویل میگردد
                                </p>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">مبلغ قابل پرداخت</p>
                                    <p class="fw-bold amount"> تومان</p>
                                </section>

                                <section class="mt-3">
                                    <section id="payment-button"
                                             class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">
                                        نوع پرداخت را انتخاب کن
                                    </section>
                                    <section id="final-level" href="my-orders.html" class="btn btn-danger d-none">
                                        پرداخت و گرفتن کد رهگیری
                                    </section>
                                </section>

                            </section>
                        </form>
                    </section>
                </section>
            </section>

        </section>
    </section>

@endsection

@section('script')
    <script>
        function toast(message, status) {
            showToast(message);
            if (!status) {
                $(".progress-bar div").css({'background-color': 'red'})
            }

        }
        function priceCalculation() {
            let totalAmount = 0;
            var inputs = $('#form').children('input');
            $(inputs).each(function (index, value) {

                if ($(value).attr('data-productPrice') && $(value).attr('data-productPrice') != 'undefined') {
                    totalAmount += Number($(value).val()) * Number($(value).attr('data-productPrice'))

                }
            })
            totalAmount=(totalAmount / 10)
            $('.amount').html(totalAmount.toLocaleString('fa'))

        }

        priceCalculation();
    </script>
    <script>
        $("#final-level").click(function (){
            $("#form").submit();
        })
    </script>
    
@endsection
