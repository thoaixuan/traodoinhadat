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
                                            <button type="submit" class="btn btn-info btn-block">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:70%"> @sortablelink('realestate_title','Tiêu đề')</th>
                                        <th style="width:15%"> @sortablelink('realestate_view','Lượt xem')</th>
                                        <th style="width:15%"> @sortablelink('id','Tác vụ')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                        @if (count($data)>0)
                                            @php $i=0;@endphp
                                            @foreach ($data as $item)
                                                @php $i++;@endphp
                                                <tr id="item-{{$item->id}}">
                                                    <td><a class="text-info" href="{{ getRealestateUrl($item) }}">{{ $item->realestate_title }}</a></td>
                                                    <td  class="text-center count">{{ $item->realestate_view }}</td>
                                                    <td class="text-center">
                                                        <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" data-url="{{route('web.account.deleteTinDaLuu')}}" class="btn btn-danger btn-delete-tindaluu btn-xs"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <th colspan="3" class="text-center">Không có dữ liệu !</th>
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
@section('runCSS')
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
