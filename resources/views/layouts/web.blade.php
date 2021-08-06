<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="_8PR24kqrIqSwNO1life8BsnAZNgNxwEngzY1tLsIWk" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    @include('includes.icon')
    @include('web.includes.css')
    @yield('runCSS')
</head>
<body class="hold-transition  layout-fixed   layout-navbar-fixed  layout-footer-fixed text-sm ">

    <div class="wrapper ">
        @include('includes.loading')
        @include('web.includes.header')
        @include('web.includes.sidebar')
        <div class="content-wrapper">
            <br>
            <section class="content">
                    @if (session('status'))
                        <div class="alert alert-warning text-small alert-dismissible" role="alert"> <i class="icon fas fa-exclamation-triangle"></i> {{session('status')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    @endif
                    @if (session('status_confirmMail'))
                        <div class="alert alert-success text-small alert-dismissible" role="alert"> <i class="icon fas fa-check"></i> {{session('status_confirmMail')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    @endif

            </section>
            @yield('web')
        </div>
        @include('web.includes.footer')
    </div>
    @include('web.includes.script')
    {{-- <script async src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.1/dist/lazyload.min.js"></script> --}}
    @yield('runJS')
    @yield('runJSFollow')
    {!! setting()->Google_Analytics!!}
    {!! setting()->AdSense!!}

</body>
</html>
