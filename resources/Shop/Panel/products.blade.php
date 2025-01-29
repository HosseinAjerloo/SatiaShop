@extends('Panel.Layout.Master')
@section('content')





        <section class="mb-8">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header py-2">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title ">
                                        <span > {{$category->removeUnderLine??''}}</span>
                                    </h2>

                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                    @foreach($category->productes as $product)

                                            <section class="item">
                                                <section class="lazyload-item-wrapper">
                                                    <section class="product">
                                                        <section class="product-add-to-cart addCart" data-id="{{$product->id}}">
                                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید">
                                                                <i class="fa fa-cart-plus"></i>
                                                            </a>
                                                        </section>
{{--                                                        <section class="product-add-to-favorite">--}}
{{--                                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی">--}}
{{--                                                                <i class="fa fa-heart"></i>--}}
{{--                                                            </a>--}}
{{--                                                        </section>--}}
                                                        <a class="product-link" href="{{route('panel.product',$product->removeUnderLine)}}">
                                                            <section class="product-image">
                                                                <img class="" src="{{asset($product->image->path??"")}}" alt="">
                                                            </section>
                                                            <section class="product-colors"></section>
                                                            <section class="product-name">
                                                                <h3>
                                                                    {{$product->title??''}}
                                                                    </h3>
                                                            </section>
                                                            <section class="product-price-wrapper">
                                                                <section class="product-discount">
                                                                    <span class="text-min_sm text-gray-400 tracking-tight">مانده در انبار </span>
                                                                    <span class="product-discount-amount">{{$product->productRemaining()}}</span>
                                                                </section>
                                                                <section class="product-price">{{numberFormat( ($product->price/10) )}} تومان</section>
                                                            </section>
                                                            <section class="product-colors">
                                                                <section class="product-colors-item"
                                                                         style="background-color: white;"></section>
                                                                <section class="product-colors-item"
                                                                         style="background-color: blue;"></section>
                                                                <section class="product-colors-item"
                                                                         style="background-color: red;"></section>
                                                            </section>
                                                        </a>
                                                    </section>
                                                </section>
                                            </section>

                                    @endforeach


                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>



    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100" src="assets/images/ads/two-col-1.jpg" alt=""></section>
                <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100" src="assets/images/ads/two-col-2.jpg" alt=""></section>
            </section>

        </section>
    </section>




    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                <section class="col"><img class="d-block rounded-2 w-100" src="{{asset("shop/assets/images/ads/one-col-1.jpg")}}" alt=""></section>
            </section>

        </section>
    </section>




@endsection
@section('script')
    <script>

        $(document).ready(function () {


            let addCart = $(".addCart");
            $(addCart).click(function () {

                let productId = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('panel.cart.addCart')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        product_id: productId
                    },
                    success: function (response) {

                        toast(response.message, response.status)

                        if (response.status) {
                            $(addCart).attr('disabled', 'disabled');
                            $(addCart).children('span').html('به سبد خریدشما اضافه شد');
                        }

                    },
                    error: function (error) {

                        console.log('error')
                    }
                });
            })
        })
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
