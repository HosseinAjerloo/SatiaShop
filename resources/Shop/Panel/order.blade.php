@extends('Panel.Layout.Master')
@section('content')

    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <!-- start sidebar nav-->
                        <section class="sidebar-nav">
{{--                            <section class="sidebar-nav-item">--}}
{{--                                <span class="sidebar-nav-item-title"><a class="p-3" href="my-orders.html">سفارش های من</a></span>--}}
{{--                            </section>--}}
{{--                            <section class="sidebar-nav-item">--}}
{{--                                <span class="sidebar-nav-item-title"><a class="p-3" href="my-addresses.html">آدرس های من</a></span>--}}
{{--                            </section>--}}
{{--                            <section class="sidebar-nav-item">--}}
{{--                                <span class="sidebar-nav-item-title"><a class="p-3" href="my-favorites.html">لیست علاقه مندی</a></span>--}}
{{--                            </section>--}}
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3" href="my-profile.html">ویرایش حساب</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3" href="{{route('logout')}}">خروج از حساب کاربری</a></span>
                            </section>

                        </section>
                        <!--end sidebar nav-->
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2 space-y-5">

                        <!-- start vontent header -->
                        <section class="content-header py-2">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه سفارشات</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->





                        <!-- start content header -->
                        <section class="content-header mb-">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    در انتظار پرداخت
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->


                        @foreach($invoices as $invoice)
                            <section class="order-wrapper">

                                <section class="order-item">
                                    <section class="d-flex justify-content-center my-4">
{{--                                        <a class="btn btn-info btn-sm mx-1" href="#">در انتظار پرداخت</a>--}}
{{--                                        <a class="btn btn-warning btn-sm mx-1" href="#">در حال پردازش</a>--}}

                                        <a class="btn  btn-sm mx-1 @if($invoice->statusPayment()) btn-success @else btn btn-danger  @endif" href="#">
                                            @if($invoice->statusPayment())
                                                پرداخت شده
                                            @else
                                                پرداخت ناموفق
                                            @endif
                                        </a>

{{--                                        <a class="btn btn-dark btn-sm mx-1" href="#">لغو شده</a>--}}
                                    </section>
                                    <section class="d-flex justify-content-between">
                                        <section>
                                            <section class="order-item-date"><i class="fa fa-calendar-alt"></i> {{$invoice->invoiceDate()}}</section>
                                            <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد سفارش : {{$invoice->id}}</section>
                                            <section class="order-item-status"><i class="fa fa-clock"></i>{{$invoice->invoiceTime()}}</section>
                                            <section class="order-item-status"><i class="fa fa-sticky-note"></i>{{$invoice->description}}</section>
                                            <section class="order-item-products">
                                                @foreach($invoice->invoiceItem as $invoiceItem)
                                                    <a href="#"><img src="{{asset($invoiceItem->product->image->path??'')}}" alt=""></a>
                                                @endforeach
                                            </section>
                                        </section>
                                        <section class="order-item-link"><a href="#">وضعیت پرداخت</a></section>
                                    </section>
                                </section>
                            </section>
                        @endforeach


                    </section>
                </main>
            </section>
        </section>
    </section>


@endsection
