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
    <style>
    .form-group {
        margin-bottom: 5px;
    }
    </style>
</head>
<body class="login-page">
<div class="login-box">
    <div class="card card-outline card-dark">
      <div class="card-header text-center">
        <img width="100%" src="{{asset('uploads/defaults/logo_ing.png')}}" alt="{{setting()->name}}"/>
      </div>
      <div class="card-body ">
        <div class="form-group">
            <div id="alertJS">

            </div>
        </div>
        <form id="formChangePass" action="{{ route('web.forgot.changePassWord') }}">
            <div class="form-group ">
                <label for="new_password">Nhập mật khẩu mới <span class="text-danger old_password"></span>
                </label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="...">
            </div>
            <div class="form-group ">
                <label for="re_password" class="">Xác nhận lại mật khẩu mới <span class="text-danger old_password"></span>
                </label>
                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="...">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control"  value="{{ $token }}" id="token" name="token" placeholder="...">
                <button type="submit" id="formChangePass" class="btn btn-info btn-block" >Gửi</button>
                <a href="{{ route('web.home.index') }}"  class="btn btn-block btn-danger" >Trag chủ</a>
            </div>
        </form>
    </div>
    <div class="card-footer text-center">
        <strong>Copyright &copy; 2020-{{ date('Y') }} <a href="{{ route('web.home.index') }}">{{ setting()->name }}</a>.</strong> All rights reserved.
    </div>
    </div>
  </div>
@include('web.includes.script')
<script src="{{asset('admin/auth/pass.js')}}"></script>
<script>
   var pass = new pass();
   pass.datas={};
   pass.init();
</script>
</body>
</html>


