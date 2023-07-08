@extends('namvutru')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{$gen_slug->title}}</a> » <span class="breadcrumb_last" aria-current="page">2020</span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>{{$gen_slug->title}}</span></h1>
                </div>
                <div class="halim_box">
                    @foreach($movie_genre as $key => $movi_gen)
                        @if($movi_gen->movie->status==1)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{route('movie',$movi_gen->movie->slug)}}" title="{{$movi_gen->movie->title}}">
                                    <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$movi_gen->movie->image)}}" alt="VŨNG LẦY PHẦN 1" title="VŨNG LẦY PHẦN 1"></figure>
                                    <span class="status">
                                       @if($movi_gen->movie->resolution==0)
                                            HD
                                        @elseif($movi_gen->movie->resolution==1)
                                            SD
                                        @elseif($movi_gen->movie->resolution==2)
                                            CAM
                                        @elseif($movi_gen->movie->resolution==3)
                                            Full HD
                                        @else
                                            Trailer
                                        @endif
                                    </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if($movi_gen->movie->subtitle==1)
                                            Thuyết minh
                                            @if($movi_gen->movie->season!=0)
                                                - Season {{$movi_gen->movie->season}}
                                            @endif

                                        @else
                                            Phụ đề
                                            @if($movi_gen->movie->season!=0)
                                                -Season {{$movi_gen->movie->season}}
                                            @endif
                                        @endif
                                    </span>
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <p class="entry-title">{{$movi_gen->movie->title}}</p>
                                            <p class="original_title">{{$movi_gen->movie->origintitle}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                        @endif
                    @endforeach


                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                    {!!$movie_genre ->links("pagination::bootstrap-4")!!}
                </div>
            </section>
        </main>
        @include('pages.include.sidebar')
    </div>
@endsection

