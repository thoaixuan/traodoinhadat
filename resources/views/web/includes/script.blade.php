    @php
        $antispam = getAntispam();
    @endphp
    @include('web.includes.antispam')
    <script>
        var url_loading  = "";
        var show_data  = "";
        var breadcrumbs=@json(breadcrumbs());
        var AntispamJSON = {
            url:"",
            form:"",
            button:"",
            alertJS:"",
            resultAntispam:"{{$antispam->resultAntispam}}",
            resultMath:""
        };
    </script>
    <script src="{{ asset('themes/web/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('themes/web/js/slick/slick.min.js')}}"></script>
    <script src="{{ asset('themes/web/js/popper.min.js')}}"></script>
    <script src="{{ asset('themes/web/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('themes/web/js/main.js')}}"></script>
    <script src="{{ asset('main/web/main.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('runJS')
