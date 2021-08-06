@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">THÀNH VIÊN</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control form-control-sm" name="q" value="@isset($q) {{$q}} @endisset " placeholder="Tìm kiếm ... " />
                                                <div class="input-group-append">
                                                <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="button">Hủy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                           <select id="type" name="type" class="select2">
                                               <option @isset($type){{$type==''?'selected':''}}@endisset   value="">- Tất cả  thành viên - </option>
                                               <option @isset($type){{$type=='userAdminCreate'?'selected':''}}@endisset  value="userAdminCreate">Hệ thống</option>
                                               <option @isset($type){{$type=='userCreate'?'selected':''}}@endisset  value="userCreate">Thành viên</option>
                                           </select>
                                        </div>
                                    </div>

                                    <div id="showType" class="col-md-2 {{$type=='userAdminCreate'?'':'d-none'}} ">
                                        <div class="form-group">
                                           <select name="role" class="select2">
                                               <option value="">- Tất cả vai trò -</option>
                                               @foreach (getRoles() as $item)
                                                    <option @isset($role){{$role==$item->roleID?'selected':''}}@endisset value="{{$item->id}}">{{$item->role_name}}</option>
                                               @endforeach
                                           </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">DANH SÁCH THÀNH VIÊN</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> @sortablelink('full_name','Thông tin')</th>
                                        <th> Loại tài khoản</th>
                                        <th class="text-center">@sortablelink('status','Trạng thái')</th>
                                        <th>@sortablelink('created_at','Ngày tạo')</th>
                                        <th class="text-center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                    @if (count($data)>0)
                                        @php $i=0;@endphp
                                        @foreach ($data as $item)
                                            @php $i++;
                                            if($item->avatar==''){
                                                $item->avatar = "https://www.gravatar.com/avatar/".md5($item->email)."jpg?s=64";
                                            }
                                            @endphp
                                            <tr id="item-{{$item->id}}">
                                                <td>
                                                    <ul class="products-list ">
                                                        <li class="item" id="itemAuthID{{ $item->userID }}">
                                                            <div class="product-img">
                                                                <img src=" {{ $item->avatar }}" alt="{{ $item->full_name }}" class="img-size-50 ">
                                                            </div>
                                                            <div class="product-info">
                                                                <a  href="#" class="product-title">
                                                                        {{ $item->full_name }}
                                                                </a>
                                                                <span class="product-description">
                                                                    @if ($item->email)
                                                                        <span class="badge badge-danger float-left"> <i class="fa fa-user"></i> {{$item->email}} </span>
                                                                    @endif
                                                                    @if ($item->phone)
                                                                        <br>
                                                                        <span class="badge badge-info float-left"> <i class="fa fa-phone"></i> {{$item->phone}} </span>
                                                                    @endif
                                                                    
                                                                </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning float-left"  > <i class="fas fa-user-edit"></i>
                                                        {{$item->loai_hinh_thuc_bds=='chu_nha'?'Chủ nhà':'Môi giới'}}
                                                    </span>
                                                </td>
                                                <td class="">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input data-id="{{$item->id}}" data-url="{{route('admin.user.status')}}" {{$item->status==0?'checked':''}} type="checkbox" class="custom-control-input post_status" id="customSwitch{{$i}}">
                                                        <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                                                        </div>
                                                    </div>
                                                    @if ($item->type=="userCreate")
                                                    <span class="badge badge-warning " >Thành viên </span>
                                                    @else
                                                    <span class="badge badge-info " >{{ $item->role_name }} </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn btn-group">
                                                        <a href="{{ route('admin.user.edit') }}/{{$item->id}}" class="btn btn-success btn-xs">Sửa</a>
                                                        <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.user.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
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
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
            </div>
          </div>
@endsection
@section('runJS')
<script src="{{asset('admin/user/list.js')}}"></script>
<script>
   var user = new user();
   user.datas={

   }
   user.init();
</script>
@endsection
