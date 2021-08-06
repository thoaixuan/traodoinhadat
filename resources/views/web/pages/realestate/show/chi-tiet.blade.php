@extends('web.layouts.page')
@section('page')
        <!-- Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container">
                <span class="item">
                    <a href="{{ route('web.home.index') }}">Trang chủ</a>
                </span>
                @foreach ($breadcrumbs as $item)
                @if ($item->name)
                <span class="item">
                    <a href="{{ $item->url }}">{{ $item->name }}</a>
                </span>
                @endif
                @endforeach

            </div>
        </section>
        <!-- Breadcrumbs -->
        <!-- Tin tức content -->
        <div class="content p-product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="product-detail-feature">
                            <div class="product-list">
                                <div class="product-syn-1">
                                    <div class="product__list--big slick__btn">
                                        @foreach ($data->images as $item)
                                        <div class="">
                                            <div class="item">
                                                <a class="img tRes-60">
                                                    <img title="ING" alt="{{$data->result->realestate_title}}"
                                                        src="{{$item}}">
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="product-syn-2">
                                    <div class="product__list--small">
                                        @foreach ($data->images as $item)
                                        <div class="">
                                            <div class="item">
                                                <a class="tRes-70">
                                                    <img title="ING"
                                                        alt="{{$data->result->realestate_title}}"
                                                        src="{{$item}}">
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="t-detail">
                            <h1 class="h4">{{$data->result->realestate_title}}</h1>
                            <div class="imeta-1">
                                <b> @if ($data->result->ward_name){{ $data->result->ward_name }} ,@endif
                                    @if ($data->result->district_name){{ $data->result->district_name }} ,@endif
                                    @if ($data->result->province_name){{ $data->result->province_name }} @endif</b>
                            </div>
                            <div class="label mb-10">
                                    @if ($data->result->cate_type=='cate_buy')
                                    <div class="label-1 info__label">
                                        <span class="p-type-listing">Mua bán</span>
                                    </div>
                                    @endif
                                    @if ($data->result->cate_type=='cate_lease')
                                    <div class="label-1 danger__label">
                                        <span class="p-type-listing">Cho thuê</span>
                                    </div>
                                    @endif
                                    @if ($data->result->cate_type=='cate_project')
                                    <div class="label-1 success__label">
                                        <span class="p-type-listing">Dự án</span>
                                    </div>
                                    @endif
                                    @if ($data->result->realestate_expertise=='on')
                                    <span class="label-2"><i class="fa fa-check"></i> Đã thẩm định</span>
                                    @endif
                                    @if ($data->result->realestate_sold=='on')
                                    <span class="label-2 success__label"><i class="fa fa-check"></i> Đã bán</span>
                                    @endif

                            </div>
                            <div class="clearfix">
                                <span class="price"><b>{{ number_format($data->result->realestate_price) }}</b> VND</span>
                            </div>

                            <div class="wbtn">
                                <button data-id="{{ $data->result->id }}" data-url="{{ route('web.realestate.save') }}"  data-status={{ checkSave($data->result->id) }}  class="btn btnlike  save-listing save-listing-277705 _buttonSave">
                                    @if (checkSave($data->result->id)=='delete')
                                        Bỏ lưu <i class="icon-like"></i>
                                    @else
                                        Lưu tin <i class="icon-like"></i>
                                    @endif

                                </button>
                                <span class="btn facebook btn-share" id="fb-share" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false"
                                    data-href="{{URL::current()}}">
                                    <i class="icon-facebook"></i> Facebook
                                </span>
                                <span class="btn message" onclick="window.open('https://twitter.com/share?url={{URL::current()}};text={{$data->result->realestate_title}}', 'Share This Post', 'width=640,height=450');return false" title="Share on Twitter" target="_blank" rel="noreferrer noopener nofollow">
                                    <i class="icon-arrow-6"></i> Twitter
                                </span>
                                <a target="_blank" href="mailto:{{ setting()->contact_mail }}?Subject={{$data->result->realestate_title}}"
                                    class="btn mail" title="Share by Email">
                                    <i class="icon-mail-1"></i> Email
                                </a>
                                <a onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" title="Share on LinkedIn" target="_blank" rel="noreferrer noopener nofollow"
                                    class="btn mail" title="Share by linkedin">
                                    <i class="icon-linkedin"></i> Linkedin
                                </a>
                                <!--
                                <span id="show-map-listing" class="btn">
                                    <i class="icon-location"></i> Vị trí
                                </span>-->
                            </div>
                        </div>
                        <div class="row list-item t-detail-s">
                            @if ($data->result->cate_type_form)
                            <div class="col-lg-8">
                                <div class="boxwidget entry-content">
                                    <h2 class="widget-title">Giới thiệu</h2>
                                    <ul class="cols-2">
                                        <li>Hướng: {{ showHuong($data->result->realestate_nha_huong) }}</li>
                                        <li>Phòng ngủ: {{ checkData($data->result->realestate_nha_phongngu) }}</li>
                                        <li>Phòng tắm: {{ checkData($data->result->realestate_nha_phongtam) }}</li>
                                        <li>Tầng: {{ checkData($data->result->realestate_nha_tan) }}</li>
                                        <li>Giấy tờ: {{ checkData($data->result->realestate_nha_giayto) }}</li>
                                        <li>Chiều dài: {{ checkData($data->result->realestate_nha_chieudai) }} m2</li>
                                        <li>Chiều rộng: {{ checkData($data->result->realestate_nha_chieurong) }} m2</li>
                                        <li>Hẻm: {{ showVitri($data->result->realestate_nha_hem) }}</li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if ($data->result->cate_type=='cate_project')
                                <div class="col-lg-12 sidebar ">
                                    @include('web.pages.realestate.includes.dangkytuvan')
                                </div>
                                @else
                                <div class="col-lg-4 sidebar ">
                                    @include('web.pages.realestate.includes.dangkytuvan')
                                </div>
                            @endif
                            
                        </div>
                        @if ($data->result->realestate_mota!="")
                        <div class="boxwidget entry-content">
                            <h2 class="widget-title ">Thông tin chi tiết</h2>
                            <div>
                                {!! ($data->result->realestate_mota) !!}
                            </div>
                        </div>
                        @endif
                        @if ($data->result->cate_type_form=='NHA'&&$data->result->realestate_tien_ich!="")
                        <div class="boxwidget widget-tienich">
                            <h2 class="widget-title">Tiện ích</h2>
                            <div>
                            {!! ($data->result->realestate_tien_ich) !!}
                            </div>
                        </div>
                        @endif

                    </div>
                    <div class="col-md-4 col-lg-3 sidebar">
                        @include('web.pages.realestate.right.tim-nhanh')
                        <div class="widget widget-menu">
                            <h2 class="widget-title">Nhà riêng quận lân cận</h2>
                            <div class="widget-content">
                                <ul>
                                    @foreach (getDistrictSetup() as $item)
                                        <li>
                                            <h3>
                                                <a href="{{ route('web.realestate.all','mua') }}/ba-ria---vung-tau/{{ $item->district_slug }}">
                                                    <span class="text">{{ $item->district_name }}</span>
                                                </a>
                                            </h3>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if (getNhaRiengTheoDuong())
                            @include('web.pages.realestate.right.nhariengtheoduong')
                        @endif
                        @if (getBDSTamGia($data->result))
                            @include('web.pages.realestate.right.cungtamgia',['item'=>getBDSTamGia($data->result)])
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!--END Tin tức content -->
        @include('web.includes.service_subfooter')
@endsection
@section('runCSS')
@parent
@endsection
@section('runJS')
@parent
@endsection
