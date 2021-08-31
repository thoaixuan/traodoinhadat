<div class="bg-slider-menu">
    <i id="close-nav" class="a-close"></i>
    <div id="sidebar-wrapper" class="slider-no-scroll">
        <i id="close-nav-mb" class="a-close-mb"></i>
        <ul class="sidebar-nav">
            <li class="active">
                <a href="/" id=""><i class="icon-mn li-1"></i> Trang chủ</a>
            </li>
            <li class="">
                <a href="#" class="text-other"><i class="icon-mn li-2"></i> Mua</a>
                <span class="showsubmenu icon-arrow-3"></span>
                <ul class="sub-menu">
                    @foreach (getRealestateBuy() as $item)
                        <li><a href="{{ route('web.realestate.all',['mua',$item->cate_slug]) }}">{{ $item->cate_name }}</a> </li>
                    @endforeach
                </ul>
            </li>
            <li class="">
                <a href="" class="text-other">
                    <i class="icon-mn li-3"></i> Thuê
                </a>
                <span class="showsubmenu icon-arrow-3"></span>
                <ul class="sub-menu">
                    @foreach (getRealestateLease() as $item)
                    <li><a href="{{ route('web.realestate.all',['thue',$item->cate_slug]) }}">{{ $item->cate_name }}</a> </li>
                    @endforeach
                </ul>
            </li>
            {{--<li class=""><a href="{{ route('traodoinhadat.tintuc','trao_doi') }}"><i class="icon-mn li-7"></i> Trao đổi BĐS</a></li>--}}
            <li class=""><a href="{{ route('web.realestate.all','du-an') }}" id="nav-du-an"><i class="icon-mn li-4"></i> Dự án</a></li>
            <li class=""><a href="{{ route('web.news.index') }}"><i class="icon-mn li-5"></i> Tin tức</a></li>
            @foreach (getPagesHeader() as $item)
                <li><a href="{{ route('web.page.index',$item->post_slug) }}"><i class="icon-mn li-8"></i> {{ $item->post_title }}</a></li>
            @endforeach
            <li class=""><a href="{{ route('web.page.service') }}"><i class="icon-mn li-7"></i> Dịch vụ</a></li>
            
            <li class="">
                <a href="#"><i class="icon-mn li-11"></i> Về ING</a>
                <span class="showsubmenu icon-arrow-3"></span>
                <ul class="sub-menu">
                    <li><a href="{{ route('web.page.about') }}">Giới thiệu</a></li>
                    <li><a href="#">Những câu hỏi thường gặp</a></li>
                </ul>
            </li>
        </ul>
        <div class="bl-hotline">
            <p class="title-hotline"> Hotline <a href="tel:{{ setting()->contact_phone }}" itemprop="telephone" class="phone">*8080</a>
            </p>
        </div>
        <div class="bl-app">
            <p class="title-app">Tải ứng dụng</p>
            <!--
            <a rel="noreferrer" target="_blank" href="">App store
                <p class="p-app app-store"></p>
            </a>-->
            <a rel="noreferrer" target="_blank" href="">App store
                <p class="p-app app-store-android"></p>
            </a>
        </div>
    </div>
</div>
