

@extends('web.layouts.page')
@section('page')
<div class="my-account-page">
    <div class="container-fluid">
        <div class="my-account">
            <div class="row">
                <div class="col-md-3 col-sm-4 ">
                    @include('web.pages.account.includes.menu')
                </div>
                <div class="col-md-9 col-sm-8">
                    @if (session('status_login_lock'))
                                    <div class="alert alert-info text-small alert-dismissible" role="alert">{{session('status_login_lock')}} <button type="button" class="close" data-dismiss="alert"></button></div>
                            @endif
                    <div class="card">
                        <div class="card-body">
                            <form id="formChangePass" action="{{route('web.account.changePass')}}">
                                <div class="card card-body">
                                    <div class="form-group">
                                        <div class="alertJSChangePass">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="old_password">Nhập lại mật khẩu củ <span class="text-danger old_password"></span>
                                        </label>
                                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="...">
                                    </div>
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

                                </div>
                                <div class="card card-footer">
                                        <button type="submit" id="onSaveChangePass" class="btn btn-success">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('web.includes.service_subfooter')
@endsection
@section('runJS')
@parent
<link rel="stylesheet" href="{{asset('themes/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}?v={{ time() }}">
<link rel="stylesheet" href="{{asset('themes/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}?v={{ time() }}">
@endsection
@section('runJS')
@parent
<script src="{{asset('themes/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('themes/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('themes/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('themes/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('web/account/account.js')}}"></script>
<script>
   var account = new account();
   account.datas={
        type:"{{ $type }}",
   }
   account.init();
</script>
@endsection
