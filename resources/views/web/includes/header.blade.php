<section class="fixed" id="header">
    <div class="container">
        <a href="/" class="header__logo">
            <img src="{{asset(setting()->logo)}}" alt="ING">
        </a>
        <ul class="menu-top-header left" data-style="1">
            <li class="children">
                <span class="showsubmenu icon-arrow-2 ib"></span>
                <a href="{{ route('web.realestate.all','mua') }}"><span>Mua</span></a>
                <div class="wrapul">
                    <ul>
                        @foreach (getRealestateBuy() as $item)
                        <li><a href="{{ route('web.realestate.all',['mua',$item->cate_slug]) }}">{{ $item->cate_name }}</a> </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="children">
                <span class="showsubmenu icon-arrow-2 ib"></span>
                <a href="{{ route('web.realestate.all','thue') }}"><span>Thuê</span></a>
                <div class="wrapul">
                    <ul>
                        @foreach (getRealestateLease() as $item)
                        <li><a href="{{ route('web.realestate.all',['thue',$item->cate_slug]) }}">{{ $item->cate_name }}</a> </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li><a href="{{ route('web.realestate.all','du-an') }}"><span>Dự án</span></a></li>
        </ul>
        <div class="wrap-menu-header right">
            <ul class="menu-top-header " data-style="1">
                <li><a href="{{route('web.news.index')}}"><span>Tin tức</span></a></li>
                <li><a href="{{ route('web.page.service') }}">Dịch vụ</a></li>
                @foreach (getPagesHeader() as $item)
                <li><a href="{{ route('web.page.index',$item->post_slug) }}">{{ $item->post_title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="group-header">
            <div class="item">
                <a href="{{ route('web.realestate.send') }}" class="btn"> <i class="svs-ic ic-send"></i>Gửi BĐS </a>
            </div>
            @if (Auth::check())
                <a title="{{ user()->full_name }}" role="right"
                    class="dropdown-toggle item avatar-login" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-expanded="true">
                    @php
                    if(Auth::user()->avatar==''){
                        Auth::user()->avatar = "https://www.gravatar.com/avatar/".md5(Auth::user()->email)."jpg?s=64";
                    }
                    @endphp
                    <img style="border-radius: 100%;" src="{{ Auth::user()->avatar }}" width="30px" height="30px">
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if (user()->status=='0')
                        <li><a class="dropdown-item" href="{{route('web.account.hoso')}}">Tài khoản</a></li>
                        <li><a class="dropdown-item" href="{{route('web.account.tindagui')}}">Tin đã gửi</a></li>
                        <li><a class="dropdown-item" href="{{route('web.account.tindaduyet')}}">Tin đã duyệt</a></li>
                        <li><a class="dropdown-item" href="{{route('web.account.tindaluu')}}">Tin đã lưu</a></li>
                        <li><a class="dropdown-item" href="{{route('web.account.doimatkhau')}}">Đổi mật khẩu</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{route('web.account.lienhe')}}">Liên hệ (Admin)</a></li>
                    @if (user()->type=='userAdminCreate'||user()->type=='userAdminDefault')
                        <li><a class="dropdown-item" href="{{route('admin.dashboard.view')}}">Bảng điều khiển</a></li>
                    @endif
                    <li><a class="dropdown-item button-logout" href="{{ route('web.auth.logout') }}">Đăng xuất</a></li>
                </ul>
            @else
            <a class="item item-user" data-toggle="modal" data-target="#popup-login">
                <i class="svs-ic ic-user"></i>
            </a>
            @endif

            <a class="item item-like active" href="{{route('web.account.tindaluu')}}">
                <span class="img"> <i class="svs-ic ic-like"></i>
                    <span class="count number-cart"> {{ countRealestateSave() }} </span>
                </span>
            </a>
            <div href="#menu-toggle" id="menu-toggle" class="item imenu">
                <span class="menu-btn x"><span></span></span>
            </div>
        </div>
        <div class="btnShowFilter  btn__search--js">
            <span class="more">Tìm kiếm</span>
            <span class="less">Thu gọn</span>
            <i class="icon-search-2"></i>
        </div>
    </div>
</section>
<div class="afterHeader" style="height: 54px;"></div>
