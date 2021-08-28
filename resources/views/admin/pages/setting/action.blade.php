@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fulld">
        <form value="{{setting()->id}}" action="{{route('admin.setting.edit')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-dark ">
                        <div class="card-header">
                            <h3 class="card-title">CÀI ĐẶT CHUNG</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">THIẾP LẬP HỆ THỐNG</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <label for="title" >Tiêu đề website</label>
                                                        <input type="text" class="form-control" id="title" name="title" value="{{setting()->title}}" placeholder="Tiêu đề website... ">
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="name" >Tên website</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{setting()->name}}" placeholder="Tên website... ">
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <label for="post_page_number" >Bài viết trên 1 trang</label>
                                                        <input type="number" class="form-control" id="post_page_number" name="post_page_number" value="{{setting()->post_page_number}}" placeholder="Số bài viết trên 1 trang ... ">
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <label for="route_admin" >Đường dẫn hệ thống</label>
                                                        <input type="text" class="form-control" id="route_admin" name="route_admin" value="{{setting()->route_admin}}" placeholder="Tên đương dẫn hệ thống ... ">
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <label for="route_login" >Đường dẫn đăng nhập hệ thống</label>
                                                        <input type="text" class="form-control" id="route_login" name="route_login" value="{{setting()->route_login}}" placeholder="Tên đương dẫn đăng nhập ... ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-dark">
                                        <div class="card-header  ">
                                            <h3 class="card-title text-center">Khu vực hoạt động</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="provinceID" class=" col-form-label ">Tỉnh/thành</label>
                                                    <select name="provinceID" id="provinceID" class="form-control select2">
                                                        <option {{ setting()->provinceID==""?'selected':'' }} value="">- Chọn tỉnh thành -</option>
                                                        @foreach (getProvinces() as $item)
                                                        <option  value="{{ $item->id }}">{{ $item->province_name }}</option>
                                                        @endforeach
                                                </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="districtID" class=" col-form-label ">Quận/huyện</label>
                                                    <select name="districtID" id="districtID" class="form-control select2">
                                                        <option value="">- Chọn quận huyện -</option>
                                                </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="wardID" class=" col-form-label ">Phường/xã</label>
                                                    <select name="wardID" id="wardID" class="form-control select2">
                                                        <option value="">- Chọn phường xã -</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">THÔNG TIN LIÊN HỆ</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="contact_mail" >Email</label>
                                                        <input type="text" class="form-control" id="contact_mail" name="contact_mail" value="{{setting()->contact_mail}}" placeholder="Email... ">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="contact_phone" >Số ĐT</label>
                                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{setting()->contact_phone}}" placeholder="Số điện thoại... ">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="contact_address" >Địa chỉ</label>
                                                        <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{setting()->contact_address}}" placeholder="Địa chỉ ... ">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="name" >Google Map (iframe)</label>
                                                        <textarea rows="3" type="text" class="form-control text-left" id="iframe_map" name="iframe_map"  placeholder="Iframe map ... ">
                                                            {!! setting()->iframe_map !!}
                                                        </textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">EMAIL</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-4 ">
                                                        <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_DRIVER</label>
                                                        <input type="text" class="form-control" name="MAIL_DRIVER" value="{{setting()->MAIL_DRIVER}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_HOST</label>
                                                        <input type="text" class="form-control" name="MAIL_HOST" value="{{setting()->MAIL_HOST}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_PORT</label>
                                                        <input type="text" class="form-control" name="MAIL_PORT" value="{{setting()->MAIL_PORT}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group ">
                                                            <label for="address" class=" col-form-label">MAIL_FROM_ADDRESS</label>
                                                            <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{setting()->MAIL_FROM_ADDRESS}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group ">
                                                        <label for="address" class=" col-form-label">MAIL_FROM_NAME</label>
                                                        <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{setting()->MAIL_FROM_NAME}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group ">
                                                            <label for="address" class=" col-form-label">MAIL_ENCRYPTION</label>
                                                            <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{setting()->MAIL_ENCRYPTION}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group ">
                                                            <label for="address" class=" col-form-label">MAIL_USERNAME</label>
                                                            <input type="text" class="form-control" name="MAIL_USERNAME" value="{{setting()->MAIL_USERNAME}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group ">
                                                            <label for="address" class=" col-form-label">MAIL_PASSWORD</label>
                                                            <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{setting()->MAIL_PASSWORD}}" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <div class="form-group ">
                                                                <label for="address" class=" col-form-label">MAIL_RECEIVE</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="MAIL_RECEIVE" value="{{setting()->MAIL_RECEIVE}}" />
                                                                    <button type="button" id="testSenMail" class="btn btn-info btn-flat">Gửi</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div id="alertJSTestMail"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label for="contact_status" class=" col-form-label ">Thôn báo liên hệ trên Email</label>
                                                        <select type="text" class="form-control" name="contact_status">
                                                            <option  {{setting()->contact_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->contact_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">ĐĂNG NHẬP MẠNG XÃ HỘI</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">FACEBOOK</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group ">
                                                        <label for="facebook_status" class=" col-form-label ">Trạng thái</label>
                                                        <select type="text" class="form-control" name="facebook_status">
                                                            <option  {{setting()->facebook_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->facebook_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="facebook_client_id" class=" col-form-label ">Facebook client id</label>
                                                        <input type="text" class="form-control" name="facebook_client_id" placeholder="App ID ..." value="{{setting()->facebook_client_id}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="facebook_client_secret" class=" col-form-label ">Facebook client secret </label>
                                                        <input type="text" class="form-control" name="facebook_client_secret" placeholder="secret ... " value="{{setting()->facebook_client_secret}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="facebook_redirect" class=" col-form-label ">Facebook redirect  (HomepageURL/oauth/facebook/callback)</label>
                                                        <input type="text" readonly class="form-control" placeholder="..." name="facebook_redirect" placeholder=".." value="{{route('web.social.callback','facebook')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card  card-danger">
                                                <div class="card-header">
                                                    <h3 class="card-title">GOOGLE</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="google_status" class=" col-form-label ">Trạng thái</label>
                                                        <select type="text" class="form-control" name="google_status">
                                                            <option  {{setting()->google_status=='off'?'selected':''}} value="off">Tắt</option>
                                                            <option  {{setting()->google_status=='on'?'selected':''}} value="on">Bật</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="google_client_id" class=" col-form-label text-danger">Google client id</label>
                                                        <input type="text" class="form-control" placeholder="App ID ..."  name="google_client_id" value="{{setting()->google_client_id}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="google_client_secret" class=" col-form-label text-danger">Google client secret </label>
                                                        <input type="text" class="form-control" placeholder="secret ..." name="google_client_secret" value="{{setting()->google_client_secret}}" />
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="google_redirect" class=" col-form-label text-danger">Google redirect (HomepageURL/oauth/google/callback) </label>
                                                        <input type="text" readonly class="form-control" placeholder="...." name="google_redirect" value="{{route('web.social.callback','google')}}" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-sm-4">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">HÌNH ẢNH</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body " >
                                            <label>ICON</label>
                                            <div  class="post-select-image-container"  id="change_icon">
                                                <label class="btn-select-image"  >
                                                    @if ( file_exists(public_path(setting()->icon))&&setting()->icon!="")
                                                    <img id="icon_review"  height="100%" width="100%" src="{{asset(setting()->icon)}}"/>
                                                    @else
                                                    <img id="icon_review"  height="100%" width="100%" src="{{asset('uploads/defaults/default_img.jpg')}}"/>
                                                    @endif
                                                    <div class="btn-select-image-inner">
                                                    </div>
                                                </label>
                                            </div>
                                            <input class="d-none" type="file" name="file_icon" id="file_icon">
                                            <label>LOGO</label>
                                            <div  class="post-select-image-container" id="change_logo">
                                                <label class="btn-select-image" >
                                                    @if ( file_exists(public_path(setting()->logo))&&setting()->logo!="")
                                                    <img id="logo_review" height="100%"  width="100%" src="{{asset(setting()->logo)}}"/>
                                                    @else
                                                    <img id="logo_review" height="100%"  width="100%" src="{{asset('uploads/defaults/no_img.webp')}}"/>
                                                    @endif
                                                    <div class="btn-select-image-inner">
                                                    </div>
                                                </label>
                                            </div>
                                            <input class="d-none" type="file" name="file_logo" id="file_logo">
                                        </div>
                                        <div class="card-footer">
                                            <div class="">
                                                <a href="{{route('admin.dashboard.view')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                                <button type="button"   class="btn btn-success onSaveSetting">Lưu</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="">
                                <a href="{{route('admin.dashboard.view')}}" class="btn btn-danger float-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                <button type="button"   class="btn btn-success onSaveSetting">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('runCSS')
<style>
.form-group {
    margin-bottom: 0rem;
}
</style>
@endsection
@section('runJS')
<script src="{{asset('admin/setting/setting.js')}}"></script>
<script>
   var setting = new setting();
   setting.datas={
        provinceID : "{{setting()->provinceID}}",
        districtID : "{{setting()->districtID}}",
        wardID : "{{setting()->wardID}}",
        districtAjax:"{{route('admin.area.districtAjax')}}",
        wardAjax:"{{route('admin.area.wardAjax')}}",
   }
   setting.init();
</script>
@endsection
