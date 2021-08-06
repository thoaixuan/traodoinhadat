<div class="widget widget-menu">
                            <h2 class="widget-title">Tin nổi bật</h2>
                                <section class="box1">
                                    @php $i = 0;@endphp
                                    @foreach (getWeekPost(1) as $item)
                                        @php
                                        if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                                            $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                                        }else{
                                            $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                                        }
                                        @endphp
                                        @php $i++;@endphp
                                        @if ($i==1)
                                        <a href="{{$url}}" class="c-img1" >
                                            <div class="c-img1__img1 tRes-75">
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
                                            <div class="c-img1__info1">
                                            <h3 class="c-img1__title1">{{$item->post_title}}</h3>
                                            <ul class="c-list-info1">
                                                <li><i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i><span>{{($item->created_at)}} <br> {{time_Ago($item->post_time)}}</span></li>
                                            </ul>
                                            </div>
                                        </a>
                                        @endif
                                    @endforeach
                                    @php $i = 0;@endphp
                                    @foreach (getWeekPost(5) as $item)
                                        @php
                                        if($item->cate_slug_parent!=""||$item->cate_slug_parent!=null){
                                            $url = route('web.news.news',[$item->cate_slug_parent,$item->cate_slug,$item->post_slug]);
                                        }else{
                                            $url = route('web.news.news',[$item->cate_slug,$item->post_slug]);
                                        }
                                        @endphp
                                        @php $i++;@endphp
                                        @if($i>1)
                                        <div class="c-sm-list1">
                                            <a href="{{$url}}" class="list1_card1">
                                            <div class="list1_info_es">
                                                <h3 class="list1_title1">{{$item->post_title}}</h3>
                                                <ul class="c-list-info1">
                                                    <li>
                                                        <li>
                                                            <i class="icon"> <img src="{{asset('themes/web/img/clock.svg')}}" alt="line"></i>
                                                            <span>{{($item->created_at)}} - {{time_Ago($item->post_time)}}</span>
                                                        </li>
                                                    </li>
                                                </ul>
                                            </div>
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach
                                </section>
</div>