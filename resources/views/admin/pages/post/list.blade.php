

@extends('layouts.admin')
@section('admin')
<div class="content">
    <div class="container-fulld card-category">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">BÀI VIẾT </h3>
                </div>
                <div class="card-body">
                    @include('admin.pages.post.includes.formSearch')
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">DANH SÁCH </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">@sortablelink('id','STT')</th>
                                    <th class="text-center"> @sortablelink('post_image_max','Hình ảnh')</th>
                                    <th> @sortablelink('post_title','Tên')</th>
                                    <th class="text-center">@sortablelink('post_status_hot','Tin HOT')</th>
                                    <th class="text-center">@sortablelink('created_at','Ngày tạo')</th>
                                    <th class="text-center">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                    @if (count($data)>0)
                                        @php $i=0;@endphp
                                        @foreach ($data as $item)
                                        @php
                                            if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                                                $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                                            }else{
                                                $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                                            }
                                        @endphp
                                            @php $i++;@endphp
                                            <tr id="item-{{$item->id}}">
                                                <td class="text-center">{{$i}}</td>
                                                <td class="text-center">
                                                    @if ($item->post_image_max!=NULL)
                                                    @if ( file_exists(public_path($item->post_image_max))&&$item->post_image_max!="")
                                                    <img id="post_image_review" height="50px"  width="50px" src="{{$item->post_image_max}}"/>
                                                    @else
                                                    <img id="post_image_review" height="50px"  width="50px" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                    @endif
                                                    @else
                                                    <img id="post_image_review" height="50px"  width="50px" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                    @endif


                                                </td>
                                                <td><a target="_blank" href="{{$url}}" ><b>{{$item->post_title}}</b>
                                                    <br>
                                                    <span class="badge badge-info"><i class="fa fa-user"></i> {{$item->full_name}}</span>
                                                    <span class="badge badge-success"><i class="fa fa-list"></i> {{$item->cate_name}} </span>
                                                    <span class="badge badge-danger"><i class="fa fa-eye"></i> {{$item->post_view}} </span>
                                                    <span class="badge badge-danger"><i class="fa fa-share"></i> {{$item->post_share}} </span>
                                                    @if ($post_status!='hot')
                                                        <span class="badge badge-warning"> Tin HOT </span>
                                                    @endif
                                                    <span class="badge badge-default"><i class="fas fa-user-clock"></i> {{time_Ago($item->post_time)}}</span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input data-id="{{$item->id}}" data-url="{{route('admin.news.postStatusHot')}}" {{$item->post_status_hot=='on'?'checked':''}} type="checkbox" class="custom-control-input post_status_hot" id="customSwitch{{$i}}">
                                                        <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">{{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn btn-group">
                                                        <a href="{{ route('admin.news.edit',$item->id) }}" class="btn btn-success btn-xs">Sửa</a>
                                                        <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" data-url="{{route('admin.news.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
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
                        @php
                            $data->withPath(\URL::current()."?type={$post_status}&q={$search}");
                        @endphp
                        {!! $data->links() !!}
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('runJS')
<script src="{{asset('admin/post/list.js')}}"></script>
<script>
   var list = new list();
   list.datas={

   }
   list.init();
</script>
@endsection
