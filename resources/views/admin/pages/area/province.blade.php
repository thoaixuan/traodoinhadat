@extends('layouts.admin')
@section('admin')

<div class="content">
    <div class="container-fulld">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">Tỉnh thành</h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm" name="q" value="@isset($search) {{$search}} @endisset " placeholder="Tìm kiếm ... " />
                                        <div class="input-group-append">
                                        <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="button">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a href="{{route('admin.area.add','province')}}" class="btn btn-sm btn-outline-success btn-block">Thêm mới</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card ">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">Danh sách tỉnh thành</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">@sortablelink('id','STT')</th>
                                <th> @sortablelink('province_name','Tên')</th>
                                <th class="text-center">@sortablelink('created_at','Ngày tạo')</th>
                                <th class="text-center">Tác vụ</th>
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
                                            <td>{{$item->province_name}}</td>
                                            <td class="text-center">{{$item->created_at}}</td>
                                            <td class="text-center">
                                                <div class="btn btn-group">
                                                    <a href="{{ route('admin.area.edit',['province',$item->id]) }}" class="btn btn-success btn-xs">Sửa</a>
                                                    <button  value="{{$item->id}}" type="button" data-id="{{$item->id}}" data-url="{{route('admin.page.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
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
                <div class="card-footer">
                    @isset($data)
                        {!! $data->links() !!}
                    @endisset
                </div>
            <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
    </div>
  </div>

@endsection
@section('runJS')
<script src="{{asset('admin/area/province.js')}}?v={{time()}}"></script>
<script>
    var province = new province();
    province.datas={
    };
    province.routes={
        update:"{{route('admin.province.edit')}}",
        insert:"{{route('admin.province.add')}}",
        delete:"{{route('admin.province.delete')}}",
    };
    province.init();
</script>
@endsection
