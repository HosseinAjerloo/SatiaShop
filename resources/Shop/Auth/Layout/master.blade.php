@include('Auth.Layout.head')

<body class=" bg-no-repeat bg-cover" style="background-image: url({{asset('capsule/images/bg-login.jpeg')}})">
@include('Auth.Layout.header')

<main class="py-8 space-y-3">

  @yield('content')

</main>
@yield('script-tag')
</body>

@include('Auth.Layout.footer')
