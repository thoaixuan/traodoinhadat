

@extends('layouts.admin')
@section('admin')
<div class="content">
    <div class="container-fulld card-category">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">BỘ LỌC </h3>
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
                                <th style="width: 15%" class="text-center">@sortablelink('id','STT')</th>
                                <th style="width: 20%"> User</th>
                                <th style="width: 50%"> @sortablelink('realestate_title','Tin gửi')</th>
                                <th style="width: 15%" class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                                @if (count($data)>0)
                                    @php $i=0;@endphp
                                    @foreach ($data as $item)
                                                @php $i++;@endphp
                                                <tr id="item-{{$item->id}}">
                                                    <td>Cần đổi : <br/> {{$item->cate_name}} đang 
                                                        <span class="badge badge-primary"> @if($item->send_cate_type=='cate_buy') Bán  @endif @if($item->send_cate_type=='cate_lease') Cho thuê @endif</span>
                                                    </td>
                                                    <td>
                                                        {!! $item->full_name !!} <br/>- SĐT : {!! $item->phone !!} <br/>- Mail : {!! $item->email !!}
                                                    </td>
                                                    <td>
                                                        <b>BĐS đang rao :  </b><a href="{{$item->realestate_slug}}" target="_blank" class="text-primary">Xem bài viết</a> <br/>
                                                        <b>Khoảng giá trị trao đổi:  </b>{{$item->realestate_tien_ich}} <br/>
                                                        <b>Khu vực : </b>  @if($item->province_name){{$item->province_name}}@endif 
                                                        @if($item->district_name) - {{$item->district_name}}@endif 
                                                        @if($item->ward_name) - {{$item->ward_name}}@endif <br>
                                                        <b>Mô tả BĐS muốn trao đổi: </b>  {!!$item->realestate_mota!!} <br/>
                                                        <span class="badge badge-warning"><i class="fas fa-calendar-alt"></i> {{$item->created_at}}</span>
                                                        <span class="badge badge-default"><i class="fas fa-user-clock"></i> {{time_Ago($item->send_realestate_time)}}</span>
                                                    </td>
                                                    <td class="text-center">
                                                            <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" data-url="" 
                                                                class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-arrow-up"></i> 
                                                            </button>
                                                            <button type="button" value="{{$item->id}}" data-id="{{$item->id}}" 
                                                                data-url="{{route('admin.deleteTinTraoDoi')}}" 
                                                              class="btn btn-danger btn-delete btn-xs"> <i class="fa fa-trash"></i>
                                                            </button>
                                                    </td>
                                                </tr>
                                    @endforeach
                                @else
                                <tr> <th colspan="5" class="text-center">Không có dữ liệu !</th>  </tr>
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
<script src="{{asset('web/account/account.js')}}"></script>
<script>
    var account = new account();
   account.datas={
        type:"{{ $type }}",
   }
   account.init();

</script>
@endsection
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Duyệt và đăng bài viết</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">BĐS đang rao : <a href="#" target="">Nhấp xem</a></label><br/>
                  <label for="exampleInputEmail1">User : ABCXYZ</label><br/>
                  <label for="exampleInputEmail1">Mô tả</label>
                  <textarea type="text" class="form-control" placeholder=""></textarea>
                  <label for="exampleInputEmail1">Giá trị tài sản</label>
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                  <label>Khu vực</label>
                  <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Tỉnh">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Quận/Huyện">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Phường/Xã">
                            </div>
                            
                        </div>
                  </div>
                  
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck2">
                  <label class="form-check-label" for="exampleCheck2">Hot</label><br/>
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Duyệt và hiển thị</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
</div>
