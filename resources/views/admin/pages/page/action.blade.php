@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        <form value="{{$post->id}}" action="{{$type=='update'?route('admin.page.edit'):route('admin.page.add')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{$type=='update'?'CẬP NHẬT':'THÊM MỚI'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                                    <div class="row">
                                        <div class="col-md-8 ">
                                            <div class="card card-widget card-info card-outline">
                                                <div class="card-body " >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Tiêu đề <span class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$post->post_title}}" name="post_title" placeholder="Tiêu đề ... " class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <label>Đường dẫn chuyển hướng (nếu có) </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$post->page_link}}" name="page_link" placeholder="Đường dẫn chuyển hướng ... " class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <!-- /btn-group -->
                                                                <label>Kiểu chuyển hướng </label>
                                                                <select name="page_link_type" class="form-control select2">
                                                                    <option {{$post->page_link_type=='newPage'?'selected':''}} value="newPage">Mở tại trang</option>
                                                                    <option {{$post->page_link_type=='newPageTab'?'selected':''}} value="newPageTab">Mở Tab mới</option>
                                                                </select>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Nội dung <span class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                <div id="alertJS"></div>
                                                                <div id="post_content" rows="5" name="post_content"  placeholder="Nội dung ... " class="form-control">
                                                                {!!($post->post_content)!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-widget card-info card-outline">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                    <!-- /btn-group -->
                                                                    <label>Trạng thái </label>
                                                                    <select name="post_status" class="form-control select2 w-100">
                                                                        <option {{$post->post_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                        <option {{$post->post_status=='lock'?'selected':''}} value="lock">Khóa</option>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Hiển thị menu (Header) </label>
                                                                <select name="page_status_header" class="form-control select2 w-100">
                                                                    <option {{$post->page_status_header=='show'?'selected':''}} value="show">Hiện </option>
                                                                    <option {{$post->page_status_header=='hide'?'selected':''}} value="hide">Ẩn</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Hiển thị menu (Footer) </label>
                                                                <select name="page_status_footer" class="form-control select2 w-100">
                                                                    <option {{$post->page_status_footer=='show'?'selected':''}} value="show">Hiện </option>
                                                                    <option {{$post->page_status_footer=='hide'?'selected':''}} value="hide">Ẩn</option>
                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Quay lại</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button" id="btnPublic" class="btn btn-info btn-block">Lưu </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('runJS')
<script src="{{asset('admin/page/page.js')}}"></script>
<script>
   var page = new page();
   page.datas={

   }
   page.init();
</script>
@endsection
