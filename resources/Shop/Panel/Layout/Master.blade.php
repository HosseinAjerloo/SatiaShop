@include('Panel.Layout.head')
<body>


@include('Panel.Layout.header')

@include('Toast.error')
@include('Toast.success')


<main id="main-body-one-col" class="main-body">

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
