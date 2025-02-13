<header class="header mb-4">


    <!-- start top-header logo, searchbox and cart -->
    <section class="top-header">
        <section class="container-xxl ">
            <section class="d-md-flex justify-content-md-between align-items-md-center py-3">

                <section class="d-flex justify-content-between align-items-center d-md-block">
                    <a class="text-decoration-none" href="#"><img
                            src="{{asset("capsule/images/logo.svg")}}" alt="logo"></a>
                    <button class="btn btn-link text-dark d-md-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <i class="fa fa-bars me-1"></i>
                    </button>
                </section>

                <section class="mt-3 mt-md-auto search-wrapper">
                    <section class="search-box">
                        <section class="search-textbox">
                            <span class="searchIcon"><i class="fa fa-search"></i></span>
                            <input id="search" type="text" class="" placeholder="جستجو ..." autocomplete="off">
                        </section>
                        <section class="search-result visually-hidden">

                            @foreach($products as $product)
                                <section class="search-result-title">
                                    نتایج جستجو برای
                                    <span class="search-words">{{$product->removeUnderLine}}</span>
                                    <span class="search-result-type cursor-pointer"
                                          data-value="{{route('panel.product',$product->title)}}">در کالاها</span>
                                </section>
                            @endforeach
                            <section class="search-result-item"><span class="search-no-result">موردی یافت نشد</span>
                            </section>
                        </section>
                    </section>
                </section>

                <section class="mt-3 mt-md-auto text-end">
                    <section class="d-inline px-md-3">
                        <button class="btn btn-link text-decoration-none text-dark dropdown-toggle profile-button"
                                type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </button>
                        <section class="dropdown-menu dropdown-menu-end custom-drop-down"
                                 aria-labelledby="dropdownMenuButton1">
                            <section>
                                <a class="dropdown-item" href="{{route('panel.my-profile.index')}}">
                                    <i class="fa fa-user-circle"></i>
                                    پروفایل کاربری
                                </a>
                            </section>
                            <section><a class="dropdown-item" href="{{route('panel.order.index')}}"><i
                                        class="fa fa-newspaper"></i>سفارشات</a>
                            </section>
                            {{--                            <section>--}}
                            {{--                                <a class="dropdown-item" href="my-favorites.html">--}}
                            {{--                                    <i class="fa fa-heart"></i>لیست--}}
                            {{--                                    علاقه مندی</a>--}}
                            {{--                            </section>--}}
                            <section>
                                <hr class="dropdown-divider">
                            </section>
                            <section>
                                <a class="dropdown-item"
                                   href="{{\Illuminate\Support\Facades\Auth::user()?route('logout'):route('login.index')}}">
                                    <i class="fa fa-sign-out-alt"></i>
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                        خروج
                                    @else
                                        ورود
                                    @endif
                                </a>
                            </section>

                        </section>
                    </section>
                    <section class="header-cart d-inline ps-3 border-start position-relative">
                        <a class="btn btn-link position-relative text-dark header-cart-link" href="javascript:void(0)">
                            <i class="fa fa-shopping-cart"></i> <span style="top: 80%;"
                                                                      class="position-absolute start-0 translate-middle badge rounded-pill bg-danger">
                                @if($myCart)
                                    {{$myCart->cartItem()->count()}}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                        @if($myCart and $myCart->cartItem()->count()>0)
                            <section class="header-cart-dropdown">
                                <section class="border-bottom d-flex justify-content-between p-2">
                                    <span class="text-muted">{{$myCart->cartItem()->count()}} کالا</span>
                                    <a class="text-decoration-none text-info" href="{{route('panel.cart.index')}}">مشاهده
                                        سبد خرید </a>
                                </section>
                                <section class="header-cart-dropdown-body">
                                    @foreach($myCart->cartItem as $cartItem)
                                        <section
                                            class="header-cart-dropdown-body-item d-flex justify-content-start align-items-center">
                                            <img class="flex-shrink-1"
                                                 src="{{asset($cartItem->product->image->path??'')}}"
                                                 alt="">
                                            <section class="w-100 text-truncate">
                                                <a class="text-decoration-none text-dark" href="#">
                                                    {{$cartItem->product->removeUnderLine??''}}
                                                </a>
                                            </section>
                                            <section class="flex-shrink-1">
                                                <a class="text-muted text-decoration-none p-1"
                                                   href="{{route('panel.cart.destroy',$cartItem->id)}}">
                                                    <i class="fa fa-trash-alt"></i></a>
                                            </section>
                                        </section>
                                    @endforeach


                                </section>
                                <section
                                    class="header-cart-dropdown-footer border-top d-flex justify-content-between align-items-center p-2">
                                    <section class="">
                                        <section>مبلغ قابل پرداخت</section>
                                        <section> {{numberFormat(($myCart->finalPrice / 10))}} ریال</section>
                                    </section>
                                    <section class=""><a class="btn btn-danger btn-sm d-block"
                                                         href="{{route('panel.payment.advance')}}">ثبت
                                            سفارش</a></section>
                                </section>
                            </section>
                        @endif
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end top-header logo, searchbox and cart -->


    <!-- start menu -->
    <nav class="top-nav">
        <section class="container-xxl ">
            <nav class="">
                <section class="d-none d-md-flex justify-content-md-start position-relative">

                    <section class="super-navbar-item me-4">
                        <section class="super-navbar-item-toggle">
                            <i class="fa fa-bars me-1"></i>
                            دسته بندی کالاها
                        </section>
                        <section class="sublist-wrapper position-absolute w-100">
                            <section class="position-relative sublist-area">
                                @foreach($categoryMenus as $category)

                                    <section class="sublist-item">
                                        <section
                                            class="sublist-item-toggle">{{$category->removeUnderLine??''}}</section>
                                        <section class="sublist-item-sublist">

                                            @foreach($category->chidren as $child)
                                                <section
                                                    class="sublist-item-sublist-wrapper d-flex justify-content-around align-items-center">
                                                    <section class="sublist-column col">
                                                        <a href="#" class="sub-category">{{$child->removeUnderLine??''}}</a>
                                                        @foreach($child->chidren as $childItem)
                                                            <a href="#"
                                                               class="sub-sub-category">{{$childItem->removeUnderLine??''}}</a>

                                                        @endforeach
                                                    </section>
                                                </section>
                                            @endforeach


                                        </section>
                                    </section>

                                @endforeach


                            </section>
                        </section>
                    </section>
                    <section class="border-start my-2 mx-1"></section>
                    @foreach($categories as $category)

                        <section class="navbar-item"><a
                                href="{{route('panel.products',$category->name)}}">{{$category->removeUnderLine??""}}</a>
                        </section>
                    @endforeach


                </section>


                <!--mobile view-->
                <section class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                         aria-labelledby="offcanvasExampleLabel" style="z-index: 9999999;">
                    <section class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><a class="text-decoration-none"
                                                                                  href="index.html"><img
                                    src="{{asset('shop/assets/images/logo/8.png')}}" alt="logo"></a></h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </section>
                    <section class="offcanvas-body">

                        <section class="navbar-item"><a href="#">سوپرمارکت</a></section>
                        <section class="navbar-item"><a href="#">تخفیف ها و پیشنهادها</a></section>
                        <section class="navbar-item"><a href="#">آمازون من</a></section>
                        <section class="navbar-item"><a href="#">آمازون پلاس</a></section>
                        <section class="navbar-item"><a href="#">درباره ما</a></section>
                        <section class="navbar-item"><a href="#">فروشنده شوید</a></section>
                        <section class="navbar-item"><a href="#">فرصت های شغلی</a></section>


                        <hr class="border-bottom">
                        <section class="navbar-item"><a href="javascript:void(0)">دسته بندی</a></section>
                        <!-- start sidebar nav-->
                        <section class="sidebar-nav mt-2 px-3">
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">کالای دیجیتال <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">خودرو ابزار و تجهیزات صنعتی <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">مد و پوشاک <i class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">اسباب بازی، کودک و نوزاد <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">کالاهای سوپرمارکتی <i class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">زیبایی و سلامت <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">خانه و آشپزخانه <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">کتاب، لوازم تحریر و هنر <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">ورزش و سفر <i class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title">محصولات بومی و محلی <i
                                        class="fa fa-angle-left"></i></span>
                                <section class="sidebar-nav-sub-wrapper">
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                    <section class="sidebar-nav-sub-item">
                                        <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                        <section class="sidebar-nav-sub-sub-wrapper">
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a>
                                            </section>
                                            <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                        </section>
                                    </section>
                                </section>
                            </section>

                        </section>
                        <!--end sidebar nav-->


                    </section>
                </section>

            </nav>
        </section>
    </nav>
    <!-- end menu -->


</header>
<div class="toast-container" id="toast-container">
</div>
