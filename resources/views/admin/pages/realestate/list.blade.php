

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
                    @include('admin.pages.realestate.includes.formSearch')
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
                                <th style="width: 10%" class="text-center">@sortablelink('id','STT')</th>
                                <th style="width: 10%"> User</th>
                                <th style="width: 10%"> Danh mục</th>
                                <th style="width: 50%"> @sortablelink('realestate_title','Tiêu đề')</th>

                                <th style="width: 20%" class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                                @if (count($data)>0)
                                    @php $i=0;@endphp
                                    @foreach ($data as $item)
                                        @php $i++;@endphp
                                        <tr id="item-{{$item->id}}">

                                            <td class="text-center">{{$i}}</td>
                                            <td><span class="badge badge-info"><i class="fa fa-user"></i> {{$item->full_name}}</span></td>
                                            <td>
                                                <span class="badge badge-danger"><i class="fas fa-clipboard-list"></i>
                                                    @if($item->cate_type=='cate_buy') Mua bán @endif
                                                    @if($item->cate_type=='cate_lease') Cho thuê @endif
                                                    @if($item->cate_type=='cate_project') Dự án @endif
                                                </span>
                                                @if ($item->cate_name)
                                                <span class="badge badge-success"><i class="fa fa-check"></i> {{$item->cate_name}}</span>
                                                @endif

                                            </td>

                                            <td><a class="text-dark" target="_blank" href="{{ getRealestateUrl($item) }}">{{$item->realestate_title}}</a><span class="d-block"></span>
                                                <span class="badge badge-primary"> <i class="fas fa-house-user"></i>
                                                    @if($item->province_name){{$item->province_name}}@endif
                                                    @if($item->district_name)-{{$item->district_name}}@endif
                                                    @if($item->ward_name)-{{$item->ward_name}}@endif
                                                </span>
                                                <span class="badge badge-warning"><i class="fas fa-calendar-alt"></i> {{$item->created_at}}</span>
                                                <span class="badge badge-default"><i class="fas fa-user-clock"></i> {{time_Ago($item->realestate_time)}}</span>
                                            </td>

                                            <td class="text-center">
                                                <div class="btn btn-group">
                                                    @if ($item->user_id_send!=null)
                                                    <a href="{{ route('admin.realestate.received.edit',$item->id) }}" title="Chỉnh sửa" class="btn btn-success btn-xs"><i class="fas fa-user-edit"></i></a>
                                                    @else
                                                    <a href="{{ route('admin.realestate.edit',$item->id) }}" title="Chỉnh sửa" class="btn btn-success btn-xs"><i class="fas fa-user-edit"></i></a>
                                                    @endif
                                                    <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" title="Xóa" data-url="{{route('admin.realestate.delete')}}" class="btn btn-danger btn-delete btn-xs"><i class="fas fa-trash"></i></button>
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
        category_id : "{{$category}}",
        cate_type : "{{$cate_type}}",
        lease:@json(getRealestateLease()),
        buy:@json(getRealestateBuy()),
   }
   list.init();
</script>
@endsection
