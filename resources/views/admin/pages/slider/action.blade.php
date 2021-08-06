@extends('layouts.admin')
@section('admin')
<!-- Main content -->
<section class="content">
    <div class="container-fulld">
        <form value="{{$data->id}}" action="{{$action=='update'?route('admin.slider.edit'):route('admin.slider.add')}}" id="formAction" name="id">
            <input type="hidden" name="type" value="{{ request()->get('type') }}"/>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{$action=='update'?'CẬP NHẬT':'THÊM MỚI'}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body " >
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label for="about" >Trạng thái </label>
                                                <select  name="status" class="form-control">
                                                    <option {{$data->status=='on'?'selected':''}}  value="on">Bật</option>
                                                    <option {{$data->status=='off'?'selected':''}}  value="off">Tất</option>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label for="name" >Tên</label>
                                                <input type="text"  class="form-control" id="name" name="name" value="{{$data->name}}" placeholder="Tên slider ... ">
                                            </div>
                                            @if (request()->get('type')=='uudai')
                                            <div class="form-group">
                                                <label for="link" >Link</label>
                                                <input type="text" class="form-control" id="link" name="link" value="{{$data->link}}" placeholder="Link...">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Hình ảnh (jpg,png,gif,jpeg)</label>
                                                    <div id="alertJSUploadImg"></div>
                                                    <div  class="slider-select-image-container" id="change_slider_image">
                                                        <label class="btn-select-image" >
                                                            @if ($data->image!=NULL)
                                                                @if ( file_exists(public_path($data->image))&&$data->image!="")
                                                                <img id="slider_image_review" height="100%"  width="100%" src="{{$data->image}}"/>
                                                                @else
                                                                <img id="slider_image_review" height="100%"  width="100%" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                                @endif
                                                            @else
                                                                <img id="slider_image_review" height="100%"  width="100%" src="{{asset('uploads/defaults/photos-icon.png')}}"/>
                                                            @endif

                                                            <div class="btn-select-image-inner">
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <input class="d-none" type="file" name="file_slider_image" id="file_slider_image">
                                                </div>

                                            <div class="form-group">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                                <div class="">
                                    <a href="{{route('admin.slider.view')}}?type={{ request()->get('type') }}" class="btn btn-danger pull-feft"><i class="fas fa-long-arrow-alt-left"></i> Quay lại</a>
                                    <button type="button" id="onSaveSlider"  class="btn btn-success pull-right">Lưu</button>
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
<script src="{{asset('admin/slider/slider.js')}}"></script>
<script>
   var slider = new slider();
   slider.datas={

   }
   slider.init();
</script>
@endsection


