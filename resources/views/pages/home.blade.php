@extends('namvutru')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
{{--    <div class="col-xs-12 carausel-sliderWidget">--}}
{{--        <section id="halim-advanced-widget-4">--}}
{{--            <div class="section-heading">--}}
{{--                <a href="danhmuc.php" title="Phim Chiếu Rạp">--}}
{{--                    <span class="h-text">Phim Chiếu Rạp</span>--}}
{{--                </a>--}}
{{--                <ul class="heading-nav pull-right hidden-xs">--}}
{{--                    <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div id="halim-advanced-widget-4-ajax-box" class="halim_box">--}}
{{--                <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">--}}
{{--                    <div class="halim-item">--}}
{{--                        <a class="halim-thumb" href="{{route('movie')}}" title="GÓA PHỤ ĐEN">--}}
{{--                            <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>--}}
{{--                            <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>--}}
{{--                            <div class="icon_overlay"></div>--}}
{{--                            <div class="halim-post-title-box">--}}
{{--                                <div class="halim-post-title ">--}}
{{--                                    <p class="entry-title">GÓA PHỤ ĐEN</p>--}}
{{--                                    <p class="original_title">Black Widow</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--            </div>--}}
{{--        </section>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
    <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
            <h3 class="section-title"><span>PHIM HOT</span></h3>
        </div>
        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
            @foreach($phimhot as $key => $phimh)
            <article class="thumb grid-item post-38494">
                <div class="halim-item">
                    <a class="halim-thumb" href="{{route('movie',$phimh->slug)}}" title="{{$phimh->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$phimh->image)}}" alt="Image Phim" title="Image Phim"></figure>
                        <span class="status">
                             @if($phimh->resolution==0)
                                HD
                            @elseif($phimh->resolution==1)
                                SD
                            @elseif($phimh->resolution==2)
                                CAM
                            @elseif($phimh->resolution==3)
                                Full HD
                            @else
                                Trailer
                            @endif
                        </span>
                        <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                           @if($phimh->subtitle==1)
                                Thuyết minh
                                @if($phimh->season!=0)
                                    - Sesion {{$movi->season}}
                                @endif

                            @else
                                Phụ đề
                                @if($phimh->season!=0)
                                    -Season {{$phimh->season}}
                                @endif
                            @endif
                        </span> <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                            <div class="halim-post-title ">
                                <p class="entry-title">{{$phimh->title}}</p>
                                <p class="original_title">{{$phimh->origintitle}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </article>
            @endforeach


        </div>

    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        @foreach($category_home as $key => $cate_home)
        <section id="halim-advanced-widget-2">
            <div class="section-heading">
                <a href="{{route('category',$cate_home->slug)}}" title="{{$cate_home->title}}">
                    <span class="h-text">{{$cate_home->title}}</span>
                </a>
            </div>
            <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                @foreach($cate_home->movie->take(12) as $key=> $movi)
                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                    <div class="halim-item">
                        <a class="halim-thumb" href="{{route('movie',$movi->slug)}}">
                            <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$movi->image)}}" alt="{{$movi->title}}" title="{{$movi->title}}"></figure>
                            <span class="status">
                                  @if($movi->resolution==0)
                                    HD
                                @elseif($movi->resolution==1)
                                    SD
                                @elseif($movi->resolution==2)
                                    CAM
                                @elseif($movi->resolution==3)
                                    Full HD
                                @else
                                      Trailer
                                @endif
                            </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                            @if($movi->subtitle==1)
                                    Thuyết minh
                                    @if($movi->season!=0)
                                         - Season {{$movi->season}}
                                    @endif

                                @else
                                    Phụ đề
                                    @if($movi->season!=0)
                                            -Season {{$movi->season}}
                                    @endif
                                @endif
                            </span>
                            <div class="icon_overlay"></div>
                            <div class="halim-post-title-box">
                                <div class="halim-post-title ">
                                    <p class="entry-title">"{{$movi->title}}"</p>
                                    <p class="original_title">"{{$movi->origintitle}}"</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </article>
                @endforeach

            </div>
        </section>
        <div class="clearfix"></div>
        @endforeach

        <div class="clearfix"></div>

        <div class="clearfix"></div>
    </main>
@include('pages.include.sidebar')
</div>
@endsection
