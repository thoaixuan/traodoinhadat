<div class="widget widget-filter">
    <h2 class="widget-title">Tìm nhanh</h2>
    <div class="list-group row grid-space-0 tab-menu  mua" id="list-tab-search" role="tablist">
        <div class="col-4 item list-group-item list-group-item-action active" id="list-mua-list"
            data-toggle="list" href="#list-mua" role="tab" aria-controls="mua" data-value="cate_buy">
            <span>Mua</span>
        </div>
        <div class="col-4 item list-group-item list-group-item-action thue" id="list-thue-list"
            data-toggle="list" href="#list-thue" role="tab" aria-controls="thue" data-value="cate_lease">
            <span>Thuê</span>
        </div>
        <div class="col-4 item list-group-item list-group-item-action du-an" id="list-duan-list"
            data-toggle="list" href="#list-duan" role="tab" aria-controls="duan" data-value="cate_project">
            <span>Dự án</span>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
            <form id="form-search-buy-sidebar2">
                <div class="widget-content">
                    <select style="display: none" class="form-control ms-options-wrap" id="right_search_cate_type" >
                        <option value="cate_buy">Mua Bán</option>
                        <option value="cate_lease">Cho thuê</option>
                        <option value="cate_project">Dự án</option>
                    </select>
                    <div class="f-s-2 input-group col-listing-type_sb"
                        style="display: inline-table;">
                        <div class="input-group-addon none">Loại hình BĐS</div>
                        <select class="form-control ms-options-wrap" id="right_search_category_id" >

                        </select>

                    </div>
                    <div class="col-city_sb">
                        <select id="right_search_provinceID" class="form-control form-control-sm select" disabled aria-readonly="" readonly="">
                            <option {{ setting()->provinceID==""?'selected':'' }} value="">- Chọn tỉnh thành -</option>
                            @foreach (getProvinces() as $item)
                            <option data-slug="{{ $item->province_slug }}" data-id="{{ $item->id }}"  value="{{ $item->province_slug }}">{{ $item->province_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-district_sb">
                        <select  id="right_search_districtID" class="form-control form-control-sm select">
                            <option value="">- Chọn quận huyện -</option>
                        </select>
                    </div>
                    <div class="col-ward_sb">
                            <select  id="right_search_wardID" class="form-control form-control-sm select">
                                <option value="">- Chọn phường xã -</option>
                            </select>

                    </div>
                    <div class="acordion-search box-collapse">
                        <div class="tab-hidden">
                            <div class="col-size_sb">
                                <select id="right_realestate_dat_dientich" class="select style-0" name="right_realestate_dat_dientich">
                                    <option {{ request()->get('min')==''?'selected':'' }} value="" data-min-size="" data-max-size="">Diện tích</option>
                                    <option {{ request()->get('min')=='0'?'selected':'' }} value="0" data-min-size="0" data-max-size="30">Dưới 30 m2</option>
                                    <option {{ request()->get('min')=='31'?'selected':'' }} value="31" data-min-size="31" data-max-size="40">31 m2 - 40 m2</option>
                                    <option {{ request()->get('min')=='41'?'selected':'' }} value="41" data-min-size="41" data-max-size="50">41 m2 - 50 m2</option>
                                    <option {{ request()->get('min')=='51'?'selected':'' }} value="51" data-min-size="51" data-max-size="60">51 m2 - 60 m2</option>
                                    <option {{ request()->get('min')=='61'?'selected':'' }} value="61" data-min-size="61" data-max-size="70">61 m2 - 70 m2</option>
                                    <option {{ request()->get('min')=='71'?'selected':'' }} value="71" data-min-size="71" data-max-size="80">71 m2 - 80 m2</option>
                                    <option {{ request()->get('min')=='81'?'selected':'' }} value="81" data-min-size="81" data-max-size="90">81 m2 - 90 m2</option>
                                    <option {{ request()->get('min')=='91'?'selected':'' }} value="91" data-min-size="91" data-max-size="100">91 m2 - 100 m2</option>
                                    <option {{ request()->get('min')=='100'?'selected':'' }} value="100" data-min-size="100" data-max-size="100000">Trên 100 m2</option>
                                </select>

                            </div>
                            <div class="col-position-search_sb">
                                <select class="select style-0" id="right_realestate_nha_hem" name="right_realestate_nha_hem">
                                    <option value="" selected="">Vị trí</option>
                                    @foreach (listViTri() as $item)
                                    <option  {{ request()->get('hem')==$item['value']?'selected':'' }} value="{{ $item['value'] }}">{{ $item['text'] }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="row">
                                <div class="col-12 select-floor-container" style="">
                                    <div class="title-2 cl6">Số tầng:</div>
                                    <div class="qualitys input">
                                            <a class="minus"><i class="icon-minus-2"></i></a>
                                            <input id="right_tan"  placeholder="Số tầng" type="text" name="tan" maxvalue="6" value="{{ request()->get('tan')}}">
                                            <a class="plus"><i class="icon-plus-2"></i> </a>
                                    </div>
                                </div>
                                <div class="col-12 select-bed-container" style="">
                                    <div class="title-2 cl6">Số phòng ngủ:</div>
                                    <div class="qualitys input">
                                            <a class="minus"><i class="icon-minus-2"></i></a>
                                            <input id="right_phong-ngu"  placeholder="Phòng ngủ" type="text" name="phongngu" maxvalue="6" value="{{ request()->get('phongngu')}}">
                                            <a class="plus"><i class="icon-plus-2"></i></a>
                                    </div>
                                </div>
                                <div class="col-12 select-bath-container" style="">
                                    <div class="title-2 cl6">Số phòng tắm:</div>
                                    <div class="qualitys input">
                                        <a class="minus"><i class="icon-minus-2"></i></a>
                                        <input id="right_phong-tam"  placeholder="Phòng tắm" type="text" name="phongtam" maxvalue="6" value="{{ request()->get('phongtam')}}">
                                        <a class="plus"><i class="icon-plus-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-title tab-title-nc">
                            Lọc nâng cao <span class="triangle"> <i class="icon-plus-2"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="widget-content "> <button id="right_btn-search" class="btn btn-info btn-block" > <i class="fa fa-search"></i> Tìm ngày</button> </div>
    </div>
</div>
