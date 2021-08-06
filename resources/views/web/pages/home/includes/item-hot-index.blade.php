<div>
    <div class="item item-hot-index">
        <a href="{{ getRealestateUrl($item) }}" class="img">
            <img src="{{ getImageRealestate($item->id) }}" alt="{{ $item->realestate_title }}">
        </a>
        <div class="info-text">
            <div class="btn-like  save-listing save-listing-320933">
                <span><i class="svs-ic ic-like-1"></i></span>
            </div>

            @if ($item->cate_type=='cate_buy')
            <div class="info__label">
                <span class="label-1">Mua bán</span>
                {{-- <div class="price2">214,3 ngàn/m²</div> --}}
            </div>
             @endif
            @if ($item->cate_type=='cate_lease')
            <div class="danger__label">
                <span class="label-1">Cho thuê</span>
                {{-- <div class="price2">214,3 ngàn/m²</div> --}}
            </div>
            @endif
            @if ($item->cate_type=='cate_project')
            <div class="success__label">
                <span class="label-1">Dự án</span>
                {{-- <div class="price2">214,3 ngàn/m²</div> --}}
            </div>
            @endif

            <div class="wprice">
                <div class="imeta-2">
                    <span>{{ number_format($item->realestate_price) }} VNĐ</span>
                    {{-- <span>35 m²</span> --}}
                </div>
            </div>
            <h3>
                <a href="{{ getRealestateUrl($item) }}" class="title"> {{ $item->realestate_title }}</a>
            </h3>
            <a href="{{ getRealestateUrl($item) }}">
                @if ($item->cate_type_form=='NHA')
                    <div class="imeta-3">
                        <span><i class="svs-ic ic-compass"></i>{{ showHuong($item->realestate_nha_huong) }}</span>
                        <span><i class="svs-ic ic-tub"></i>{{$item->realestate_nha_phongngu}}</span>
                        <span><i class="svs-ic ic-bed"></i>{{$item->realestate_nha_phongtam}}</span>
                    </div>
                @endif

                <div class="imeta-1">
                    <p class="ward-district">
                        <i class="svs-ic ic-address"></i>
                        @if ($item->ward_name){{ $item->ward_name }} ,@endif
                        @if ($item->district_name){{ $item->district_name }} ,@endif
                        @if ($item->province_name){{ $item->province_name }} @endif
                    </p>
                </div>
            </a>
        </div>
        <a href=""> </a>
    </div>
</div>
