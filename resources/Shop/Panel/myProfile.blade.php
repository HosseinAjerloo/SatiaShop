@extends('Panel.Layout.Master')

@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <!-- start sidebar nav-->
                        <section class="sidebar-nav">
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3"
                                                                        href="my-orders.html">سفارش های من</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3"
                                                                        href="my-addresses.html">آدرس های من</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3" href="my-favorites.html">لیست علاقه مندی</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3"
                                                                        href="my-profile.html">ویرایش حساب</a></span>
                            </section>
                            <section class="sidebar-nav-item">
                                <span class="sidebar-nav-item-title"><a class="p-3"
                                                                        href="#">خروج از حساب کاربری</a></span>
                            </section>

                        </section>
                        <!--end sidebar nav-->
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <section class="content-header mb-4 py-2">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>اطلاعات حساب</span>
                                </h2>
                                <section class="content-header-link">
                                </section>
                            </section>
                        </section>

                        <section class="d-flex justify-content-end my-4" type="button" data-bs-toggle="modal"
                                 data-bs-target="#edit-profile">
                            <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" href="#">
                                <i class="fa fa-edit px-1"></i>
                                ویرایش حساب</a>
                        </section>
                        <section class="address-add-wrapper">

                            <section class="modal fade" id="edit-profile" tabindex="-1"
                                     aria-labelledby="edit-profile-user" aria-hidden="true">
                                <section class="modal-dialog">
                                    <section class="modal-content">
                                        <section class="modal-header">
                                            <h5 class="modal-title" id="edit-profile-user">
                                                <i class="fa fa-edit px-1"></i>
                                                ویرایش اطلاعات کاربری</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </section>
                                        <section class="modal-body">
                                            <form class="row" action="#">

                                                <section class="col-12 mb-2">
                                                    <label for="address" class="form-label mb-1">نشانی</label>
                                                    <input type="text" class="form-control form-control-sm" id="address"
                                                           placeholder="نشانی"
                                                           value="{{\Illuminate\Support\Facades\Auth::user()->address??''}}">

                                                </section>


                                                <section class="border-bottom mt-2 mb-3"></section>


                                                <section class="col-6 mb-2">
                                                    <label for="first_name" class="form-label mb-1">نام </label>
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="first_name" placeholder="نام " name="name"
                                                    value="{{\Illuminate\Support\Facades\Auth::user()->name??''}}">
                                                </section>

                                                <section class="col-6 mb-2">
                                                    <label for="last_name" class="form-label mb-1">نام خانوادگی</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                           id="last_name" placeholder="نام خانوادگی " name="family"
                                                           value="{{\Illuminate\Support\Facades\Auth::user()->family??''}}">

                                                </section>

                                                <section class="col-6 mb-2">
                                                    <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                    <input type="text" class="form-control form-control-sm" id="mobile"
                                                           placeholder="شماره موبایل"
                                                           value="{{\Illuminate\Support\Facades\Auth::user()->mobile??''}}">

                                                </section>
                                                <section class="col-6 mb-2">
                                                    <label for="mobile" class="form-label mb-1">شماره ثابت</label>
                                                    <input type="text" class="form-control form-control-sm" id="mobile"
                                                           value="{{\Illuminate\Support\Facades\Auth::user()->tel??''}}">
                                                </section>

                                                <section class="col-6 mb-2">
                                                    <label for="mobile" class="form-label mb-1">ایمیل</label>
                                                    <input type="text" class="form-control form-control-sm" id="mobile"
                                                           placeholder="ایمیل"
                                                           value="{{\Illuminate\Support\Facades\Auth::user()->email??''}}">
                                                </section>


                                            </form>
                                        </section>
                                        <section class="modal-footer py-1">
                                            <button type="button" class="btn btn-sm btn-primary">ثبت ویرایش</button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                                                بستن
                                            </button>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <!-- end add address Modal -->
                        </section>


                        <section class="row">
                            <section class="col-6 border-bottom mb-2 py-2">
                                <section class="field-title">نام</section>
                                <section
                                    class="field-value overflow-auto">{{\Illuminate\Support\Facades\Auth::user()->fullName??""}}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">نام خانوادگی</section>
                                <section class="field-value overflow-auto">
                                    {{\Illuminate\Support\Facades\Auth::user()->family??''}}
                                </section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">شماره تلفن همراه</section>
                                <section class="field-value overflow-auto">
                                    {{\Illuminate\Support\Facades\Auth::user()->mobile??''}}

                                </section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">ایمیل</section>
                                <section class="field-value overflow-auto">
                                    {{\Illuminate\Support\Facades\Auth::user()->email??''}}
                                </section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">کد ملی</section>
                                <section class="field-value overflow-auto">
                                    {{\Illuminate\Support\Facades\Auth::user()->national_code??''}}
                                </section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">رمز عبور</section>
                                <section class="field-value overflow-auto"> ---</section>
                            </section>

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>

@endsection
