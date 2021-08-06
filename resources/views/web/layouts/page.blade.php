<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('themes/web/img/favico.png') }}" />
    {!! SEO::generate() !!}
    @include('web.includes.style')
</head>
<body>
    <div id="wrapper">
        <!-- PANEL -->
        @include('web.includes.panel')
        @include('web.includes.header')
        <!-- HEADER -->
        <!-- Menu Mobile - Ipad -->
        @include('web.includes.mobile')
        <!-- Menu Mobile - Ipad -->
        <!-- Search banner Mobile Ipad -->
        @include('web.includes.search-mobile')
        <!-- Search banner Mobile Ipad -->
        <!-- Filter search -->
        @include('web.includes.filter-search')
        <!-- Filter search -->
        @yield('page')
        <!-- Footer -->
        @include('web.includes.footer')
        <!-- Footer -->
        <!-- Social button -->
        @include('web.includes.social-button')
        <!-- Social button -->
        <!-- Footer Mobile -->
        @include('web.includes.footer-mobile')
        <!-- Footer Mobile -->

    </div>
    <!-- Modal Login -->
    @include('web.includes.popup-login')
    <!-- Modal Login -->
    <!-- Modal Signup -->
    @include('web.includes.popup-signup')
    <!-- Modal Signup -->
    <!-- Modal Forgot password -->
    @include('web.includes.popup-forgot-password')
    <!-- Modal Forgot password -->
    <!-- Modal Search Mobile -->
    @include('web.includes.modalSearch-mobile')
    @include('web.includes.modalDelete')
    @include('web.includes.script')
</body>
</html>
