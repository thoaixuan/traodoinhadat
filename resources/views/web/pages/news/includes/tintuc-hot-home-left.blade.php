<div class="row">
    <div class="col-md-8">
        @foreach (getPostLeft()->std_8 as $item)
        @php
        if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
            $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
        }else{
            $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
        }
        @endphp
            <a class="c-img1 efch-2 ef-tx-t" href="{{$url}}">
                <div class="c-img1__img1 tRes-76">
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
                <div class="c-img1__info1">
                <h3 class="c-img1__title1">{{ $item->post_title }}</h3>
                <ul class="c-list-info1">
                    <li>
                    <i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i> <span>{{($item->created_at)}} - {{time_Ago($item->post_time)}}</span>
                    </li>
                    <li>
                    <i class="icon"> <img class="icon" src="{{asset('themes/web/img/line1.svg')}}" alt="line"></i>
                    <span>{{($item->post_view)}}</span>
                    </li>
                </ul>
                </div>
            </a>
        @endforeach
    </div>
    <div class="col-md-4">
        @foreach (getPostLeft()->std_4 as $item)
        @php
        if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
            $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
        }else{
            $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
        }
        @endphp
        <a class="c-img1 efch-2 ef-tx-t" style="margin-bottom: 20px" href="{{$url}}">
            <div class="c-img1__img1 tRes-76">
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
            <div class="c-img1__info1">
            <h3 class="c-img1__title1">{{ $item->post_title }}</h3>
            <ul class="c-list-info1">
                <li>
                <i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i> <span>{{($item->created_at)}} - {{time_Ago($item->post_time)}}</span>
                </li>
                <li>
                <i class="icon"> <img class="icon" src="{{asset('themes/web/img/line1.svg')}}" alt="line"></i>
                <span>{{($item->post_view)}}</span>
                </li>
            </ul>
            </div>
        </a>
    @endforeach
    </div>
  </div>
