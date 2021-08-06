<section class="bds-noibat bg-white ef-lazy group-ef">
    <div class="container">
        <div class="bds-noibat__header position-relative">
            <h2 class="efch-1 ef-tx-t h2--500">ƯU ĐÃI ĐẶC BIỆT</h2>
        </div>
        <div class="bds-noibat-special slick__btn">
            @foreach (getSliderUuDai() as $item)
            <div>
                <a href="{{ $item->link }}">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}">
                </a>
            </div>
            @endforeach
        </div>
</section>
