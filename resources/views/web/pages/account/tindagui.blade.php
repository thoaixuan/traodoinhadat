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
                    <div class="card">
                        <div class="card-body">
                            @if (session('status_login_lock'))
                                    <div class="alert alert-info text-small alert-dismissible" role="alert">{{session('status_login_lock')}} <button type="button" class="close" data-dismiss="alert"></button></div>
                            @endif
                            <form action="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select id="cate_type" name="cate_type" class="form-control">
                                                <option {{ $cate_type==''?'selected':'' }} value="">Tất cả </option>
                                                <option {{ $cate_type=='cate_buy'?'selected':'' }} value="cate_buy">Mua Bán </option>
                                                <option {{ $cate_type=='cate_lease'?'selected':'' }} value="cate_lease">Cho thuê</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <input type="text" class="form-control" id="q" name="q" placeholder="Tìm kiếm...">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:25%">Loại tin</th>
                                        <th style="width:45%">@sortablelink('realestate_title','Thông tin BĐS')</th>
                                        <th style="width:15%" class="text-center">Ngày gửi</th>
                                        <th style="width:15%" class="text-center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                        @if (count($data)>0)
                                            @php $i=0;@endphp
                                            @foreach ($data as $item)
                                                @php $i++;@endphp
                                                <tr id="item-{{$item->id}}">
                                                    <td>{{$item->send_mo_gioi=='moi_gioi'?'Môi giới':'Chủ nhà'}}
                                                            @if($item->cate_type=='cate_buy') - Bán - @endif @if($item->cate_type=='cate_lease') - Cho thuê - @endif
                                                        {{$item->cate_name}}
                                                    </td>
                                                    <td>
                                                        <b>Giá GD:  </b>
                                                        @if($item->cate_type=='cate_buy') Bán - Giá đề nghị : {{number_format($item->send_realestate_price)}} @endif
                                                        @if($item->cate_type=='cate_lease') Cho thuê - Giá cho thuê : {{number_format($item->send_realestate_price)}} @endif <br>
                                                        <b>Khu vực : </b>  @if($item->province_name){{$item->province_name}}@endif @if($item->district_name) - {{$item->district_name}}@endif @if($item->ward_name) - {{$item->ward_name}}@endif <br>
                                                        <b>Địa chỉ : </b>  @if($item->send_house_number){{$item->send_house_number}}@endif @if($item->send_house_address) - {{$item->send_house_address}}@endif @if($item->ward_name) - {{$item->ward_name}}@endif <br>

                                                    </td>
                                                    <td>
                                                        <span class="badge badge-warning"><i class="fas fa-calendar-alt"></i> {{$item->created_at}}</span>
                                                        <span class="badge badge-default"><i class="fas fa-user-clock"></i> {{time_Ago($item->send_realestate_time)}}</span>
                                                    </td>
                                                    <td class="text-center">
                                                            <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" data-url="{{route('web.account.deleteTinDaGui')}}" class="btn btn-danger btn-delete btn-xs"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <th colspan="5" class="text-center">Không có dữ liệu !</th>
                                        </tr>
                                        @endif
                                    @endisset

                                </tbody>

                            </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            @isset($data)
                                {!! $data->links() !!}
                            @endisset
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
