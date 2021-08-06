

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
                    <div class="card card-body">
                        @if (session('status_login_lock'))
                                    <div class="alert alert-info text-small alert-dismissible" role="alert">{{session('status_login_lock')}} <button type="button" class="close" data-dismiss="alert"></button></div>
                            @endif
                        <form id="formAction" action="{{ route('web.contact.sendContact') }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input name="full_name" readonly value="{{ user()->full_name }}" type="text" class="form-control" id="full_name"
                                        placeholder="Họ và tên">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input name="email" readonly value="{{ user()->email }}" type="email" class="form-control" id="email"
                                        placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <input name="phone"  value="{{ user()->phone }}" type="tel" class="form-control phone-validate" id="phone"
                                        placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <input name="title" type="text" class="form-control" id="title"
                                        placeholder="Tiêu đề">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <textarea name="body" id="body" class="form-control" rows="3"
                                        placeholder="Nội dung .... "></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div id="alertJS"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button id="sendContact" type="button"  class="btn btn-info">Gửi</button>
                            </div>
                        </form>

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
