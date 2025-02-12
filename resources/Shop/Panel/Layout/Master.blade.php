@include('Panel.Layout.head')
<body>


@include('Panel.Layout.header')

@include('Toast.error')
@include('Toast.success')
@include('Panel.SweetAlert.success')
@include('Panel.SweetAlert.error')



<main id="main-body-one-col" class="main-body">
    @if(isset($breadcrumbs))
        <section class="mb-8  hidden sm:flex">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <x-breadcrumb :breadcrumbs="$breadcrumbs"
                                          class="px-6 h-[30px] bg-ff253a  text-min text-center  breadcrumb flex items-center justify-center text-white before:bg-ff253a"/>

                        </section>
                    </section>
                </section>
            </section>
        </section>
    @endif
    @yield('content')

</main>


<section class="container-xxl body-container">
    <aside id="sidebar" class="sidebar">

    </aside>
    <main id="main-body" class="main-body">

    </main>
</section>


@include('Panel.Layout.footer')
@include('Panel.Layout.script')
@yield('script')

</body>
</html>
