<footer class="ef-lazy group-ef">
    <div class="container d-md-block d-none">
        <div class="row grid-space-5">
            <div class="col-lg-6 col-md-5 efch-1 ef-img-t">
                <div class="footer-info">
                    <p>
                        <a href="https://traodoinhadat.com/" target="_blank" class="footer-info__logo">
                            <img class="" width="200px" src="{{asset(setting()->logo)}}" class="img-fluid"> TRAODOINHADAT.COM
                        </a>
                    </p>
                    <p>
                        Địa chỉ : {{ setting()->contact_address }}
                    </p>
                    <p>
                        Email: <a href="mailto:{{ setting()->contact_mail }}?Subject=Liên hệ">{{ setting()->contact_mail }}</a>
                    </p>
                    <div class="footer-info__text--500">Hãy gọi cho chúng tôi để được tư vấn 24/7</div>
                    <div class="footer-info__call">
                        <a href="tel:+{{ setting()->contact_phone }}">
                            <i class="icon-phone"></i> * 8080
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-7">
                <div class="row grid-space-5">
                    <div class="col-md-4  efch-2 ef-img-t">
                        <div class="footer__title">Về TRAODOINHADAT.COM</div>
                        <ul>
                            <li>
                                <a href="{{ route('web.page.about') }}">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="{{ route('web.page.service') }}">Dịch vụ</a>
                            </li>
                            <li>
                                <a href="{{ route('web.contact.index') }}">Liên hệ</a>
                            </li>
                            <li>
                                <a href="{{ route('web.page.privacy.policy') }}">Chính sách bảo mật</a>
                            </li>
                            @foreach (getPagesFooter() as $item)
                            <li><a href="{{ route('web.page.index',$item->post_slug) }}">{{ $item->post_title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4  efch-3 ef-img-t">
                        <div class="footer__title">Dịch vụ</div>
                        <ul>
                            <li>
                                <a href="{{ route('web.realestate.send') }}">Gửi BDS miễn phí</a>
                            </li>
                            <li>
                                <a href="{{ route('web.page.service') }}">Thông tin quy hoạch</a>
                            </li>
                            <li>
                                <a href="{{ route('web.page.service') }}">Thẩm định giá BĐS</a>
                            </li>
                            <li>
                                <a href="https://tuvanhotro.com">Pháp lý BĐS</a>
                            </li>
                            <li>
                                <a href="{{ route('web.page.service') }}">Thủ tục vay mua nhà</a>
                            </li>
                            <li>
                                <a href="{{ route('web.page.service') }}">Đảm bảo thanh toán qua Ngân hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4  efch-4 ef-img-t">
                        <div class="footer__title">Hệ thống TRAODOINHADAT</div>
                        <ul>
                            <li>
                                <a href="{{ route('web.realestate.all','mua') }}">Mua nhà</a>
                            </li>
                            <li>
                                <a href="{{ route('web.realestate.send') }}">Bán nhà</a>
                            </li>
                            <li>
                                <a href="{{ route('web.realestate.all','thue') }}">Thuê nhà</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__line"></div>
        <div class="row grid-space-5">
            <div class="col-lg-3 col-md-3  efch-5 ef-img-t">
                <div class="footer__title--small">Tải app ngay</div>
                <!--
                <a rel="noreferrer" target="_blank" href="">
                    <img class="img-fluid" alt="ING app" src="{{asset('themes/web/img/app.svg')}}">
                </a>-->
                &nbsp;
                <a rel="noreferrer" target="_blank" href="">
                    <img class="img-fluid" alt=" app" src="{{asset('themes/web/img/g-play.svg')}}">
                </a>
            </div>
            <div class="col-lg-3 col-md-5  efch-6 ef-img-t">
                <a rel="noreferrer" target="_blank" href="">
                    <img class="logo-bocongthuong" alt="https://traodoinhadat.com/" title="" src="{{asset('themes/web/img/img-dathongbao.png')}}">
                </a>
            </div>
            <div class="col-lg-4 col-md-5  efch-6 ef-img-t">
                <div class="footer__title--small">Đăng ký nhận thông tin mới nhất </div>
                <div id="alertJSSubscribe"></div>
                <div role="search" id="email-subcribe" class="footer__search footer__input">
                    <form id="formSubscribe" action="{{ route('web.subscribe.add') }}">

                        <div class="form-group">
                            <input class="textinput form-control" required type="email"  name="email" id="subscribe_email" placeholder="Nhập email để nhận thông tin">
                        </div>
                        <button type="submit" aria-label="subscribe email"  id="buttonSubscribe" class="searchbutton">
                            <i class="icon-arrow-6"> </i>
                        </button>
                    </form>
                </div>

            </div>
            <div class="col-lg-2 col-md-4 efch-6 ef-img-t">
                <div class="footer__title--small">Kết nối với chúng tôi</div>
                <ul class="footer__social ">
                    <li>
                        <a rel="noreferrer" class="item" title="" target="_blank" href="">
                            <i class="icon-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a rel="noreferrer" class="item" title="" target="_blank" href="">
                            <i class="icon-zalo"></i>
                        </a>
                    </li>
                    <li>
                        <a rel="noreferrer" class="item" title="" target="_blank" href="">
                            <i class="icon-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a rel="noreferrer" class="item" title="" target="_blank" href="">
                            <i class="icon-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container d-sm-block d-md-none" id="before-footer">
        <div class="wlogo">
            <a href="/" class="logo"><img alt="TRAO ĐỔI NHÀ ĐẤT" src="{{asset('themes/web/img/logo-footer.png')}}"></a>
            <ul class="footer__social">
                <li>
                    <a rel="noreferrer" class="item" title="" target="_blank" href="">
                        <i class="icon-facebook"></i>
                    </a>
                </li>
                <li>
                    <a rel="noreferrer" class="item" title="" target="_blank" href="">
                        <i class="icon-zalo"></i>
                    </a>
                </li>
                <li>
                    <a rel="noreferrer" class="item" title="" target="_blank" href="">
                        <i class="icon-linkedin"></i>
                    </a>
                </li>
                <li>
                    <a rel="noreferrer" class="item" title="" target="_blank" href="">
                        <i class="icon-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-district s-nav">
            <div class="item">
                <div class="tinh">Bà Rịa - Vũng Tàu</div>
                <div class="district">
                    <ul>
                    @foreach (getDistrictSetup() as $item)
                        <li> <a href="{{ route('web.realestate.all','mua') }}/ba-ria---vung-tau/{{ $item->district_slug }}"><b class="bold-seo">{{ $item->district_name }}</b></a> </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="wmenu">
            <div class="row grid-space-10">
                <div class="col-md-2 col-6"><a href="{{ route('web.contact.index') }}" class="">Liên hệ</a></div>
                <div class="col-md-2 col-6"><a href="." class="">Hỏi đáp</a></div>
                <div class="col-md-4 col-6 text-right tuyendung"><a href="{{ route('web.page.service') }}" class="btn">Dịch vụ </a></div>
                <div class="col-md-4 col-6">
                    <a rel="noreferrer" target="_blank" href=".">
                        <img class="logo-bocongthuong" title="" src="{{asset('themes/web/img/img-dathongbao.png')}}">
                    </a>
                </div>
            </div>
        </div>
        <div class="wform">
            <div id="email-subcribe" class="searchform input">
                <div class="form-group">
                    <input name="email" class="textinput" type="email" required=""
                        placeholder="Nhập email để nhận thông tin mới nhất">
                </div>
                <button id="btnSubscribeEmail" type="submit" aria-label="subscribe email" class="searchbutton">
                    <i class="svs-ic-mb ic-arrow-b"> </i>
                </button>
            </div>
            <span class="ING-newsletter hidden"></span>
        </div>
    </div>
</footer>

