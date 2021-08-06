@extends('web.layouts.news')
@section('news')
<div class="content">
    <div class="news group-ef ef-lazy">
      <div class="container">
        <h2 class="text-uppercase h2--500 text-center efch-1 ef-tx-t">{{$cate->cate_name}}</h2>
      </div>
    </div>
    <div class="phongcach">
        <div class="container">
          <div class="row">
            <div class="bg-white box1 group-ef col-md-12 col-lg-9 ef-begin">
              <div class="phongcach-item">
                <div class="c-list1 efch-3 ef-img-t">
                    @foreach ($posts as $item)
                    @php
                    if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                        $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                    }else{
                        $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                    }
                    @endphp
                    <a href="{{$url}}"
                    class="c-list1__card1">
                    <div class="c-list1__img1 tRes-83">
                        @if ($item->post_image_max!=NULL)
                        @if ( file_exists(public_path($item->post_image_max))&&$item->post_image_max!="")
                        <img id=""  src="{{$item->post_image_max}}"/>
                        @else
                        <img id=""  src="{{asset('uploads/defaults/img-df.png')}}"/>
                        @endif
                        @else
                        <img id="" src="{{asset('uploads/defaults/img-df.png')}}"/>
                        @endif
                    </div>
                    <div class="c-list1__info">
                      <h3 class="c-list1__title1">{{$item->post_title}}</h3>
                      <ul class="c-list-info1">
                        <li> <i class="icon"><img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i> <span>{{$item->created_at}}</span></li>
                        <li> <i class="icon"><img src="{{asset('themes/web/img/line1.svg')}}" alt="line"></i>
                          <span>{{$item->post_view}}</span>
                        </li>
                      </ul>
                      <p class="c-list1__text">{{$item->post_des}}</p>
                    </div>
                  </a>
                    @endforeach
                </div>
                <div class="phongcach__btn efch-3 ef-img-t">
                    {!! $posts->links() !!}
                </div>
              </div>
            </div>
            <div class="c-sidebar1 col-md-12 col-lg-3 group-ef ef-begin">
              @include('web.pages.news.includes.subscribe_email')
              {{-- POST week --}}
              @include('web.pages.news.includes.tintuc-week')
              {{-- AND POST week --}}
              {{-- POST SHARE --}}
              @include('web.pages.news.includes.tintuc-share')
              {{-- AND POST SHARE --}}
              <section class="c-internet1 efch-5 ef-img-b">
                <h2 class="c-sidebar1__title1 text-left">Liên kết với chúng tôi</h2>
                <div class="box1">
                  <ul class="list1">
                    <li id="fb-button-render" class="list1_card1">
                      <div class="info1">
                        <div class="list1_icon1"> <i class="icon icon-facebook"></i></div>
                      </div>
                    </li>
                    <li id="yt-button-container-render" class="list1_card1">
                      <div class="list1_youtube1 link-youtube-js">
                        <div class="g-ytsubscribe"></div>
                      </div>
                      <div class="info1 hover-youtube">
                        <div class="list1_icon1"> <i class="icon icon-youtube"></i></div>
                      </div>
                    </li>
                    <li class="list1_card1">
                      <div class="info1">
                        <div class="list1_icon1"> <i class="icon icon-zalo"></i></div>
                      </div>
                    </li>
                  </ul>
                </div>
              </section>
            </div>
          </div>
        </div>
    </div>
</div>
@include('web.includes.service_subfooter')
@endsection

