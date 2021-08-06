@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">TIN NHẮN LIÊN HỆ</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Tìm kiếm ... " class="form-control form-control-sm" name="q" value="@isset($search) {{$search}} @endisset " placeholder="Tìm kiếm ... " />
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
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">DANH SÁCH LIÊN HỆ</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">@sortablelink('id','STT')</th>
                                        <th class="">@sortablelink('full_name','Thông tin')</th>
                                        <th class="">@sortablelink('body','Nội dung')</th>
                                        <th class="">@sortablelink('created_at','Ngày gửi')</th>
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
                                                    <td class="text-left">
                                                        Họ tên : {{$item->full_name}}
                                                        <br>Email:{{$item->email}}
                                                        <br>SĐT:{{$item->phone}}
                                                        <br>Trạng thái:
                                                            @if ($item->status=='off')
                                                            <span class="badge badge-danger">Chưa xử lý</span>
                                                            @else
                                                            <span class="badge badge-success">Đã xử lý</span>
                                                            @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->type_contact=='default')
                                                        {{$item->body}}
                                                        @endif
                                                        @if ($item->type_contact=='tu_van')
                                                            <span class="badge badge-info">Đặt lịch tư vấn</span>
                                                            <br>
                                                            Ngày:{{ $item->date }}
                                                            <br>
                                                            Link : <a target="_blank" href="{{getRealestateUrl($item)}}">{{$item->realestate_title}}</a>
                                                        @endif
                                                        @if ($item->type_contact=='service_phaplyBDS')
                                                            <span class="badge badge-info">{{ $item->title }}</span>
                                                                @isset($item->body)
                                                                    @php
                                                                        $rs=json_decode($item->body);
                                                                    @endphp
                                                                      @isset($rs->procedureTypeId)<br>
                                                                     <span class="badge badge-danger">
                                                                       {{ $rs->procedureTypeId }}
                                                                    </span>
                                                                     @endisset
                                                                @endisset
                                                        @endif
                                                        @if ($item->type_contact=='service_dambaoTTNN')
                                                            <span class="badge badge-success">{{ $item->title }}</span>
                                                        @endif
                                                        @if ($item->type_contact=='service_thutucvahosoBDS')
                                                            <span class="badge badge-warning">{{ $item->title }}</span>
                                                        @endif
                                                        @if ($item->type_contact=='service_thamdinhBDS')
                                                        <span class="badge badge-danger">{{ $item->title }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{$item->created_at}}</td>
                                                    <td class="text-center">
                                                        <div class="btn btn-group">
                                                            @if ($item->status=='off')
                                                            <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.contact.status')}}" class="btn btn-success btn-status btn-xs">Xử lý</button>
                                                            @endif
                                                            <button type="button" data-id="{{$item->id}}" data-url="{{route('admin.contact.delete')}}" class="btn btn-danger btn-delete btn-xs">Xóa</button>
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
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
            </div>
          </div>
@endsection
@section('runJS')
<script src="{{asset('admin/contact/list.js')}}"></script>
<script>
   var contact = new contact();
   contact.datas={

   }
   contact.init();
</script>
@endsection
