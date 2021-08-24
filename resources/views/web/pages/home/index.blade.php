@extends('web.layouts.home')
@section('home')
<section class="content">
    <!-- Quick Action -->
    <section class="quick-action bg-white">
        <div class="container">
            <div class="qa-icon"> <a href="{{ route('web.realestate.all','mua/nha-rieng') }}"> <i class="icon icon-house-1"></i>Mua nhà </a> </div>
            <div class="qa-icon"> <a href="{{ route('web.realestate.all','thue/nha-rieng') }}"> <i class="icon icon-house-2"></i>Thuê nhà </a> </div>
            <div class="qa-icon"> <a href="{{ route('web.realestate.all','mua/can-ho') }}"> <i class="icon icon-house-3"></i>Mua căn hộ </a> </div>
            <div class="qa-icon"> <a href="{{ route('web.realestate.all','thue/can-ho') }}"> <i class="icon icon-house-4"></i>Thuê căn hộ </a> </div>
            <div class="qa-icon"> 
                <a href="{{ route('traodoinhadat.tintuc','trao_doi') }}') }}"> <i class="icon icon-house-5"></i>Trao đổi BĐS</a> 
            </div>
            <div class="qa-icon"> <a href="{{ route('web.realestate.all','du-an') }}"> <i class="icon icon-house-6"></i>Mua đất nền dự án</a> </div>
            <div class="qa-icon"> <a href="{{ route('web.contact.index') }}"> <i class="icon icon-house-7"></i>Yêu cầu BĐS </a> </div>
            <div class="qa-icon"> <a href="tel:+{{ setting()->contact_phone }}" title="{{ setting()->contact_phone }}"> <i class="icon icon-house-8"></i>Liên hệ Hotline</a> </div>
        </div>
    </section>
    <!-- Quick Action -->
    @include('web.pages.home.includes.uu_dai_dat_biet')
    <div class="d-sm-block d-md-none bds-noibat-mobile">
        <div class="container">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="item list-group-item-action active" id="list-profile-list-3" data-toggle="list" href="#getRealestateHot_Buy" role="tab" aria-controls="profile">Mua</a>
                <a class="item list-group-item-action" id="getRealestateHot_Lease" data-toggle="list" href="#list-messages-3" role="tab" aria-controls="messages">Thuê</a>
                <a class="item list-group-item-action" id="getRealestateHot_Project" data-toggle="list" href="#list-settings-3" role="tab" aria-controls="settings">Dự Án</a>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="getRealestateHot_Buy" role="tabpanel" aria-labelledby="list-profile-list-3">
                    <div class="row">
                        @foreach (getRealestateHot_Buy() as $item)
                        @include('web.pages.home.includes.item-mobile')
                        @endforeach
                    </div>
                    <div class="col-12">
                        <a href="{{ route('web.realestate.all','mua') }}?dacbiet=on" id="btn-view-all-hot" class="btn btn-readmore-full">Xem tất cả</a>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-messages-3" role="tabpanel"  aria-labelledby="getRealestateHot_Lease">
                    <div class="row">
                        @foreach (getRealestateHot_Lease() as $item)
                        @include('web.pages.home.includes.item-mobile')
                        @endforeach
                    </div>
                    <div class="col-12">
                        <a href="{{ route('web.realestate.all','mua') }}?dacbiet=on"  id="btn-view-all-hot" class="btn btn-readmore-full">Xem tất cả</a>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-settings-3" role="tabpanel" aria-labelledby="getRealestateHot_Project">
                    <div class="row">
                        @foreach (getRealestateHot_Project() as $item)
                        @include('web.pages.home.includes.item-mobile')
                        @endforeach
                    </div>
                    <div class="col-12">
                        <a href="{{ route('web.realestate.all','mua') }}?dacbiet=on" id="btn-view-all-hot" class="btn btn-readmore-full">Xem tất cả</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-md-block d-none">
        <!-- BĐS Nổi bật -->
        <section class="bds-noibat bg-white ef-lazy group-ef">
            <div class="container">
                <div class="bds-noibat__header position-relative">
                    <h2 class="text-uppercase h2--500">BẤT ĐỘNG SẢN NỔI BẬT</h2>
                    <button class="btn btn-all btn--viewall">
                        <a href="{{ route('web.realestate.all','mua') }}?dacbiet=on">Xem tất cả</a>
                    </button>
                </div>
                <div class="bds-noibat-info">
                    <div class="bds-info__districtId slick__btn slick__district">
                    @foreach (getDistrictSetup() as $item)
                        <div>
                            <div class="info__districtId--item ">
                                <a href="{{ route('web.realestate.all','mua') }}/ba-ria---vung-tau/{{ $item->district_slug }}">{{ $item->district_name }}</a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="bds-noibat-hot__info list__layout slick__btn">
                    @foreach (getRealestateHot() as $item)
                    @include('web.pages.home.includes.item-hot-index')
                    @endforeach
                </div>
            </div>
        </section>
        <!-- BĐS Nổi bật -->
        <!-- Mua Bán BĐS -->
        <section class="bds-buy bg-white ef-lazy group-ef">
            <div class="container">
                <div class="bds-buy position-relative">
                    <h2 class="text-uppercase efch-1 ef-tx-t  h2--500">Mua bán bất động sản</h2>
                    <button class="btn btn-all btn--viewall">
                        <a href="{{ route('web.realestate.all','mua') }}?dacbiet=on">Xem tất cả</a>
                    </button>
                </div>
                <div class="bds-buy-info">
                    <div class="bds-info__districtId slick__btn slick__district">
                        @foreach (getDistrictSetup() as $item)
                            <div>
                                <div class="info__districtId--item {{--active--}}">
                                    <a href="{{ route('web.realestate.all','mua') }}/ba-ria---vung-tau/{{ $item->district_slug }}">{{ $item->district_name }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bds-buy__info list__layout slick__btn">
                    @foreach (getRealestate_Buy() as $item)
                    @include('web.pages.home.includes.item-hot-index')
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Mua Bán BĐS -->

        <!-- Cho thuê BĐS -->
        <section class="bds-chothue bg-white ef-lazy group-ef">
            <div class="container">
                <div class="bds-buy position-relative">
                    <h2 class="text-uppercase efch-1 ef-tx-t  h2--500">Cho thuê bất động sản</h2>
                    <button class="btn btn-all btn--viewall">
                        <a href="{{ route('web.realestate.all','thue') }}?dacbiet=on">Xem tất cả</a>
                    </button>
                </div>
                <div class="bds-chothue-info">
                    <div class="bds-info__districtId slick__btn slick__district">
                        @foreach (getDistrictSetup() as $item)
                            <div>
                                <div class="info__districtId--item {{--active--}}">
                                    <a href="{{ route('web.realestate.all','mua') }}/ba-ria---vung-tau/{{ $item->district_slug }}">{{ $item->district_name }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bds-buy__info list__layout slick__btn">
                    @foreach (getRealestate_Lease() as $item)
                    @include('web.pages.home.includes.item-hot-index')
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Cho thuê BĐS -->
    </div>
    @if (count(getRealestateHot_Project())>0)
    <section class="bds-duan bg-white ef-lazy group-ef">
                <div class="container">
                    <div class="bds-buy position-relative">
                        <h2 class="text-uppercase efch-1 ef-tx-t  h2--500">Dự án nổi bật</h2>
                        <button class="btn btn-all btn--viewall">
                            <a href="{{ route('web.realestate.all','du-an') }}">Xem tất cả</a>
                        </button>
                    </div>
                    <div class="row row__border">
                        @if (count(getRealestateHot_Project())>0)
                        @php
                            $duan = getRealestateHot_Project()[0];

                        @endphp
                        <div class="col-lg-6">
                            <div class="duan">
                                <a href="{{ getRealestateUrl($duan) }}" class="da__img">
                                    <img src="{{ getImageRealestate($duan->id) }}">
                                </a>
                                <div class="da__info">
                                    <h4 class="da__info--title">
                                        <a href="">{{ $duan->realestate_title }}</a>
                                    </h4>
                                    <div class="imeta-1">
                                        <p class="ward-district">
                                            <i class="svs-ic ic-address"></i>
                                            @if ($item->ward_name){{ $item->ward_name }} ,@endif
                                            @if ($item->district_name){{ $item->district_name }} ,@endif
                                            @if ($item->province_name){{ $item->province_name }} @endif
                                        </p>
                                    </div>
                                    @if ($duan->cate_type=='cate_project')
                                    <div class="">
                                        <span class="label-1"><span>{{ number_format($item->realestate_price) }} VNĐ</span></span>
                                    </div>
                                    @endif
                                </div>
                                <a href="{{ getRealestateUrl($duan) }}" class="da__viewall">Xem thêm thông tin dự án</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="duan__info--1 list__layout slick__btn">
                                    @foreach (getRealestateHot_Project() as $item)
                                        @include('web.pages.home.includes.item-hot-index')
                                    @endforeach
                            </div>
                        </div>
                        @else
                        <div class="col-lg-12">
                            <div class="alert alert-success">
                                <strong> Chưa có dự án nào !</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
    </section>
    @endif
    <!-- Tại sao chọn -->
    <section class="why-option ef-lazy group-ef">
        <div class="container">
            <h2 class="text-center efch-1 ef-tx-t">Vì sao chọn ING?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="wo__item">
                        <div class="wo__item--img">
                            <i class="svs-ic ic-why-1"></i>
                        </div>
                        <h4 class="title">Hàng nghìn bất động <br> sản đăng bán mỗi ngày</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wo__item">
                        <div class="wo__item--img">
                            <i class="svs-ic ic-why-2"></i>
                        </div>
                        <h4 class="title">Mua bán đảm bảo với <br> dịch vụ pháp lý miễn phí</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wo__item">
                        <div class="wo__item--img">
                            <i class="svs-ic ic-why-3"></i>
                        </div>
                        <h4 class="title">Giao dịch đảm bảo và <br> tiện lợi tại các TC</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END Tại sao chọn -->
    @include('web.includes.service_subfooter')
</section>
@endsection

