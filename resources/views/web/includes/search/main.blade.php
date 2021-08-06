<form id="form-search-buy">
@include('web.includes.search.header')
<div class="advance-search">
    <div id="form-search-buy">
        <div class="row list-item">
                @include('web.includes.search.khuvuc')
        </div>
        <div class="row list-item">
            <div class="col-lg-3 col-md-4 col-size">
                @include('web.includes.search.dientich')
            </div>
            <div class="col-lg-3 col-md-4 col-position-search">
                @include('web.includes.search.vitri')
            </div>
            <div class="col-lg-3 col-md-4 select-direction-container">
                @include('web.includes.search.huong')
            </div>
        </div>
        <div class="row list-item" id="detail_search" style="display: none">
            @include('web.includes.search.tinhtrang')
            <div class="col-lg-6 col-md-12 col-floor-bed-bath select-bed-container">
                <div class="row">
                    <div class="col-4 select-floor-container" style="">
                        <div class="title-2 cl6">Số tầng:</div>
                        <div class="qualitys input">
                                <a class="minus"><i class="icon-minus-2"></i></a>
                                <input id="tan"  placeholder="Số tầng" type="text" name="tan" maxvalue="6" value="{{ request()->get('tan')}}">
                                <a class="plus"><i class="icon-plus-2"></i> </a>
                        </div>
                    </div>
                    <div class="col-4 select-bed-container" style="">
                        <div class="title-2 cl6">Số phòng ngủ:</div>
                        <div class="qualitys input">
                                <a class="minus"><i class="icon-minus-2"></i></a>
                                <input id="phong-ngu"  placeholder="Phòng ngủ" type="text" name="phongngu" maxvalue="6" value="{{ request()->get('phongngu')}}">
                                <a class="plus"><i class="icon-plus-2"></i></a>
                        </div>
                    </div>
                    <div class="col-4 select-bath-container" style="">
                        <div class="title-2 cl6">Số phòng tắm:</div>
                        <div class="qualitys input">
                            <a class="minus"><i class="icon-minus-2"></i></a>
                            <input id="phong-tam"  placeholder="Phòng tắm" type="text" name="phongtam" maxvalue="6" value="{{ request()->get('phongtam')}}">
                            <a class="plus"><i class="icon-plus-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="reset" type="reset"><i class="icon-reset"></i> Xóa</button>
    </div>
</div>
</form>
