@extends('Panel.Layout.Master')
@section('content')

    @foreach($menus as $menu)

        <section class="mb-8">

            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header py-2">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title ">
                                        <span> {{$menu->name??''}}</span>
                                    </h2>

                                </section>
                            </section>
                            <!-- start vontent header -->

                            <section class="lazyload-wrapper">
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                    @foreach($menu->categoryShow() as $category)

                                        <section class="item">
                                            <section class="lazyload-item-wrapper">
                                                <section class="product">
                                                    <a class="product-link"
                                                       href="{{route('panel.products',$category->name)}}">
                                                        <section class="product-image">
                                                            <img class="" src="{{$category->image?->path}}" alt="">
                                                        </section>
                                                        <section class="product-colors"></section>
                                                        <section class="product-name">
                                                            <h3> {{$category->removeUnderLine??''}}</h3></section>

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
    @endforeach



    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100"
                                                                   src="assets/images/ads/two-col-1.jpg" alt="">
                </section>
                <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100"
                                                                   src="assets/images/ads/two-col-2.jpg" alt="">
                </section>
            </section>

        </section>
    </section>




    {{--    <section class="mb-3">--}}
    {{--        <section class="container-xxl">--}}
    {{--            <!-- one column -->--}}
    {{--            <section class="row py-4">--}}
    {{--                <section class="col"><img class="d-block rounded-2 w-100"--}}
    {{--                                          src="{{asset("shop/assets/images/ads/one-col-1.jpg")}}" alt=""></section>--}}
    {{--            </section>--}}

    {{--        </section>--}}
    {{--    </section>--}}



    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center py-2">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme">

                            @foreach($brands as $brand)
                                <section class="item">
                                    <section class="brand-item">
                                        <a href="#"><img class="rounded-2" src="{{$brand->image?->path}}" alt=""></a>
                                    </section>
                                </section>
                            @endforeach

                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>

@endsection
