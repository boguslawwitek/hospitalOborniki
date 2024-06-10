<!DOCTYPE html>
<html lang="pl">
<head>
   @include('includes.head')
   @yield('additional_css')
</head>
<body>
    <div id="root-theme" class="small">
        @include('includes.mobile-nav')
        @include('includes.header')
        @include('includes.desktop-nav')
            @yield('content')
        @include('includes.footer')
    </div>
    @yield('additional_js')
</body>
</html>