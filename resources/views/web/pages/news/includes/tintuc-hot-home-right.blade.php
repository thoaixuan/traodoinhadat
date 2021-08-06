


<div class="efch-2 ef-img-t">
    <h2 class="ns__hot--title1">Tin nóng</h2>
    <div class="nsh__slick--right nsh__slick--right-js">
        @foreach (getPostHotRight() as $row)
            <div>
                @foreach ($row as $item)
                @php
                if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                    $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                }else{
                    $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                }
                @endphp
                <a href="{{$url}}" class="nshs__card">
                    <span class="nshs__card--num">{{$item->post_view}}</span>
                    <div class="nshs__card--img">
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
                    <div class="nshs__card--info">
                      <h3 class="nshs__card--title">{{ $item->post_title }}</h3>
                      <p class="nshs__card--text">{{time_Ago($item->post_time)}}</p>
                      <p class="nshs__card--text">{{($item->created_at)}}</p>
                    </div>
                  </a>
                @endforeach
            </div>

        @endforeach
    </div>
    <div class="slick-group-button">
      <div class="c-arrow1 c-arrow1--left disabled">
        <i class="icon icon-arrow-2" aria-hidden="true"></i>
      </div>
      <div class="c-arrow1 c-arrow1--right">
        <i class="icon icon-arrow-1" aria-hidden="true"></i>
      </div>
    </div>
  </div>
