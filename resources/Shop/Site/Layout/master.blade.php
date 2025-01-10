@include('Site.Layout.head')
<body class="overflow-x-hidden">
@include('Site.Layout.header')
@yield('header')

<main class="py-8">
@yield('content')
</main>


@include('Site.Layout.script')
@yield('script')
</body>

@include('Site.Layout.footer')
