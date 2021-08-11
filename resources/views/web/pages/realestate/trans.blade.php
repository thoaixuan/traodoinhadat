@extends('web.layouts.page')
@section('page')
        <!-- Nội dung trao đổi -->
        <section class="bl-content">
            <div class="dang-tin">
                <!-- Form Đăng Tin -->
                <div class="container-fluid content-dangtin dang-tin-owner-logged">
                    <h2 class="title-dangtin">Thông tin BĐS cần trao đổi.</h2>
                    <h5>BĐS đổi hiện tại : Title Post</h5>
                    <div class="bl-info-credibility send-post">
                        <div class="row">
                            <form id="formAction" action="{{route('web.realestate.ajaxSend')}}">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class=" control-label"> 
                                                    <span class="text">Khoảng giá trị bạn muốn trao đổi <strong class="color-red">*</strong></span>
                                                </label>
                                                    <input type="text" name="khoanggiatri" class="form-control" placeholder="Điền giá trị gần như tương đương BĐS bạn muốn đổi ...">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @include('web.includes.search.khuvuc-trans')
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    @include('web.pages.realestate.includes.loaihinh-giaodich')
                                                </div>
                                                <div class="col-md-6">
                                                    @include('web.pages.realestate.includes.mota')
                                                    <label>Mô tả chi tiết yêu cầu BĐS bạn cần trao đổi.</label>
                                                </div>
                                                <div class="col-md-6 control-label">
                                                    <label class="text">Lưu ý <strong class="color-red">*</strong>
                                                    </label>
                                                    <p>Trao đổi Bất Động Sản đang cần bán với một Bất Động Sản khác.
                                                        <br/>Trao đổi phòng trọ/căn hộ đang cho thuê với một Bất Động Sản khác.
                                                        <br/> Chúng tôi tiếp nhận yêu cầu và liên hệ ngay khi có thông tin phù hợp với yêu cầu của bạn!.
                                                    </p>
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
                                                                    <a  href="" target="_bank"> điều khoản sử dụng</a> và
                                                                    <span id="price-button">
                                                                        <a href="" target="_bank">biểu phí giao dịch</a>
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
                                                <button type="button" class="btn btn-danger" >Gửi Thông Tin</button>
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
