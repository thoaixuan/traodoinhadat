@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        @if (Route::currentRouteName()=='admin.realestate.received.edit')
        <form value="{{$realestate->id}}" action="{{route('admin.realestate.editReceived')}}" id="formAction" name="id">
        @else
        <form value="{{$realestate->id}}" action="{{ $type=='update'?route('admin.realestate.edit'):route('admin.realestate.add')}}" id="formAction" name="id">
        @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget ">
                        <div class="card-header">
                            @if (Route::currentRouteName()=='admin.realestate.received.edit')
                                <h3 class="card-title">DUYỆT TIN</h3>
                            @else
                                <h3 class="card-title">{{ $type=='update'?'SỬA TIN':'ĐĂNG TIN' }} </h3>
                            @endif
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                                    <div class="row">
                                        <div class="col-md-8 ">
                                            @if (Route::currentRouteName()=='admin.realestate.received.edit')
                                            <div class="card ">
                                                <div class="card-header  ">
                                                    <h3 class="card-title text-center">Thông tin gửi BĐS</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <b>Người gửi </b> : {{$realestate->send_name_agent}}<br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;- <i>Số ĐT </b> : {{$realestate->send_phone_agent}}</i><br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;- <i>Email </b> : {{$realestate->send_email_agent}}</i><br>
                                                    <b>Loại BĐS </b> :{{$realestate->send_mo_gioi=='moi_gioi'?'Mô giới':'Chủ nhà'}} <br>
                                                    @if ($realestate->send_mo_gioi=='moi_gioi')
                                                        @if($realestate->send_chu_nha_full_name)&nbsp;&nbsp;&nbsp;&nbsp;- <i>Họ tên </b> : {{ $realestate->send_chu_nha_full_name }}@endif
                                                        @if($realestate->send_chu_nha_phone)&nbsp;&nbsp;&nbsp;&nbsp;- <i>Số ĐT </b> : {{ $realestate->send_chu_nha_phone }}@endif
                                                        @if($realestate->send_chu_nha_email)&nbsp;&nbsp;&nbsp;&nbsp;- <i>Email </b> : {{ $realestate->send_chu_nha_email }}@endif
                                                    @endif
                                                    <b>Loại hình GD </b> : <br>
                                                    @if($realestate->cate_type=='cate_buy')
                                                        &nbsp;&nbsp;&nbsp;&nbsp; - <i>Bán - Giá đề nghị : {{number_format($realestate->send_realestate_price)}} VNĐ</i>
                                                    @endif
                                                    @if($realestate->cate_type=='cate_lease')
                                                    Cho thuê
                                                    <br>&nbsp;&nbsp;&nbsp;&nbsp; - <i>Giá cho thuê : {{number_format($realestate->send_realestate_price)}}  VNĐ</i>
                                                    @if ($realestate->send_realestate_price_rent)
                                                    <br>&nbsp;&nbsp;&nbsp;&nbsp; - <i>Giá đặt cọc : {{number_format($realestate->send_realestate_price_rent)}} VNĐ</i>
                                                    @endif
                                                    @endif
                                                     <br>
                                                    <b>Khu vực </b> :  @if($realestate->province_name){{$realestate->province_name}}@endif @if($realestate->district_name) - {{$realestate->district_name}}@endif @if($realestate->ward_name) - {{$realestate->ward_name}}@endif <br>
                                                    <b>Địa chỉ </b> :  @if($realestate->send_house_number){{$realestate->send_house_number}}@endif @if($realestate->send_house_address) - {{$realestate->send_house_address}}@endif @if($realestate->ward_name) - {{$realestate->ward_name}}@endif <br>
                                                    <b>Ngày gửi </b> : {{time_Ago($realestate->send_realestate_time)}} - {{$realestate->created_at}}
                                                </div>
                                            </div>
                                            @endif
                                            @if (Route::currentRouteName()=='admin.realestate.received.edit')
                                            <div class="card s">
                                                <div class="card-header  ">
                                                    <h3 class="card-title text-center">Như cầu khác</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="bl-checkbox">
                                                            <input readonly type="checkbox" {{$realestate->send_nhucau_thamdinh=='on'?'checked':''}} id="request-type-2" class="request-type" value="on" name="send_nhucau_thamdinh" >
                                                            <label for="request-type-2">Thẩm định giá bất động sản</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="bl-checkbox">
                                                            <input readonly type="checkbox" {{$realestate->send_nhucau_cungcapthongtin=='on'?'checked':''}} id="request-type-3" class="request-type" value="on" name="send_nhucau_cungcapthongtin" value="3">
                                                            <label for="request-type-3">Cung cấp thông tin quy hoạch</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="bl-checkbox">
                                                            <input readonly type="checkbox" {{$realestate->send_nhucau_hoangthienhoso=='on'?'checked':''}} id="request-type-4" class="request-type" value="on" name="send_nhucau_hoangthienhoso" value="4">
                                                            <label for="request-type-4">Hoàn thiện hồ sơ pháp lý rao bán (Quyền sở hữu, tách thửa, kê khai thừa kế,...)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="card">
                                                    <div class="card-header  ">
                                                        <h3 class="card-title text-center">Thông tin chủ nhà (Nếu có)</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body ">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="send_chu_nha_full_name" class=" col-form-label ">Họ tên</label>
                                                                    <input class="form-control form-control-sm" value="{{ $realestate->send_chu_nha_full_name }}" placeholder="Họ tên ... "  id="send_chu_nha_full_name" name="send_chu_nha_full_name"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="send_chu_nha_phone" class=" col-form-label ">Số điện thoại</label>
                                                                    <input class="form-control form-control-sm" value="{{ $realestate->send_chu_nha_phone }}" placeholder="Số điện thoại ... "  id="send_chu_nha_phone" name="send_chu_nha_phone"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="send_chu_nha_email" class=" col-form-label ">Email</label>
                                                                    <input class="form-control form-control-sm" value="{{ $realestate->send_chu_nha_email }}" placeholder="Email ... "  id="send_chu_nha_email" name="send_chu_nha_email"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="card  ">
                                                <div class="card-header  ">
                                                    <h3 class="card-title text-center">Khu vực đăng tin</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">                                    <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="provinceID" class=" col-form-label ">Tỉnh/thành</label>
                                                                    <select name="provinceID" id="provinceID" class="form-control form-control-sm select2">
                                                                        <option {{ setting()->provinceID==""?'selected':'' }} value="">- Chọn tỉnh thành -</option>
                                                                        @foreach (getProvinces() as $item)
                                                                        <option  value="{{ $item->id }}">{{ $item->province_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="districtID" class=" col-form-label ">Quận/huyện</label>
                                                                    <select name="districtID" id="districtID" class="form-control form-control-sm select2">
                                                                        <option value="">- Chọn quận huyện -</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="wardID" class=" col-form-label ">Phường/xã</label>
                                                                    <select name="wardID" id="wardID" class="form-control form-control-sm select2">
                                                                        <option value="">- Chọn phường xã -</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="send_house_number" class=" col-form-label ">Số đường</label>
                                                                    <input class="form-control form-control-sm" value="{{ $realestate->send_house_number }}" placeholder="Số đường ... "  id="send_house_number" name="send_house_number"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="send_house_address" class=" col-form-label ">Địa chỉ</label>
                                                                    <input class="form-control form-control-sm" value="{{ $realestate->send_house_address }}" placeholder="Địa chỉ ... "  id="send_house_address" name="send_house_address"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="card card-widget ">


                                                <div class="card-body " >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Tiêu đề <span class="text-danger">*</span></label>
                                                                <input type="text" value="{{$realestate->realestate_title}}" name="realestate_title" placeholder="Tiêu đề ... " class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" style="padding-top: 10px">
                                                                        <div class="bl-checkbox text-center">
                                                                            <input type="checkbox" {{$realestate->realestate_hot=='on'?'checked':''}} id="realestate_hot" class="form-control form-control-sm" value="on" name="realestate_hot" >
                                                                            <label for="realestate_hot" class="text-danger">Đặt biệt</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group" style="padding-top: 10px">
                                                                        <div class="bl-checkbox text-center">
                                                                            <input type="checkbox" {{$realestate->realestate_expertise=='on'?'checked':''}} id="realestate_expertise" class="form-control form-control-sm" value="on" name="realestate_expertise" >
                                                                            <label for="realestate_expertise" class="text-info">Đã thẩm định</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group" style="padding-top: 10px">
                                                                        <div class="bl-checkbox text-center">
                                                                            <input type="checkbox" {{$realestate->realestate_sold=='on'?'checked':''}} id="realestate_sold" class="form-control form-control-sm" value="on" name="realestate_sold" >
                                                                            <label for="realestate_sold" class="text-success text-center">Đã bán</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label id="span_realestate_price">Giá tiền đề nghị <span class="text-danger">*</span> </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{number_format($realestate->realestate_price)}}" id="realestate_price" name="realestate_price" placeholder="Giá tiền đề nghị... " class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" style="display: none" id="showhidden_send_realestate_price_rent">
                                                            <div class="form-group">
                                                                <label id="span_send_realestate_price_rent">Giá tiền đặt cọc </label>
                                                                <input type="text" value="{{number_format($realestate->send_realestate_price_rent)}}" id="send_realestate_price_rent" name="send_realestate_price_rent" placeholder="Giá tiền đặt cọc... " class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            @include('admin.pages.realestate.includes.form-hinh')
                                                        </div>
                                                        <div class="col-md-12 NHA" style="display: none" >
                                                            @include('admin.pages.realestate.includes.form-nha')
                                                        </div>
                                                        <div class="col-md-12 DAT" style="display: none" >
                                                            @include('admin.pages.realestate.includes.form-dat')
                                                        </div>
                                                        <div class="col-md-12 NHA" style="display: none">
                                                            <label>Tiện ích </label>
                                                            <div class="form-group">
                                                                <div id="alertJS"></div>
                                                                <div id="realestate_tien_ich" rows="5" name="realestate_tien_ich"  placeholder="Tiện ích ... " class="form-control form-control-sm">
                                                                {!!($realestate->realestate_tien_ich)!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Mô tả </label>
                                                            <div class="form-group">
                                                                <div id="alertJS"></div>
                                                                <div id="realestate_mota" rows="5" name="realestate_mota"  placeholder="Mô tả ... " class="form-control form-control-sm">
                                                                {!!($realestate->realestate_mota)!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card card-widget ">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" >
                                                                <label>Loại hình giao dịch <span class="text-danger">*</span></label>
                                                                <select class="form-control form-control-sm select2" id="cate_type" name="cate_type">
                                                                    <option value=""> -- Chọn loại tin  --</option>
                                                                    <option value="cate_buy"> -- Mua bán -- </option>
                                                                    <option value="cate_lease"> -- Cho thuê --</option>
                                                                    <option value="cate_project"> -- Dự án --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Loại bất động sản</label>
                                                            <div class="form-group" >
                                                                <select class="form-control form-control-sm select2" id="category_id" name="category_id">
                                                                    <option value=""> -- Chọn danh mục  --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Trạng thái </label>
                                                                <select name="realestate_status" class="form-control form-control-sm select2">
                                                                    <option {{$realestate->realestate_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                    <option {{$realestate->realestate_status=='draft'?'selected':''}} value="draft">Nháp</option>
                                                                    <option {{$realestate->realestate_status=='lock'?'selected':''}} value="lock">Khóa</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Gửi Email cho người đã đăng ký ? </label>
                                                                <select name="email_send_status" class="form-control form-control-sm select2">
                                                                    <option value="NO">Không</option>
                                                                    <option  value="OK">Có</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <div class="card thong-bao-loi" style="display: none">
                                                                <div class="card-header  ">
                                                                    <h3 class="card-title text-center">Thông báo lỗi</h3>
                                                                </div>
                                                                <div class="card-body ">
                                                                    <div class="form-group">
                                                                        <div id="error-detail"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer ">
                                                    <a href="{{ url()->previous() }}" class="btn btn-danger  pull-right">Quay lại</a>
                                                    <button type="button" id="btnPublic" class="btn btn-success  pull-left">Xử lý </button>
                                                </div>
                                            </div>
                                        </div>
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
.card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(0,0,0,.125);
    padding: .30rem .5rem;
    position: relative;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
</style>
{{-- <link rel="stylesheet" href="{{asset('themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"> --}}
@endsection
@section('runJS')
{{-- <script src="{{asset('themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script> --}}
<script src="{{asset('admin/realestate/action.js')}}"></script>
<script>
   var action = new action();
   action.datas={
        provinceID : "{{$realestate->provinceID}}",
        districtID : "{{$realestate->districtID}}",
        wardID : "{{$realestate->wardID}}",
        category_id : "{{$realestate->category_id}}",
        cate_type : "{{$realestate->cate_type}}",
        type:"{{ $type }}",
        lease:@json(getRealestateLease()),
        buy:@json(getRealestateBuy()),
        project:@json(getRealestateProject()),
        districtAjax:"{{route('admin.area.districtAjax')}}",
        wardAjax:"{{route('admin.area.wardAjax')}}",
   }
   action.init();
</script>
@endsection
