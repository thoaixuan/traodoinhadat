<div class="row">
    <div class="col-md-12">
        <label class=" control-label">
            <span class="text">Khu vực BĐS muốn trao đổi <strong class="color-red">*</strong></span>
        </label>
    </div>
    <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <select id="provinceID" class="form-control form-control-sm select2">
                <option {{ setting()->provinceID==""?'selected':'' }} value="">- Chọn tỉnh thành -</option>
                @foreach (getProvinces() as $item)
                <option  value="{{ $item->id }}">{{ $item->province_name }}</option>
                @endforeach
            </select>
          </div>
    </div>
    <div class="col-md-4 col-sm-4">
          <div class="form-group">
                <select  id="districtID" class="form-control form-control-sm select2">
                    <option value="">- Chọn quận huyện -</option>
                </select>
          </div>
    </div>
    <div class="col-md-4 col-sm-4 ">
          <div class="form-group">
                <select  id="wardID" class="form-control form-control-sm select2">
                    <option value="">- Chọn phường xã -</option>
                </select>
          </div>
    </div>
</div>


@section('runJS')
@parent
<script src="{{asset('web/realestate/khuvuc.js')}}"></script>
<script>
   var khuvuc = new khuvuc();
   khuvuc.datas={
        provinceID : "{{setting()->provinceID}}",
        districtID : "{{setting()->districtID}}",
        wardID : "{{setting()->wardID}}",
        districtAjax:"{{route('admin.area.districtAjax')}}",
        wardAjax:"{{route('admin.area.wardAjax')}}",
   }
   khuvuc.init();
</script>
@endsection
