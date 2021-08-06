<div class="header-search">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <select name="search_cate_type" class="form-control " id="search_cate_type" >
                    <option value="cate_buy">Mua Bán</option>
                    <option value="cate_lease">Cho thuê</option>
                    <option value="cate_project">Dự án</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select name="search_category_id" class="form-control " id="search_category_id" >
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <input type="text" id="search_query" value="{{ request()->get('q') }}" class="form-control" placeholder="Nhập từ khóa tìm kiếm ... " >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button type="button" id="btn-search" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
        </div>
    </div>

</div>
<style>
    .header-search{
        padding-top: 15px;
        background-color: #fff;
        padding-left: 15px;
        padding-right: 15px;
        border-radius: 5px 5px;
    }
</style>
@section('runJS')
@parent
<script src="{{asset('web/search/header.js')}}"></script>
<script>
   var search_header = new search_header();
   search_header.datas={
        urlSearch:"{!! request()->root() !!}",
        cate_type:"cate_buy",
        lease:@json(getRealestateLease()),
        buy:@json(getRealestateBuy()),
        project:@json(getRealestateProject()),
   }
   search_header.init();
</script>
@endsection
