<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim hot</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach($phimhot_sidebar as $key => $movi)
                    <div class="item post-37176">
                        <a href="{{route('movie',$movi->slug)}}" title="{{$movi->title}}">
                            <div class="item-link">
                                <img src="{{asset('uploads/movie/'.$movi->image)}}" class="lazy post-thumb" alt="{{$movi->title}}" title="{{$movi->title}}" />
                                <span class="is_trailer">
                                     @if($movi->resolution==0)
                                        <td>HD</td>
                                    @elseif($movi->resolution==1)
                                        <td>SD</td>
                                    @elseif($movi->resolution==2)
                                        <td>CAM</td>
                                    @elseif($movi->resolution==3)
                                        <td>Full HD</td>
                                    @else
                                        <td>Trailer</td>
                                    @endif
                                </span>
                            </div>
                            <p class="title">{{$movi->title}}</p>

                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>

    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim sắp chiếu</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    @foreach($phimhot_trailer as $key => $movi)
                        <div class="item post-37176">
                            <a href="{{route('movie',$movi->slug)}}" title="{{$movi->title}}">
                                <div class="item-link">
                                    <img src="{{asset('uploads/movie/'.$movi->image)}}" class="lazy post-thumb" alt="{{$movi->title}}" title="{{$movi->title}}" />
                                    <span class="is_trailer">
                                     @if($movi->resolution==0)
                                            <td>HD</td>
                                        @elseif($movi->resolution==1)
                                            <td>SD</td>
                                        @elseif($movi->resolution==2)
                                            <td>CAM</td>
                                        @elseif($movi->resolution==3)
                                            <td>Full HD</td>
                                        @else
                                            <td>Trailer</td>
                                        @endif
                                </span>
                                </div>
                                <p class="title">{{$movi->title}}</p>

                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>

</aside>
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>

            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="home-tab" data-toggle="tab" href="#day" role="tab" aria-controls="home" aria-selected="true">Day</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="profile-tab" data-toggle="tab" href="#week" role="tab" aria-controls="profile" aria-selected="false">Week</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="contact-tab" data-toggle="tab" href="#month" role="tab" aria-controls="contact" aria-selected="false">Month</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="home-tab">
                <div id ="halim-ajax-popular-post" class="popular-post">
                    <span id="show0"></span>
                </div>

            </div>
            <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="profile-tab">
                <span id="show1"></span>
{{--                <div class="item post-37176">--}}
{{--                    --}}
{{--                    <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">--}}
{{--                        <div class="item-link">--}}
{{--                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />--}}
{{--                            <span class="is_trailer">Trailer</span>--}}
{{--                        </div>--}}
{{--                        <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>--}}
{{--                    </a>--}}
{{--                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>--}}
{{--                    <div style="float: left;">--}}
{{--                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">--}}
{{--                                 <span style="width: 0%"></span>--}}
{{--                                 </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="contact-tab">
                <span id="show2"></span>
{{--                <div class="item post-37176">--}}
{{--                    --}}
{{--                    <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">--}}
{{--                        <div class="item-link">--}}
{{--                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />--}}
{{--                            <span class="is_trailer">Trailer</span>--}}
{{--                        </div>--}}
{{--                        <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>--}}
{{--                    </a>--}}
{{--                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>--}}
{{--                    <div style="float: left;">--}}
{{--                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">--}}
{{--                                 <span style="width: 0%"></span>--}}
{{--                                 </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</aside>

