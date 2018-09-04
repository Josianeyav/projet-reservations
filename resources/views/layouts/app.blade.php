<html>
<head>
    <title>Projet réservations - @yield('title')</title>
    @include('feed::links')
    @include('layouts.css')
    @yield('stylesheets')
</head>
<body>
@include('layouts.header')
{{--@include('layouts.menu')--}}


<div class="container">
    @if (session('status'))
        <div class="alert alert-success message" id="flashMessage">
            {{ session('status') }}
        </div>
    @endif
</div>
@yield('content')

@include('layouts.footer')

@include('layouts.js')
@yield('javascript')
</body>
</html>