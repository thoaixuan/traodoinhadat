@extends('web.layouts.page')
@section('page')
        <!-- Nội dung đăng tin -->
        <section class="bl-content">
            <div class="dang-tin">
                @include('web.pages.realestate.includes.banner')
                <div class="bl-choose-title">
                    <button value="is-owner" disabled  class="btn is-button {{ (user()->loai_hinh_thuc_bds=='chu_nha'?'active':'') }}">Chủ Nhà</button>
                    <button value="is-agent" disabled  class="btn is-button {{ (user()->loai_hinh_thuc_bds=='moi_gioi'?'active':'') }}">Môi Giới</button>
                </div>
                <!-- Form Đăng Tin -->
                <div class="container-fluid content-dangtin dang-tin-owner-logged">
                    <h2 class="title-dangtin">Thông tin BĐS</h2>
                    <div class="bl-info-credibility send-post">
                        <div class="row">
                            <form id="formAction" action="{{route('web.realestate.ajaxSend')}}">

                                    <input type="hidden" id="loai_hinh_thuc_bds" value="{{(user()->loai_hinh_thuc_bds)}}" name="loai_hinh_thuc_bds"/>
                                    <div class="col-md-12" id="is-agent" style="display: {{ (user()->loai_hinh_thuc_bds=='moi_gioi'?'block':'none') }};">
                                        @include('web.pages.realestate.includes.mogioi')
                                    </div>
                                    <div class="col-md-12">
                                        @include('web.pages.realestate.includes.loaihinh-giaodich')
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('web.pages.realestate.includes.giatien')
                                            </div>
                                            <div class="col-md-6">
                                                @include('web.pages.realestate.includes.khuvuc')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-upload">
                                        @include('web.pages.realestate.includes.upload-image')
                                    </div>
                                    <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="trans-block">
                                                        <label class="col-sm-12 control-label"> <span class="text">Thông tin Bất Động Sản bạn mốn trao đổi </span> </label>
                                                        <label> Loại bất động sản </label>
                                                        <select class="form-control" name="traodoi_type">
                                                            <option value="datnen">Đất nền</option>
                                                            <option value="ccch">Chung cư/ Căn hộ</option>
                                                            <option value="nharieng">Nhà riêng</option>
                                                        </select>
                                                        <label class="fix-mb"> Khu vực </label>
                                                        <input name="traodoi_locate" id="traodoi_locate" class="form-control" type="text" placeholder="Khu vực bạn muốn tìm BĐS trao đổi" autocomplete="off">
                                                        <label class="fix-mb"> Khoảng giá </label>
                                                        <input name="traodoi_price" id="traodoi_price" class="form-control" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="Nhập khoảng giá bạn mong muốn" >  
                                                        <label class="fix-mb"> Mô tả</label>   
                                                        <textarea name="infotransbds" class="form-control" placeholder="Nhập thông tin BĐS cần trao đổi..." rows="4" maxlength ="3000"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('web.pages.realestate.includes.yeucaukhac')
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="remove-icon-bootstrap-validate">
                                                <div class="col-sm-12 padding-request">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="bl-checkbox bl-checkbox-special">
                                                                <input type="checkbox" id="require-post" class="require-post"
                                                                    checked="checked" name="requirePost" value="1">
                                                                <label class="label_active" for="require-post">&nbsp;</label>
                                                                <span id="require-post-text"> Tôi đồng ý với
                                                                    <a href="javascript:;" data-toggle="modal"
                                                                        data-target="#popup-require-post"> điều khoản sử
                                                                        dụng</a> và
                                                                    <span id="price-button">
                                                                        <a href="javasript:;" data-toggle="modal"
                                                                            data-target="#popup-require-price-buy">biểu phí giao
                                                                            dịch</a>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-button row">
                                            <div class="col-sm-12">
                                                <div id="alertJS"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="btnPublic" type="button" class="btn btn-danger" >Gửi Thông Tin</button>
                                            </div>
                                        </div>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Đăng Tin -->

            </div>
        </section>
        <!-- Nội dung đăng tin -->
@endsection
@section('runCSS')
@parent
<link rel="stylesheet" href="{{asset('themes/admin/plugins/summernote/summernote-bs4.min.css')}}?v={{ time() }}">
@endsection
@section('runJS')
@parent
<script src="{{asset('themes/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('web/realestate/action.js')}}"></script>
<script>
   var action = new action();
   action.datas={
        provinceID : "{{setting()->provinceID}}",
        districtID : "{{setting()->districtID}}",
        wardID : "{{setting()->wardID}}",
        urlListPublic :"{{route('web.account.tindagui')}}",
        loai_hinh_thuc_bds:"{{ user()->loai_hinh_thuc_bds }}"
   }
   action.init();
</script>
@endsection
