@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        <form value="{{$post->id}}" action="{{$type=='update'?route('admin.news.edit'):route('admin.news.add')}}" id="formAction" name="id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-dark">
                        <div class="card-header">
                            <h3 class="card-title">{{$type=='update'?'CẬP NHẬT':'VIÊT BÀI MỚI'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                                    <div class="row">
                                        <div class="col-md-8 ">
                                            <div class="card card-widget card-dark">
                                                <div class="card-body " >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Tiêu đề <span class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$post->post_title}}" name="post_title" placeholder="Tiêu đề ... " class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Mô tả (Meta Tag)</label>
                                                                <div class="input-group mb-3">
                                                                    <textarea rows="4" type="text" name="post_des" placeholder=" Mô tả (Meta Tag)... " class="form-control">{{$post->post_des}}</textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Từ khóa (Meta Tag)</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name="post_keywords" value="{{$post->post_keywords}}" placeholder="Từ khóa ... " class="form-control">
                                                                </div>

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
                                            <div class="card card-widget card-dark">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Chọn thể loại  <span class="text-danger">*</span></label>
                                                            <div class="form-group" >
                                                                <select class="form-control select2" id="category_id" name="category_id">
                                                                    <option value="">-- Thể loại --</option>
                                                                    @foreach (getCategoryPost() as $parent)
                                                                        <option {{$post->category_id==$parent->id?'selected':''}} value="{{$parent->id}}">{{$parent->cate_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-12">
                                                            <label>Chọn danh mục con</label>
                                                            <div class="form-group" >
                                                                <select class="form-control select2" id="category_sub_id" name="category_sub_id">
                                                                    <option value="">-- CHỌN DANH MỤC CON --</option>

                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Hình ảnh (jpg,png,gif,jpeg)</label>
                                                                <div id="alertJSUploadImg"></div>
                                                                <div  class="post-select-image-container" id="change_post_image">
                                                                    <label class="btn-select-image" >
                                                                        @if ($post->post_image_max!=NULL)
                                                                            @if ( file_exists(public_path($post->post_image_max))&&$post->post_image_max!="")
                                                                            <img id="post_image_review" height="100%"  width="100%" src="{{$post->post_image_max}}"/>
                                                                            @else
                                                                            <img id="post_image_review" height="100%"  width="100%" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                                            @endif
                                                                        @else
                                                                            <img id="post_image_review" height="100%"  width="100%" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                                        @endif

                                                                        <div class="btn-select-image-inner">
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <input class="d-none" type="file" name="file_post_image" id="file_post_image">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                    <!-- /btn-group -->
                                                                    <label>Trạng thái </label>
                                                                    <select name="post_status" class="form-control select2">
                                                                        <option {{$post->post_status=='published'?'selected':''}} value="published">Công khai</option>
                                                                        <option {{$post->post_status=='draft'?'selected':''}} value="draft">Nháp</option>
                                                                        <option {{$post->post_status=='lock'?'selected':''}} value="lock">Khóa</option>
                                                                    </select>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label>Thẻ</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text"  value="@isset($tags){{ $tags }}@endisset" id="tags" data-role="tagsinput" placeholder="Thẻ ... " class="form-control">
                                                                </div>
                                                            </div> --}}
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
@section('runCSS')
{{-- <link rel="stylesheet" href="{{asset('themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"> --}}
@endsection
@section('runJS')
{{-- <script src="{{asset('themes/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script> --}}
<script src="{{asset('admin/post/action.js')}}"></script>
<script>
   var action = new action();
   action.datas={
        type:"{{ $type }}",
        category_id:"{{ $post->category_id }}",
        subMenus:@json(getSubMenu())
   }
   action.init();
</script>
@endsection
