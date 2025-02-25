@extends('Panel.Layout.Master')

@section('content')
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header py-2">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>{{$product->removeUnderLine??''}} </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery">
                                    <section class="product-gallery-selected-image mb-3">
                                        <img src="{{asset($product->image->path??'')}}" alt="">
                                    </section>

                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{$product->removeUnderLine??""}}
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-info">

                                    {{--                                <p><span>رنگ : قهوه ای</span></p>--}}
                                    {{--                                <p>--}}
                                    {{--                                    <span style="background-color: #523e02;" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="قهوه ای تیره"></span>--}}
                                    {{--                                    <span style="background-color: #0c4128;" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="سبز یشمی"></span>--}}
                                    {{--                                    <span style="background-color: #fd7e14;" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="نارنجی پرتقالی"></span>--}}
                                    {{--                                </p>--}}
                                    {{--                                <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span> گارانتی اصالت و سلامت فیزیکی کالا</span></p>--}}
                                    <p>
                                        <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                        <span>
                                        @if($product->isRemaining())
                                                {{$product->productRemaining()}}
                                            @else
                                                موجودی کافی نیست
                                            @endifکالا موجود در انبار
                                    </span>
                                    </p>
                                    {{--                                <p><a class="btn btn-light  btn-sm text-decoration-none" href="#"><i class="fa fa-heart text-danger"></i> افزودن به علاقه مندی</a></p>--}}

                                    <p class="mb-3 mt-5">
                                        <i class="fa fa-info-circle me-1"></i>
                                        کاربر گرامی خرید شما هنوز نهایی نشده است  برای ادامه سفارش ابتدا روی افزودن به سبد خرید و سپس روی دکمه مشاهده سبد خرید کلیک نمایید.



                                    </p>
                                </section>
                            </section>

                        </section>
                        <!-- end product info -->

                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالا</p>
                                    <p class="text-muted">{{numberFormat(($product->price/10 ) )}} <span class="small">تومان</span>
                                    </p>
                                </section>


                                <section class="border-bottom mb-3"></section>


                                <section class="space-y-3">
                                    <div id="next-level" href="#" class="btn btn-danger d-block addCart  text-min"
                                         data-id="{{$product->id}}">
                                        @if($product->productExistsInCart())
                                            این مورد قبلا در سبد خرید شما اضافه شده است
                                        @else

                                            @if($product->isRemaining())
                                                افزودن به سبد خرید
                                            @else
                                                موجودی کافی نیست
                                            @endif
                                        @endif
                                    </div>
                                    <a id="next-level" href="{{route('panel.cart.index')}}"
                                       class="btn btn-danger d-block  text-min">
                                        مشاهده سبد خرید
                                    </a>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>


    @if($product->category->productes()->get()->except($product->id)->counT())
        <section class="mb-8">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header py-2">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title ">
                                        <span> دسته های مرتبط</span>
                                    </h2>

                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                    @foreach($product->category->productes()->get()->except($product->id) as $product)

                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <section class="product-add-to-cart addCart"
                                                             data-id="{{$product->id}}">
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                                           title="افزودن به سبد خرید">
                                                            <i class="fa fa-cart-plus"></i>
                                                        </a>
                                                    </section>
                                                    {{--                                                        <section class="product-add-to-favorite">--}}
                                                    {{--                                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی">--}}
                                                    {{--                                                                <i class="fa fa-heart"></i>--}}
                                                    {{--                                                            </a>--}}
                                                    {{--                                                        </section>--}}
                                                    <a class="product-link"
                                                       href="{{route('panel.product',$product->title)}}">
                                                        <section class="product-image">
                                                            <img class="" src="{{asset($product->image->path??"")}}"
                                                                 alt="">
                                                        </section>
                                                        <section class="product-colors"></section>
                                                        <section class="product-name">
                                                            <h3>
                                                                {{$product->removeUnderLine}}
                                                            </h3>
                                                        </section>
                                                        <section class="product-price-wrapper">
                                                            <section class="product-discount">
                                                                <span class="text-min_sm text-gray-400 tracking-tight">مانده در انبار </span>
                                                                <span class="product-discount-amount">22</span>
                                                            </section>
                                                            <section
                                                                class="product-price">{{numberFormat( ($product->price/10) )}}
                                                                تومان
                                                            </section>
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
    @endif

    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header py-2">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                              href="#introduction">توضیحات مربوط به محصول</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        {{--                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>--}}
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                                {!!  $product->description??''!!}
                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">
                                    <tr>
                                        <td>برند</td>
                                        <td>{{$product->brand->name??''}}</td>
                                    </tr>
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>قطع</td>--}}
                                    {{--                                        <td>رقعی</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>تعداد صفحات</td>--}}
                                    {{--                                        <td>173 صفحه</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>نوع جلد</td>--}}
                                    {{--                                        <td>شومیز</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>نویسنده/نویسندگان</td>--}}
                                    {{--                                        <td>دارن هاردی</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>مترجم</td>--}}
                                    {{--                                        <td>ناهید محمدی</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>ناشر</td>--}}
                                    {{--                                        <td>انتشارات نگین ایران</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>رده‌بندی کتاب</td>--}}
                                    {{--                                        <td>روان‌شناسی (فلسفه و روان‌شناسی)</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>شابک</td>--}}
                                    {{--                                        <td>9786227195132</td>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>سایر توضیحات</td>--}}
                                    {{--                                        <td>چهار صفحه اول رنگی</td>--}}
                                    {{--                                    </tr>--}}
                                </table>
                            </section>

                            <!-- start vontent header -->
                            {{--                            <section id="comments" class="content-header mt-2 mb-4">--}}
                            {{--                                <section class="d-flex justify-content-between align-items-center">--}}
                            {{--                                    <h2 class="content-header-title content-header-title-small">--}}
                            {{--                                        دیدگاه ها--}}
                            {{--                                    </h2>--}}
                            {{--                                    <section class="content-header-link">--}}
                            {{--                                        <!--<a href="#">مشاهده همه</a>-->--}}
                            {{--                                    </section>--}}
                            {{--                                </section>--}}
                            {{--                            </section>--}}
                            {{--                            <section class="product-comments mb-4">--}}

                            {{--                                <section class="comment-add-wrapper">--}}
                            {{--                                    <button class="comment-add-button" type="button" data-bs-toggle="modal"--}}
                            {{--                                            data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن دیدگاه--}}
                            {{--                                    </button>--}}
                            {{--                                    <!-- start add comment Modal -->--}}
                            {{--                                    <section class="modal fade" id="add-comment" tabindex="-1"--}}
                            {{--                                             aria-labelledby="add-comment-label" aria-hidden="true">--}}
                            {{--                                        <section class="modal-dialog">--}}
                            {{--                                            <section class="modal-content">--}}
                            {{--                                                <section class="modal-header">--}}
                            {{--                                                    <h5 class="modal-title" id="add-comment-label"><i--}}
                            {{--                                                            class="fa fa-plus"></i> افزودن دیدگاه</h5>--}}
                            {{--                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"--}}
                            {{--                                                            aria-label="Close"></button>--}}
                            {{--                                                </section>--}}
                            {{--                                                <section class="modal-body">--}}
                            {{--                                                    <form class="row" action="#">--}}

                            {{--                                                        <section class="col-6 mb-2">--}}
                            {{--                                                            <label for="first_name" class="form-label mb-1">نام</label>--}}
                            {{--                                                            <input type="text" class="form-control form-control-sm"--}}
                            {{--                                                                   id="first_name" placeholder="نام ...">--}}
                            {{--                                                        </section>--}}

                            {{--                                                        <section class="col-6 mb-2">--}}
                            {{--                                                            <label for="last_name" class="form-label mb-1">نام--}}
                            {{--                                                                خانوادگی</label>--}}
                            {{--                                                            <input type="text" class="form-control form-control-sm"--}}
                            {{--                                                                   id="last_name" placeholder="نام خانوادگی ...">--}}
                            {{--                                                        </section>--}}

                            {{--                                                        <section class="col-12 mb-2">--}}
                            {{--                                                            <label for="comment" class="form-label mb-1">دیدگاه--}}
                            {{--                                                                شما</label>--}}
                            {{--                                                            <textarea class="form-control form-control-sm" id="comment"--}}
                            {{--                                                                      placeholder="دیدگاه شما ..." rows="4"></textarea>--}}
                            {{--                                                        </section>--}}

                            {{--                                                    </form>--}}
                            {{--                                                </section>--}}
                            {{--                                                <section class="modal-footer py-1">--}}
                            {{--                                                    <button type="button" class="btn btn-sm btn-primary">ثبت دیدگاه--}}
                            {{--                                                    </button>--}}
                            {{--                                                    <button type="button" class="btn btn-sm btn-danger"--}}
                            {{--                                                            data-bs-dismiss="modal">بستن--}}
                            {{--                                                    </button>--}}
                            {{--                                                </section>--}}
                            {{--                                            </section>--}}
                            {{--                                        </section>--}}
                            {{--                                    </section>--}}
                            {{--                                </section>--}}

                            {{--                                <section class="product-comment">--}}
                            {{--                                    <section class="product-comment-header d-flex justify-content-start">--}}
                            {{--                                        <section class="product-comment-date">۲۱ مرداد ۱۴۰۰</section>--}}
                            {{--                                        <section class="product-comment-title">مجتبی مجدی</section>--}}
                            {{--                                    </section>--}}
                            {{--                                    <section class="product-comment-body">--}}
                            {{--                                        با این تخفیف قیمت خیلی خوبه--}}
                            {{--                                    </section>--}}
                            {{--                                </section>--}}

                            {{--                                <section class="product-comment">--}}
                            {{--                                    <section class="product-comment-header d-flex justify-content-start">--}}
                            {{--                                        <section class="product-comment-date">۲۱ مرداد ۱۴۰۰</section>--}}
                            {{--                                        <section class="product-comment-title">هدیه سادات هاشمی نژاد</section>--}}
                            {{--                                    </section>--}}
                            {{--                                    <section class="product-comment-body">--}}
                            {{--                                        پیشنهاد میشه، کتاب مفیدیه--}}
                            {{--                                    </section>--}}
                            {{--                                </section>--}}

                            {{--                                <section class="product-comment">--}}
                            {{--                                    <section class="product-comment-header d-flex justify-content-start">--}}
                            {{--                                        <section class="product-comment-date">۲۱ مرداد ۱۴۰۰</section>--}}
                            {{--                                        <section class="product-comment-title">علی محمدی</section>--}}
                            {{--                                    </section>--}}
                            {{--                                    <section class="product-comment-body">--}}
                            {{--                                        هنوز مطالعه نکردم ولی از نظر چاپ و نشر و قيمت مناسب عالیه، کیفیت چاپ و جنسش--}}
                            {{--                                        عالیه با تخفیفی که خورده قیمت ۱۳ تومن واقعا براش فوق العاده هست محتوای کتابم که--}}
                            {{--                                        اصلا نیاز به تعریف نداره--}}
                            {{--                                    </section>--}}
                            {{--                                </section>--}}

                            {{--                                <section class="product-comment">--}}
                            {{--                                    <section class="product-comment-header d-flex justify-content-start">--}}
                            {{--                                        <section class="product-comment-date">۲۱ مرداد ۱۴۰۰</section>--}}
                            {{--                                        <section class="product-comment-title">حسین رحیمی دهنوی</section>--}}
                            {{--                                    </section>--}}
                            {{--                                    <section class="product-comment-body">--}}
                            {{--                                        این کتاب رو هر کسی باید حداقل یکبار تو زندگیش بخونه واقعا کتاب خوبیه--}}
                            {{--                                    </section>--}}

                            {{--                                    <section class="product-comment ms-5 border-bottom-0">--}}
                            {{--                                        <section class="product-comment-header d-flex justify-content-start">--}}
                            {{--                                            <section class="product-comment-date">۲۱ مرداد ۱۴۰۰</section>--}}
                            {{--                                            <section class="product-comment-title">ادمین</section>--}}
                            {{--                                        </section>--}}
                            {{--                                        <section class="product-comment-body">--}}
                            {{--                                            این کتاب برای همه مفیده--}}
                            {{--                                        </section>--}}
                            {{--                                    </section>--}}

                            {{--                                </section>--}}


                            {{--                            </section>--}}
                        </section>

                    </section>
                </section>
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
                        updateCartView(response);

                        if (response.status) {
                            $(addCart).attr('disabled', 'disabled');
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
