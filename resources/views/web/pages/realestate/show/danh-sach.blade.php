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
        <div class="content sec-tb page-listing search-page-listing">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <p> Có <strong class="cl1">{{ $data->count }}</strong> </p>
                        <div class="entry-head-3">
                            <h1 class="ht">
                                <span class="ht1 efch-1 ef-img-l">{{ $data->info->name }}</span>

                            </h1>
                            <div class="group-header">
                                <div class="item">
                                    @php

                                    @endphp
                                    <select id="shortData" class="select sort">
                                        <option  value="{{\URL::current()}}">Sắp xếp</option>
                                        <option  value="{{\URL::current()}}?direction=desc&sort=realestate_price">Giá từ thấp đến cao</option>
                                        <option  value="{{\URL::current()}}?direction=desc&sort=realestate_price">Giá từ cao xuống thấp</option>
                                        <option  value="{{\URL::current()}}?direction=desc&sort=realestate_dat_dientich">Diện tích từ nhỏ đến lớn</option>
                                        <option  value="{{\URL::current()}}?direction=desc&sort=realestate_dat_dientich">Diện tích từ lớn đến nhỏ</option>
                                    </select>
                                </div>
                                <a id="view-grid" class="item grid active type-view" data-show="1">
                                    <i class="icon-grid"></i>
                                </a>
                                <a id="view-list" class="item list type-view " data-show="2">
                                    <i class="icon-list"></i>
                                </a>
                            </div>
                        </div>
                        <div id="view-as-gird" class="row list-layout-0 list-item">
                            @if (count($data->result)>0)
                            @foreach ($data->result as $item)
                            <div class="item-house col-6 col-lg-4">
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
                                    @if ($item->realestate_hot=='on')
                                    <div class="special-1">
                                        <span>Đặc biệt</span>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="item-house col-12 col-lg-12">
                                <div class="alert alert-warning">
                                    <strong>  Không có kết quả nào được tìm thấy !</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="pages">
                                {!! $data->result->links() !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 sidebar">
                        @include('web.pages.realestate.right.tim-nhanh')
                        <div class="widget widget-menu">
                            <h2 class="widget-title">BĐS lân cận</h2>
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
                        <div class="widget widget-menu">
                            <h2 class="widget-title">Tin nổi bật</h2>
                                <section class="box1">
                                    @php $i = 0;@endphp
                                    @foreach (getWeekPost(1) as $item)
                                        @php
                                        if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                                            $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                                        }else{
                                            $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                                        }
                                        @endphp
                                        @php $i++;@endphp
                                        @if ($i==1)
                                        <a href="{{$url}}" class="c-img1" >
                                            <div class="c-img1__img1 tRes-75">
                                                @if ($item->post_image_max!=NULL)
                                                @if (file_exists(public_path($item->post_image_max))&&$item->post_image_max!="")
                                                <img alt="{{$item->post_title}}" src="{{$item->post_image_max}}"/>
                                                @else
                                                <img alt="{{$item->post_title}}" src="{{asset('uploads/defaults/img-df.png')}}"/>
                                                @endif
                                                @else
                                                <img alt="{{$item->post_title}}" src="{{asset('uploads/defaults/img-df.png')}}"/>
                                                @endif
                                            </div>
                                            <div class="c-img1__info1">
                                            <h3 class="c-img1__title1">{{$item->post_title}}</h3>
                                            <ul class="c-list-info1">
                                                <li><i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i><span>{{($item->created_at)}} <br> {{time_Ago($item->post_time)}}</span></li>
                                            </ul>
                                            </div>
                                        </a>
                                        @endif
                                    @endforeach
                                    @php $i = 0;@endphp
                                    @foreach (getWeekPost(5) as $item)
                                        @php
                                        if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                                            $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                                        }else{
                                            $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                                        }
                                        @endphp
                                        @php $i++;@endphp
                                        @if($i>1)
                                        <div class="c-sm-list1">
                                            <a href="{{$url}}" class="list1_card1">
                                            <div class="list1_info_es">
                                                <h3 class="list1_title1">{{$item->post_title}}</h3>
                                                <ul class="c-list-info1">
                                                    <li>
                                                        <li>
                                                            <i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i>
                                                            <span>{{($item->created_at)}} - {{time_Ago($item->post_time)}}</span>
                                                        </li>
                                                    </li>
                                                </ul>
                                            </div>
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach
                                </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tin tức content -->
        @include('web.includes.service_subfooter')
@endsection
@section('runCSS')
@parent

@endsection
@section('runJS')
@parent
<script>
    $(document).ready(function() {
        $("#shortData").on('change',function(){
            return window.location.href = $(this).val();
        });
        var value = "{!!request()->fullUrl()!!}";
        var shortData =  $("#shortData").val();
        if(value==shortData){
            $("#shortData").val("{{\URL::current()}}");
        }else{
            $("#shortData").val(value);
        }

    ;})
</script>
@endsection
