@extends('layouts.admin')
@section('admin')

<div class="content">
    <div class="container-fulld">

            <div class="card ">
                <div class="card-header p-2 ">
                    <h3 class="card-title text-center">{{$action_title}}</h3>
                </div>
                <div class="card-body">
                    <form id="formAction" action="{{$action=='add'?route('admin.area.add'):route('admin.area.edit')}}" type="{{$type}}">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row">
                                            @if($type=='district'||$type=='ward')
                                                <div class="col-md-12">
                                                    <label>Chọn tỉnh thành</label>
                                                    <div class="form-group">
                                                        <select name="provinceID" id="provinceID" class="form-control select2">
                                                                <option @isset($provinceID){{ $provinceID==""?'selected':'' }}@endisset value="">- Chọn tỉnh thành -</option>
                                                                @isset($provinces)
                                                                @foreach ($provinces as $item)
                                                                <option @isset($provinceID){{ $provinceID==$item->id?'selected':'' }}@endisset  value="{{ $item->id }}">{{ $item->province_name }}</option>
                                                                @endforeach
                                                                @endisset
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($type=='ward')
                                                <div class="col-md-12">
                                                    <label>Chọn quận huyện</label>
                                                    <div class="form-group">
                                                        <select name="districtID" id="districtID" class="form-control select2">
                                                                <option @isset($districtID){{$districtID==""?'selected':''}}@endisset value="">- Chọn tỉnh thành -</option>
                                                                @isset($districts)
                                                                @foreach ($districts as $item)
                                                                <option @isset($districtID){{$districtID==$item->id?'selected':''}}@endisset  value="{{ $item->id }}">{{ $item->district_name }}</option>
                                                                @endforeach
                                                                @endisset
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                        <label>Tên</label>
                                                        <input type="text" value="@isset($name){{$name}}@endisset" name="name" placeholder="Nhập tên" class="form-control"/>
                                                        <input type="hidden" value="@isset($type){{$type}}@endisset" name="type" class="form-control"/>
                                                        <input type="hidden" value="@isset($id){{$id}}@endisset" name="id" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" id="onSaveData" class="btn btn-info btn-block">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </div>
  </div>

@endsection
@section('runJS')
<script src="{{asset('admin/area/action.js')}}?v={{time()}}"></script>
<script>
    var action = new action();
    action.datas={
        provinceID:"@isset($provinceID){{ $provinceID}}@endisset",
        districtID:"@isset($districtID){{ $districtID}}@endisset",
        type:"{{$type}}",
        action:"{{$action}}",
        districtAjax:"{{route('admin.area.districtAjax')}}"
    }
    action.init();
</script>
@endsection
