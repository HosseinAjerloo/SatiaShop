@include('Admin.Layout.head')
<body class="overflow-x-hidden">
@include('Admin.Layout.header')
@yield('header')

<main class="py-8">
@yield('content')
</main>


@include('Admin.Layout.script')
@yield('script')
</body>

@include('Admin.Layout.footer')
