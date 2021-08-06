
<div>
    <div class="item is-feature">
        <a href="{{ getRealestateUrl($item) }}" class="img tRes-82">
            <img src="{{ getImageRealestate($item->id) }}" alt="{{ $item->realestate_title }}">
            @if (countImageRealestate($item->id)>0)
                <span class="no-mage"> {{ countImageRealestate($item->id) }} hình</span>
            @else
            <span class="no-mage">Không có hình ảnh</span>
            @endif

        </a>
        <div class="divtext height-buy">
            <a href="{{ getRealestateUrl($item) }}" class="title">{{ $item->realestate_title }}</a>
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
            <div class="wprice">
                <div class="imeta-1">
                    <span><b class="float-left">{{ number_format($item->realestate_price) }}</b></span>
                    <span><b class="float-right">VNĐ</b></span>
                </div>
            </div>
        </div>
        @if ($item->realestate_hot==='on')
        <div class="special-1">
            <span>Đặc biệt</span>
        </div>
        @endif

    </div>
</div>
