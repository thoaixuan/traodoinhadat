@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">QUẢN LÝ SLIDER</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="type" value="{{ request()->get('type') }}"/>
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
                                            <a href="{{ route('admin.slider.add') }}?type={{ request()->get('type') }}" class="btn btn-sm btn-outline-success btn-block">Thêm mới</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="text-center">@sortablelink('image','Hình')</th>
                                        <th class="text-center">@sortablelink('name','Tên')</th>
                                        <th class="text-center">@sortablelink('updated_at','Ngày')</th>
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
                                                    <td class="text-center">
                                                        @if ($item->image!=NULL)
                                                        @if ( file_exists(public_path($item->image))&&$item->image!="")
                                                        <img id="post_image_review" height="50px"  width="50px" src="{{$item->image}}"/>
                                                        @else
                                                        <img id="post_image_review" height="50px"  width="50px" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                        @endif
                                                        @else
                                                        <img id="post_image_review" height="50px"  width="50px" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                        @endif


                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->name}}
                                                        <br>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input data-id="{{$item->id}}" data-url="{{route('admin.slider.status')}}" {{$item->status=='on'?'checked':''}} type="checkbox" class="custom-control-input slider_status" id="customSwitch{{$i}}">
                                                            <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">{{$item->created_at}}</td>
                                                    <td class="text-center">
                                                        <div class="btn btn-group">
                                                            <a   href="{{route('admin.slider.edit')}}/{{$item->id}}?type={{ $item->type }}" class="btn btn-success  btn-xs">Cập nhật</a>
                                                            <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" data-url="{{route('admin.slider.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <th colspan="6" class="text-center">Không có dữ liệu !</th>
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
                    </div>

                </div>
            </div>
          </div>
@endsection
@section('runJS')
<script src="{{asset('admin/slider/list.js')}}"></script>
<script>
   var slider = new slider();
   slider.datas={

   }
   slider.init();
</script>
@endsection
