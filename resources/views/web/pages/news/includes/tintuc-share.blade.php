<div class="mb50 efch-3 ef-img-b">
    <section class="c-hot-posts">
      <h2 class="c-sidebar1__title1 text-left  efch-1 ef-img-b">Tin tức chia sẽ nhiều</h2>
      <section class="box1">
        <div class="c-sm-list1">
          @foreach (getSharePost(5) as $item)
          @php
          if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
              $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
          }else{
              $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
          }
          @endphp
          <div class="c-sm-list1">
              <a href="{{$url}}" class="list1_card1">
              <div class="list1_img1">
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
              <div class="list1_info">
                  <h3 class="list1_title1">{{$item->post_title}}</h3>
                  <ul class="c-list-info1">
                  <li>
                      <li><i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i><span>{{($item->created_at)}} <br> {{time_Ago($item->post_time)}}</span></li>
                  </li>
                  </ul>
              </div>
              </a>
          </div>
          @endforeach
        </div>
      </section>
    </section>
  </div>
