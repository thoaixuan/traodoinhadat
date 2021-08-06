<div class="col-lg-3 col-md-4 col-city">
    <select id="search_provinceID" class="form-control form-control-sm select2" disabled>
        <option {{ setting()->provinceID==""?'selected':'' }} value="">- Chọn tỉnh thành -</option>
        @foreach (getProvinces() as $item)
        <option data-slug="{{ $item->province_slug }}" data-id="{{ $item->id }}"  value="{{ $item->province_slug }}">{{ $item->province_name }}</option>
        @endforeach
    </select>
</div>
<div class="col-lg-3 col-md-4 col-district">
    <select  id="search_districtID" class="form-control form-control-sm select2">
        <option value="">- Chọn quận huyện -</option>
    </select>
</div>
<div class="col-lg-3 col-md-4 col-ward">
    <select  id="search_wardID" class="form-control form-control-sm select2">
        <option value="">- Chọn phường xã -</option>
    </select>
</div>
@section('runJS')
@parent
<script src="{{asset('web/search/khuvuc.js')}}"></script>
<script>
   var seach_khuvuc = new seach_khuvuc();
   seach_khuvuc.datas={
        provinceID : "{{province_slug_default()}}",
        districtID :"{{district_slug_default()}}",
        wardID : "{{ward_slug_default()}}",
        category_id : "",
        cate_type : "",
        districtAjax:"{{route('admin.area.districtAjax')}}",
        wardAjax:"{{route('admin.area.wardAjax')}}",

   }
   seach_khuvuc.init();
</script>
@endsection
