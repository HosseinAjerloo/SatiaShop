@include('Admin.Layout.head')
<body class="overflow-x-hidden">

@include('Admin.Layout.header')
@yield('header')

<main class="py-8 container mx-auto relative">
    <div class="editPro w-full  h-full sm:w-1/2 sm:h-1/2 backdrop-blur-md absolute top-1/2 left-1/2  rounded-lg  p-3">
        <div class="w-full h-full shadow shadow-black/35">
            <div class="font-bold text-2xl py-4 flex justify-center ">
                ویرایش طلاعات کاربر
            </div>

            <form action="" class="w-full flex mt-5  ">
                <section class="flex-wrap flex w-full  ">
                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">نام:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>
                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">نام خانوادگی:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>

                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">شماره ثابت:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>
                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">شماره موبایل:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>

                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">کدملی:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>
                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">ایمیل:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>


                    <div class="w-full  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">رمز عبوری قبلی:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>
                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">رمز عبور جدید:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>
                    <div class="w-full xl:w-1/2  flex justify-center items-center mt-5">
                        <label class="text-black w-3/12">تکرار رمز عبور جدید:</label>
                        <input type="text" value="" class="w-4/6 px-2 py-1.5 border border-black rounded-md">
                    </div>

                    <div class="w-full xl:w-1/2 flex-wrap flex justify-center items-center mt-5">
                        <label class="text-black w-full">ادرس:</label>
                        <textarea>

                        </textarea>

                    </div>

                </section>
            </form>
        </div>

    </div>
    @if(isset($breadcrumbs))
        <section class=" hidden sm:flex">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white rounded-2">
                            <x-breadcrumb :breadcrumbs="$breadcrumbs"
                                          class="px-6 h-[30px] bg-2081F2  text-min text-center  breadcrumb flex items-center justify-center text-white before:bg-2081F2"/>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    @endif
    @yield('content')
</main>


@include('Admin.Layout.script')
@yield('script')
@stack('search')

</body>

@include('Admin.Layout.footer')
