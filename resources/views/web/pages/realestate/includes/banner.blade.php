
                <!-- BANNER Đăng Tin -->
                <div class="banner-slick">
                    @foreach (getSliderDangTin() as $item)
                    <div class="banner-slick__img">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" srcset="">
                    </div>
                    @endforeach
                </div>
                <!-- BANNER Đăng Tin-->

