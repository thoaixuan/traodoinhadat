

@extends('layouts.admin')
@section('admin')
<div class="content">
    <div class="container-fulld card-category">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">BỘ LỌC </h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="q" value="{{$search}}" placeholder="Tìm kiếm ... " />
                                        <div class="input-group-append">
                                        <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="submit">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card card-dark">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">DANH SÁCH TIN</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th  style="width: 10%"> User gửi tin</th>
                                <th  style="width: 30%"> @sortablelink('realestate_title','Thông tin BĐS')</th>
                                <th  style="width: 20%">Thông tin trao đổi BĐS <span class="right badge badge-info">New</span> </th>
                                <th  style="width: 20%"> Khu vực</th>
                                <th style="width: 20%" class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!--Chỗ này không xài datatable :V méo hiểu-->
                            @isset($data)
                                @if (count($data)>0)
                                    @php $i=0;@endphp
                                    @foreach ($data as $item)
                                        @php $i++;@endphp
                                        <tr id="item-{{$item->id}}">
                                            <td> {{$item->full_name}} </td>
                                            <td>
                                                <b>Loại BĐS </b>: {{$item->send_mo_gioi=='moi_gioi'?'Môi giới':'Chủ nhà'}} - {{$item->cate_name}}<br>

                                                @if($item->cate_type=='cate_buy') <span class="badge badge-warning">Bán</span> - Giá đề nghị : {{number_format($item->send_realestate_price)}} @endif
                                                @if($item->cate_type=='cate_lease') <span class="badge badge-primary">Cho thuê</span> Giá cho thuê/Giá đặt cọc: {{number_format($item->send_realestate_price)}} VNĐ/
                                                {{number_format($item->send_realestate_price_rent)}} VNĐ
                                                @endif <br>

                                                <b>Địa chỉ </b>:  @if($item->send_house_number){{$item->send_house_number}}@endif
                                                @if($item->send_house_address) - {{$item->send_house_address}}@endif @if($item->ward_name) - {{$item->ward_name}}@endif <br>
                                                <span class="badge badge-warning"><i class="fas fa-calendar-alt"></i> {{$item->created_at}}</span>
                                                <span class="badge badge-danger"><i class="fas fa-user-clock"></i> {{time_Ago($item->send_realestate_time)}}</span>
                                            </td>
                                            <td>
                                            @if($item->send_traodoibds =="on"){{$item->info_traodoibds}}@endif
                                            </td>
                                            <td>
                                                @if($item->province_name){{$item->province_name}}@endif @if($item->district_name) - {{$item->district_name}}@endif @if($item->ward_name) - {{$item->ward_name}}@endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn btn-group">
                                                    <a href="{{ route('admin.realestate.received.edit',$item->id) }}" title="Phê duyệt" class="btn btn-info btn-xs"><i class="fas fa-check-double"></i></a>
                                                    <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" title="Xóa" title="Xóa" data-url="{{route('admin.realestate.delete')}}" class="btn btn-danger btn-delete btn-xs"><i class="fas fa-trash"></i></button>
                                                </div>
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
@endsection
@section('runJS')
<script src="{{asset('admin/realestate/list.js')}}"></script>
<script>
   var list = new list();
   list.datas={

   }
   list.init();
</script>
@endsection
