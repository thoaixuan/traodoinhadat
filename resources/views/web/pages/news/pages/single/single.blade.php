@extends('web.layouts.news')
@section('news')
<section class="breadcrumbs">
    <div class="container">
      <div class="col-xl-7">
        <span class="item">
          <a href="{{route('web.home.index')}}">TRANG CHỦ </a>
        </span>
        <span class="item">
          <a href="{{route('web.news.index')}}">TIN TỨC</a>
        </span>
        <span class="item">
              @if($post->cate_slug_parent!="" || $post->cate_slug_parent!=null){
                  <a href="{{route('web.news.news',[$post->cate_slug_parent,$post->cate_slug,$post->post_slug])}}">{{$post->cate_name}}</a>
              @else
                <a href="{{route('web.news.news',[$post->cate_slug_parent,$post->cate_slug,$post->post_slug])}}">{{$post->cate_name}}</a>
              @endif
        </span>
        <span class="item">{{$post->post_title}}</span>
      </div>
      <div class="col-xl-5 c-page2">
        @isset($post->previous)
            @if($post->previous->cate_slug_parent!=""||$post->previous->cate_slug_parent!=null){
                <a class="c-page2__btn1 prev" href="{{route('web.news.news',[$post->previous->cate_slug_parent,$post->previous->cate_slug,$post->previous->post_slug])}}" rel="prev"><i class="icon fas fa-arrow-left"></i> <span>Tin trước đó</span></a>
            @else
            <a class="c-page2__btn1 prev" href="{{route('web.news.news',[$post->previous->cate_slug,$post->previous->post_slug])}}" rel="prev"><i class="icon fas fa-arrow-left"></i> <span>Tin trước đó</span></a>
            @endif
        @endisset
        @isset($post->next)
        @if($post->next->cate_slug_parent!=""||$post->next->cate_slug_parent!=null){
            <a class="c-page2__btn1 next"  rel="prev" href="{{route('web.news.news',[$post->next->cate_slug_parent,$post->next->cate_slug,$post->next->post_slug])}}" rel="prev"> <span>Tin tiếp theo</span> <i class="icon fas fa-arrow-right"></i></i></a>
        @else
            <a class="c-page2__btn1 next"  rel="prev" href="{{route('web.news.news',[$post->next->cate_slug,$post->next->post_slug])}}" rel="prev"> <span>Tin tiếp theo</span> <i class="icon fas fa-arrow-right"></i></i></a>
        @endif
        @endisset
      </div>
    </div>
</section>
  <div class="content tintuc">
    <div class="l-layout1">
      <div class="container">
        <div class="row">
          <div class="tintuc__content group-ef col-md-12 col-lg-9 ef-lazy">
            <div class="p-post1">
              <div class="p-post1__box1">
                <h1 class="p-post1__title1">{{$post->post_title}}</h1>
                <div class="efch-2 ef-img-t">
                  <div class="p-post1__info1">
                    <div class="box1">
                      <a class="label1" href=""> Góc tư vấn </a>
                      <ul class="c-list-info1 clock1-js">
                        <li>
                          <i class="icon">
                            <img src="{{asset('themes/web/img/clock.svg')}}"
                              alt="line">
                          </i>
                          <span>{{$post->created_at}}</span>
                        </li>
                        <li>
                          <i class="icon">
                            <img src="{{asset('themes/web/img/line1.svg')}}"
                              alt="line">
                          </i>
                          <span>{{$post->post_view}}</span>
                        </li>
                      </ul>
                    </div>
                    <div class="box2">
                      <div
                        class="essb_links essb_counters essb_displayed_shortcode essb_share essb_template_default4-retina essb_template_glow-retina essb_1363147484 essb_size_s essb_links_right print-no"
                        id="essb_displayed_shortcode_1363147484" data-essb-postid="130876"
                        data-essb-position="shortcode" data-essb-button-style="icon"
                        data-essb-template="default4-retina essb_template_glow-retina"
                        data-essb-counter-pos="insidehover"
                        data-essb-url="{{URL::current()}}"
                        data-essb-fullurl="{{URL::current()}}"
                        data-essb-instance="1363147484">
                        <ul class="essb_links_list essb_force_hide_name essb_force_hide">
                          <li class="essb_item essb_totalcount_item" data-counter-pos="insidehover">
                            <span class="essb_totalcount essb_t_l_big essb_total_icon essb_icon_share-tiny" title=""
                              data-shares-text="share">
                              <span class="essb_t_nb">{{$post->post_share}}<span class="essb_t_nb_after">share</span></span>
                            </span>
                          </li>
                          <li class="essb_item essb_link_facebook nolightbox">
                            <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" title="Share on Facebook" target="_blank" rel="noreferrer noopener nofollow"
                              class="nolightbox">
                              <span class="essb_icon essb_icon_facebook"></span>
                              <span class="essb_network_name essb_noname essb_hideonhover"></span>
                              <span class="essb_counter_insidehover" data-cnt="0" data-cnt-short="0">0</span>
                            </a>
                          </li>
                          <li class="essb_item essb_link_twitter nolightbox">
                            <a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url={{URL::current()}};text={{ $post->post_title }}', 'Share This Post', 'width=640,height=450');return false" title="Share on Twitter" target="_blank" rel="noreferrer noopener nofollow"
                              class="nolightbox">
                              <span class="essb_icon essb_icon_twitter"></span>
                              <span class="essb_network_name essb_noname essb_hideonhover"></span>
                              <span class="essb_counter_insidehover" data-cnt="0" data-cnt-short="0">0</span>
                            </a>
                          </li>
                          <li class="essb_item essb_link_pinterest nolightbox">
                            <a href="javascript:void(0)" onclick="window.open('http://pinterest.com/pin/create/button/?url={{URL::current()}};media={{URL::current()}}{{$post->post_image}}', 'Share This Post', 'width=640,height=450');return false" title="Share on Pinterest" target="_blank" rel="noreferrer noopener nofollow"
                              class="nolightbox">
                              <span class="essb_icon essb_icon_pinterest"></span>
                              <span class="essb_network_name essb_noname essb_hideonhover"></span>
                              <span class="essb_counter_insidehover" data-cnt="0" data-cnt-short="0">0</span>
                            </a>
                          </li>
                          <li class="essb_item essb_link_linkedin nolightbox">
                            <a href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" title="Share on LinkedIn" target="_blank" rel="noreferrer noopener nofollow"
                              class="nolightbox">
                              <span class="essb_icon essb_icon_linkedin"></span>
                              <span class="essb_network_name essb_noname essb_hideonhover"></span>
                              <span class="essb_counter_insidehover" data-cnt="0" data-cnt-short="0">0</span>
                            </a>
                          </li>
                        </ul>
                      </div><!--
                      <div class="zalo-share-button" data-href="" data-oaid="310578488608053699" data-layout="3"
                        data-color="blue" data-customize="false"
                        style="overflow: hidden; display: inline-block; width: 30px; height: 30px;">
                        <iframe frameborder="0" allowfullscreen="" scrolling="no" width="30px" height="30px"
                          src="https://sp.zalo.me/plugins/share?dev=null&color=blue&oaid=310578488608053699&href={{URL::current()}}&layout=3&customize=false&callback=null&id=3e6123b1-8d4e-482f-a2c8-7e0f69fc73d3&domain=propzy.vn&android=false&ios=false"></iframe>
                      </div>-->
                    </div>
                  </div>
                </div>
                <article class="post">
                  <div class="post_inner">
                    <div class="post_list1 c-showPC">
                      <div class="p-post-icons-js">
                        <ul>
                          <li class="btn1">
                            <a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false" >
                              <i class="icon icon-facebook"></i>
                            </a>
                          </li>
                          <li class="btn2">
                            <a target="_blank">
                              <i class="icon fab fa-facebook-messenger"></i>
                            </a>
                          </li>
                          <li class="btn3">
                            <a target="_blank">
                              <i class="icon far fa-envelope"></i>
                            </a>
                          </li>
                          <li class="btn4">
                            <a href="javascript:void(0)" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}', 'Share This Post', 'width=640,height=450');return false">
                              <i class="icon icon-linkedin"></i>
                            </a>
                          </li><!--
                          <li class="btn5 zalo-btn">
                            <div class="zalo-share-button" data-href="" data-oaid="310578488608053699" data-layout="3"
                              data-color="blue" data-customize="true">
                              <i class="icon icon-zalo"></i>
                              <iframe frameborder="0" allowfullscreen="" scrolling="no" width="0px" height="0px"
                                src="https://sp.zalo.me/plugins/share?dev=null&amp;color=blue&amp;oaid=310578488608053699&amp;href={{URL::current()}};layout=3&amp;customize=true&amp;callback=null&amp;id=3cca6e82-f55b-4b2f-a188-e1ab508024e2&amp;domain=propzy.vn&amp;android=false&amp;ios=false"
                                style="position: absolute;"></iframe>
                            </div>
                          </li>-->
                        </ul>
                      </div>
                    </div>
                    <div class="post_box1">
                      <div class="post_content1 efch-2 ef-img-t">
                        <div class="post_content1 efch-2 ef-img-t">
                            @php
                            if($post->post_image_max!=NULL){
                                if ( file_exists(public_path($post->post_image_max))&&$post->post_image_max!=""){
                                    $post_image = $post->post_image_max;
                                }else{
                                    $post_image = asset('uploads/defaults/img-df.png');

                                }
                            }else{
                                $post_image = asset('uploads/defaults/img-df.png');
                            }
                            @endphp
                            <img class="alignnone wp-image-130882 size-full" src="{{ $post_image }}" alt="{{$post->post_title}}">
                            {!!$post->post_content!!}
                      </div>
                      {{-- <section class="p-post1__tag">
                        <p class="text1">#Từ Khoá:</p>
                        <ul class="list1">
                          <li><a href="/tukhoadaune-tagdiv"> sổ hồng </a></li>
                          <li><a href="/tukhoadaune-tagdiv"> sổ hồng chung cư </a></li>
                          <li><a href="/tukhoadaune-tagdiv"> tư vấn pháp lý </a></li>
                        </ul>
                      </section> --}}
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>
          <div class="c-sidebar1 col-md-12 col-lg-3 group-ef ef-lazy">
            {{-- POST week --}}
            @include('web.pages.news.includes.tintuc-category')
            {{-- AND POST week --}}
            {{-- POST week --}}
            @include('web.pages.news.includes.tintuc-week')
            {{-- AND POST week --}}
            {{-- POST SHARE --}}
            @include('web.pages.news.includes.tintuc-share')
            {{-- AND POST SHARE --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('web.includes.service_subfooter')
@endsection
