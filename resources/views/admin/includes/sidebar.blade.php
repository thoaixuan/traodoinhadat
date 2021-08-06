<aside class="main-sidebar sidebar-dark-light elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('web.home.index')}}" class="brand-link text-center">
      <span class="brand-text font-weight-dark">{{ setting()->name }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
    @if (Auth::check())
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @php
            if(Auth::user()->avatar==''){
                Auth::user()->avatar = "https://www.gravatar.com/avatar/".md5(Auth::user()->email)."jpg?s=64";
            }
            @endphp

            <img src="{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="{{ Auth::user()->full_name }}">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->full_name }}</a>
          </div>
        </div>
    @endif
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="menu-open-new nav-item">
                <a href="{{ route('admin.dashboard.view') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Bản điều khiển

                  </p>
                </a>
            </li>
            @if (checkRole('area.view'))
            <li class="menu-open-new   nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                     Quản lý khu vực
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.province.view') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tỉnh thành</p>
                    </a>
                </li>
                <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.district.view') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quận huyện</p>
                    </a>
                </li>
                <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.ward.view') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Phường xã</p>
                    </a>
                </li>
                </ul>
            </li>
            @endif
            @if (checkRole('category.view')||checkRole('news.view')||checkRole('news.add'))
                <li class="menu-open-new  nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Tin Tức
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (checkRole('news.add'))
                        <li class="menu-open-new nav-item">
                            <a href="{{ route('admin.news.add') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Viết bài</p>
                            </a>
                        </li>
                        @endif
                        @if (checkRole('category.view'))
                        <li class="menu-open-new nav-item">
                            <a href="{{ route('admin.category.parent.view') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thể loại</p>
                            </a>
                        </li>
                        @endif
                        @if (checkRole('news.view'))
                        <li class="menu-open-new nav-item">
                            <a href="{{ route('admin.news.view') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bài viết</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (checkRole('page.view')||checkRole('page.add'))
            <li class="menu-open-new  nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                     Trang
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                @if (checkRole('page.add'))
                  <li class="menu-open-new nav-item">
                    <a href="{{route('admin.page.add') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Thêm trang mới</p>
                    </a>
                  </li>
                @endif
                @if (checkRole('page.view'))
                  <li class="menu-open-new nav-item">
                    <a href="{{route('admin.page.view') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tất cả trang</p>
                    </a>
                  </li>
                @endif
                </ul>
            </li>
            @endif
            @if (checkRole('realestate.add')||checkRole('realestate.received')||checkRole('realestate.view'))
            <li class="menu-open-new menu-open  nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-house-user"></i>
                  <p>
                     Bất động sản
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (checkRole('realestate.add'))
                    <li class="menu-open-new nav-item">
                      <a href="{{route('admin.realestate.add') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Đăng tin</p>
                      </a>
                    </li>
                    @endif
                    @if (checkRole('realestate.received'))
                    <li class="menu-open-new nav-item">
                      <a href="{{route('admin.realestate.received') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tin Đã nhận</p>
                        <span class="right badge badge-info">{{ countRealestateSend() }}</</span>
                      </a>
                    </li>
                    @endif
                    @if (checkRole('realestate.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{route('admin.realestate.view') }}?type=published" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tin đã duyệt</p>
                        <span class="right badge badge-success">{{ countRealestatePublic() }}</</span>
                        </a>
                    </li>
                    <li class="menu-open-new nav-item">
                        <a href="{{route('admin.realestate.view') }}?type=draft" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tin nháp</p>
                        <span class="right badge badge-warning">{{ countRealestateDraft() }}</</span>
                        </a>
                    </li>
                    <li class="menu-open-new nav-item">
                        <a href="{{route('admin.realestate.view') }}?type=lock" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tin Khóa</p>
                        <span class="right badge badge-danger">{{ countRealestateLock() }}</</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if (checkRole('contact.view'))
            <li class="menu-open-new nav-item">
                <a href="{{ route('admin.contact.view') }}" class="nav-link">
                    <i class="nav-icon fas fa-mail-bulk"></i>
                  <p>
                     Tin nhắn liên hệ
                  </p>
                  <span class="right badge badge-danger">{{ countContactStatus() }}</</span>
                </a>
            </li>
            @endif
            @if (checkRole('subscribe.view'))
            <li class="menu-open-new nav-item">
                <a href="{{ route('admin.subscribe.view') }}" class="nav-link">
                    <i class="nav-icon fas fa-envelope-open-text"></i>
                  <p>
                     Đăng ký nhận Email
                  </p>
                </a>
            </li>
            @endif
            @if (checkRole('sitemap.view'))
            <li class="nav-item menu-open-new">
                <a href="{{ route('admin.sitemap.view') }}" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                Công cụ SEO
                </p>
                </a>
            </li>
            @endif
            @if (checkRole('user.view')||checkRole('user.add'))
            <li class="menu-open-new  nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Người dùng
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (checkRole('user.add'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.user.add') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Thêm người dùng</p>
                    </a>
                  </li>
                  @endif
                  @if (checkRole('user.view'))
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.user.view') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tất cả người dùng</p>
                    </a>
                  </li>
                  @endif
                </ul>
            </li>
            @endif
            @if (checkRole('slider.view'))
            <li class="menu-open-new  nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-image"></i>
                  <p>
                    Quản lý Slider
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.slider.view') }}?type=home" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Slider trang chủ</p>
                    </a>
                  </li>
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.slider.view') }}?type=sendBDS" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Slider gửi tin</p>
                    </a>
                  </li>
                  <li class="menu-open-new nav-item">
                    <a href="{{ route('admin.slider.view') }}?type=uudai" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Slider ưu đải</p>
                    </a>
                  </li>

                </ul>
            </li>
            @endif
            @if (checkRole('role.view')||checkRole('setting.view'))
            <li class="menu-open-new nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                     Hệ thống
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (checkRole('role.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.role.view') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phân quyền</p>
                        </a>
                    </li>
                    @endif
                    @if (checkRole('setting.view'))
                    <li class="menu-open-new nav-item">
                        <a href="{{ route('admin.setting.view') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cài đặt chung</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
      </nav>

    </div>
  </aside>
