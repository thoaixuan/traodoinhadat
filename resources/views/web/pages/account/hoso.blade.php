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
                    <form id="formProfile" class="" action="{{ route('web.account.update') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        @if (user()->email_verified_token!=NULL)
                                        <div class="form-group">
                                            <div class="alert alert-warning text-small alert-dismissible" role="alert">
                                                Vui lòng kiểm tra email để xác thực !
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="email" >Email
                                                @if (user()->email_verified_token!=NULL)
                                                    <small class="text-danger"><b>(Chưa xác thực mail !)</b></small>
                                                @else
                                                    <small class="text-success"><b>(Đã xác thực)</b> </small>
                                                @endif
                                            </label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{user()->email}}" placeholder="Email ... ">
                                        </div>
                                        <div class="form-group ">
                                            <label for="phone" >Số Điện Thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{user()->phone}}" placeholder="Số ĐT ... ">
                                        </div>
                                        <div class="form-group ">
                                            <label for="full_name" >Họ Tên</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{user()->full_name}}" placeholder="Họ tên ... ">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName2" >Giới Tính</label>
                                            <select name="sex" class="form-control">
                                                <option {{user()->sex=='male'?'selected':''}}value="male">Nam</option>
                                                <option {{user()->sex=='female'?'selected':''}}value="female">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="birthday" >Ngày Sinh</label>
                                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{user()->birthday}}" placeholder="Ngày sinh">
                                        </div>
                                        <div class="form-group ">
                                            <label for="address" >Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{user()->address}}" placeholder="Địa chỉ ... ">
                                        </div>
                                        <div class="form-group ">
                                            <label for="about" >Giới thiệu </label>
                                            <input type="text" class="form-control" id="about" name="about" value="{{user()->about}}" placeholder="Giới thiệu ... ">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                            <div class="border border-default rounded pl-2 pr-2">
                                                <div class="form-groupr">
                                                    <label class="card-title">Thông tin chứng minh nhân dân</label>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="birthday" >CMND</label>
                                                    <input type="text" class="form-control" id="cmnd_number" name="cmnd_number" value="{{user()->cmnd_number}}" placeholder="Số CMND ... ">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="address" >Ngày cấp</label>
                                                    <input type="date" class="form-control" id="cmnd_date" name="cmnd_date" value="{{user()->cmnd_date}}" placeholder="Ngày cấp ... ">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="address" >Nới cấp</label>
                                                    <input type="text" class="form-control" id="cmnd_address" name="cmnd_address" value="{{user()->cmnd_address}}" placeholder="Nơi cấp ... ">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="onSaveProfile" class="btn btn-success px-4">Cập nhật thông tin</button>
                            </div>
                        </div>
                    </form>
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
