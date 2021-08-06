<div id="bl-same-price">
    <div class="widget widget-related-bds">
        <h3 class="widget-title-2 h6"><span>BĐS cùng tầm giá</span></h3>
        <div class="widget-content">
            <div class="list-layout-3">
                <div class="item wcontent">
                    <a href="{{ getRealestateUrl($item) }}" class="img tRes-83">
                        <img src="{{asset('themes/web/img/thumb.jpg')}}"
                            alt="Nhà hẻm quận 1, nhà đang ở, sổ hồng riêng chính chủ">
                        <span class="count">6 hình</span>
                    </a>
                    <div class="divtext">
                        <a href="{{ getRealestateUrl($item) }}" class="title">
                            <h4 class="heading-seo">{{ $item->realestate_title }}</h4>
                        </a>
                        <div class="imeta-1">
                            <b> @if ($item->ward_name){{ $item->ward_name }} ,@endif
                                @if ($item->district_name){{ $item->district_name }} ,@endif
                                @if ($item->province_name){{ $item->province_name }} @endif</b>
                        </div>
                        @if ($item->cate_type_form=='NHA')
                        <div class="imeta-3">
                            <span><i class="svs-ic icon-compass"></i> {{ showHuong($item->realestate_nha_huong) }}</span>
                            <span><i class="svs-ic icon-tub"></i> {{$item->realestate_nha_phongngu}}</span>
                            <span><i class="svs-ic icon-bed"></i> {{$item->realestate_nha_phongtam}}</span>
                        </div>
                        @endif
                        <div class="label">
                            @if ($item->cate_type=='cate_buy')
                            <div class="label-1 info__label">
                                <span class="p-type-listing">Mua bán</span>
                            </div>
                            @endif
                            @if ($item->cate_type=='cate_lease')
                            <div class="label-1 danger__label">
                                <span class="p-type-listing">Cho thuê</span>
                            </div>
                            @endif
                            @if ($item->cate_type=='cate_project')
                            <div class="label-1 success__label">
                                <span class="p-type-listing">Dự án</span>
                            </div>
                            @endif
                        </div>
                        <div class="wprice">
                            <div class="imeta-1">
                                <span><b class="float-left">{{ number_format($item->realestate_price) }}</b></span>
                                <span><b class="float-right">VNĐ</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

