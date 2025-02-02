@include('Admin.Layout.head')
<body class="overflow-x-hidden">
@include('Admin.Layout.header')
@yield('header')

<main class="py-8">

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
</body>

@include('Admin.Layout.footer')
