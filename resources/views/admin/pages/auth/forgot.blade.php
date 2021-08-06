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
    @yield('runCSS')
</head>
<body class="login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-dark">
      <div class="card-header text-center">
        <img width="100%" src="{{asset('uploads/defaults/logo_ing.png')}}" alt="{{setting()->name}}"/>
      </div>
      <div class="card-body login-card-body">
        <div class="callout callout-warning">
            <p>Nhập email của bạn để lấy lại mật khẩu !</p>
        </div>
        <form action="{{route('admin.forgot.index') }}" method="POST">

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
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" required name="email" placeholder="Nhập email của bạn .... ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-block" >Gửi</button>
            </div>
        </form>
    </div>
    <div class="card-footer text-center">
        <strong>Copyright &copy; 2020-{{ date('Y') }} <a href="{{ route('web.home.index') }}">{{ setting()->name }}</a>.</strong> All rights reserved.
    </div>
    </div>
    <!-- /.card -->
  </div>

@include('admin.includes.script')
@yield('runJS')
</body>
</html>


