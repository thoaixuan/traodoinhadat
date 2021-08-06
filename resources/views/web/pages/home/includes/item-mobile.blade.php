
<div class="col-6">
    <div class="item-mb">
        <a href="{{ getRealestateUrl($item) }}" class="img">
            <img src="{{ getImageRealestate($item->id) }}" alt="{{ $item->realestate_title }}">
        </a>
        <div class="bds-mobile-info">
            <div class="bds-mobile-price">
                <p class="p-price"> {{ number_format($item->realestate_price) }} VNĐ</p>
                {{-- <p class="p-area-price">115,5 ngàn/m²</p> --}}
            </div>
            <h3 class="title">
                {{ $item->realestate_title }}
            </h3>
            @if ($item->cate_type_form=='NHA')
                <div class="imeta-3">
                    <span><i class="svs-ic ic-compass"></i>{{ showHuong($item->realestate_nha_huong) }}</span>
                    <span><i class="svs-ic ic-tub"></i>{{$item->realestate_nha_phongngu}}</span>
                    <span><i class="svs-ic ic-bed"></i>{{$item->realestate_nha_phongtam}}</span>
                </div>
            @endif
            <p class="p-district">
                <i class="svs-ic ic-address"></i>
                @if ($item->ward_name){{ $item->ward_name }} ,@endif
                @if ($item->district_name){{ $item->district_name }} ,@endif
                @if ($item->province_name){{ $item->province_name }} @endif
            </p>
            @if ($item->cate_type=='cate_buy')
            <div class="info__label">
                <span class="p-type-listing">Mua bán</span>
            </div>
            @endif
            @if ($item->cate_type=='cate_lease')
            <div class="danger__label">
                <span class="p-type-listing">Cho thuê</span>
            </div>
            @endif
            @if ($item->cate_type=='cate_project')
            <div class="success__label">
                <span class="p-type-listing">Dự án</span>
            </div>
            @endif

        </div>
    </div>
</div>

