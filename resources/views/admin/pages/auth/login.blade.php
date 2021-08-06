<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    @include('admin.includes.icon')
    @include('admin.includes.css')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{route('admin.auth.login')}}" class="h3"><b>ĐĂNG NHẬP</b></a>
            </div>
                <!-- /.card-header -->
            <div class="card-body " >
                    <div class="form-group">
                        <img width="100%" src="{{asset(setting()->logo)}}" alt="{{setting()->name}}"/>
                    </div>
                    @if (session('status_forgot_error'))
                        <div class="callout callout-danger">
                            <p> {{session('status_forgot_error')}}</p>
                        </div>
                        @endif
                        @if (session('status_forgot_success'))
                        <div class="callout callout-success">
                        <p> {{session('status_forgot_success')}}</p>
                        </div>
                    @endif
                    <form id="formLogin">
                    <div class="form-group">
                        <input type="text" name="phone" value="0966334404" placeholder="Email or phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" value="123456" placeholder="Mật khẩu" class="form-control">
                    </div>
                    <div class="form-group">
                        <button id="buttonLogin" data-url="{{route('admin.auth.ajaxLogin')}}" type="submit" class="btn btn-dark btn-flat btn-block">Đăng nhập</button>
                    </div>
                    </form>

            </div>
            <div class="card-footer ">
                <p class="mb-1">

                </p>
            </div>
        </div>
    </div>
    @include('admin.includes.script')
    <script src="{{asset('admin/auth/auth.js')}}"></script>
    <script>
    var auth = new auth();
    auth.datas={

    }
    auth.init();
    </script>
</body>
</html>

