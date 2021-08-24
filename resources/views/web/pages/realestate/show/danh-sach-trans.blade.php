@extends('web.layouts.page')
@section('page')
        <!-- Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container">
                <span class="item">
                    <a href="{{ route('web.home.index') }}">Trang chủ</a>
                </span>
            </div>
        </section>
        <!-- Breadcrumbs -->
        <!-- Tin tức content -->
        <div class="content sec-tb page-listing search-page-listing">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                     
                        <div class="entry-head-3">
                            <h1 class="ht">
                                <span class="ht1 efch-1 ef-img-l">  DANH SÁCH TÀI SẢN TRAO ĐỔI</span>

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
                            <!-- -->
                            @isset($data)
                                @if (count($data)>0)
                                    @php $i=0;@endphp
                                    @foreach ($data as $item)
                                        <div class="item-house col-6 col-lg-4">
                                            <div class="item is-feature">
                                                <div class="divtext height-buy">
                                                    <p class="text-title-trans">
                                                       Khách hàng : {!!$item->full_name!!} <br/>
                                                       Bất động sản hiện có : <a class="text-primary" href="{!! $item->realestate_slug !!}">Nhấp xem</a> <br/>
                                                       <b>Cần đổi :</b>  {{$item->cate_name}} đang
                                                        <span class="badge badge-primary"> @if($item->send_cate_type=='cate_buy') Bán  @endif
                                                        @if($item->send_cate_type=='cate_lease') Cho thuê @endif</span>
                                                    </p>
                                                    <div class="imeta-1">
                                                        <b>Khu vực : </b>  @if($item->province_name){{$item->province_name}}@endif 
                                                        @if($item->district_name) : {{$item->district_name}}@endif 
                                                        @if($item->ward_name) - {{$item->ward_name}}@endif
                                                        <p>Chi tiết : 
                                                            {!!$item->realestate_mota!!}
                                                        </p>
                                                    </div>
                                                    <div class="imeta-3">
                                                        <a href="tel:+{{ setting()->contact_phone }}" class="btn btn-primary"><i class="fas fa-phone-square-alt"></i> Liên hệ</a>
                                                        <a href="{{ route('web.contact.index') }}" class="btn btn-info"><i class="far fa-address-card"></i> Để lại thông tin</a>
                                                        <span class="badge badge-warning"><i class="fas fa-calendar-alt"></i> {{$item->created_at}}</span>
                                                        <span class="badge badge-default"><i class="fas fa-user-clock"></i> {{time_Ago($item->send_realestate_time)}}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="price-trans">
                                                        <div class="">
                                                            <span><b class="float-left"></b>{{$item->realestate_tien_ich}}</b></span>
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
                            @endisset
                            <!-- -->
                            
                        </div>
                        <div class="pages">
                               {{--  {!! $data->result->links() !!}  --}}
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
<script src="{{asset('web/account/account.js')}}"></script>
<script>
   var account = new account();
   account.datas={
        type:"{{ $type }}",
   }
   account.init();
</script>
@endsection
