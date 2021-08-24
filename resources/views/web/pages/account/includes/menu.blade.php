
        <div class="info-account">
            <div class="account-avatar text-center">
                @php
                if(Auth::user()->avatar==''){
                    Auth::user()->avatar = "https://www.gravatar.com/avatar/".md5(Auth::user()->email)."jpg?s=64";
                }
                @endphp

                <a href="javascript:;" class="change-image-acount">
                    <div class="account-img"
                        style="background: url('{{Auth::user()->avatar}}');background-position: center;">
                        <span class="span-camera"></span>
                    </div>
                </a>
                <input type="file" name="file-image-acount" class="hidden">
            </div>
            <p class="p-name"> <b>{{user()->full_name}}</b> </p>
            <p class="p-member">Thành viên từ {{user()->created_at}}</p>
            @if (user()->loai_hinh_thuc_bds=='moi_gioi')
                <p class="btn btn-primary btn-block">Môi giới chính thức</p>
            @else
                <p class="btn btn-info  btn-block">Chủ nhà</p>
            @endif

        </div>
        <div class="list-group nav-info" id="list-tab" role="tablist">
            @if (user()->status=='0')
            <a href="{{ route('web.account.tindagui') }}" class="list-group-item list-group-item-action {{$type=="tindagui"?"active":""}}">
                <i class="fas fa-list"></i>Tin đã gửi <span class="float-right ">(<span class="count">{{ countRealestateSendWeb() }}</span>)</span>
            </a>
            <a href="{{ route('web.account.tintraodoi') }}" class="list-group-item list-group-item-action {{$type=="tintraodoi"?"active":""}}">
                <i class="fas fa-list"></i>Tin Trao đổi  <span class="badge badge-info">New</span>
                {{-- <span class="float-right ">(<span class="count">{{ countRealestateSendWeb() }}</span>)</span> --}}
            </a>

            <a href="{{ route('web.account.tindaduyet') }}" class="list-group-item list-group-item-action {{$type=="tindaduyet"?"active":""}}">
                <i class="fas fa-list"></i>Tin đã duyệt <span class="float-right ">(<span class="count">{{ countRealestatePublicWeb() }}</span>)</span>
            </a>
            <a href="{{ route('web.account.tindaluu') }}" class="list-group-item list-group-item-action {{$type=="tindaluu"?"active":""}}">
                <i class="fas fa-folder-open"></i>Tin đã lưu <span class="float-right ">(<span class="count">{{ countRealestateSave()   }}</span>)</span>
            </a>
            <a href="{{ route('web.account.hoso') }}" class="list-group-item list-group-item-action {{$type=="hoso"?"active":""}}">
                <i class="far fa-user"></i>Thông tin cá nhân
            </a>
            <a href="{{ route('web.account.doimatkhau') }}" class="list-group-item list-group-item-action {{$type=="doimatkhau"?"active":""}}">
                <i class="fas fa-lock"></i>Đổi mật khẩu
            </a>
            @endif
            <a href="{{ route('web.account.lienhe') }}" class="list-group-item list-group-item-action {{$type=="lienhe"?"active":""}}">
                <i class="fas fa-envelope-open-text"></i> Liên hệ (Admin) <span class="float-right "></span>
            </a>

            <a class="list-group-item list-group-item-action button-logout"
                data-toggle="list"  href="{{ route('web.auth.logout') }}" role="tab" aria-controls="account-8">
                <i class="fas fa-sign-out-alt"></i>Đăng xuất
            </a>
        </div>

