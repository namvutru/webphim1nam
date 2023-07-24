<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="theme-color" content="#234556">
    <meta http-equiv="Content-Language" content="vi" />
    <meta content="VN" name="geo.region" />
    <meta name="DC.language" scheme="utf-8" content="vi" />
    <meta name="language" content="Việt Nam">
    <link rel="shortcut icon" href="{{asset('uploads/logo/'.$info->logo)}}" type="image/x-icon" />
    <meta name="revisit-after" content="1 days" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <title>
        @if(isset($movie_here))
            {{$movie_here->title}} -
        @endif
        {{$info->title}}
    </title>
    <meta name="description" content="{{$info->description}}" />
    <link rel="canonical" href="">
    <link rel="next" href="" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="{{$info->title}}" />
    <meta property="og:description" content="{{$info->description}}" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="{{$info->title}}" />
    <meta property="og:image" content="" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="55" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel='stylesheet' id='bootstrap-css' href='{{asset('css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
    <link rel='stylesheet' id='style-css' href='{{asset('css/style.css?ver=5.7.2')}}' media='all' />
    <link rel='stylesheet' id='wp-block-library-css' href='{{asset('css/style.min.css?ver=5.7.2')}}' media='all' />
    <script type='text/javascript' src='{{asset('js/jquery.min.js?ver=5.7.2')}}' id='halim-jquery-js'></script>
    <style type="text/css" id="wp-custom-css">
        .textwidget p a img {
            width: 100%;
        }
    </style>
    <style>#header .site-title {background: url(https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png) no-repeat top left;background-size: contain;text-indent: -9999px;}</style>
</head>
<body class="home blog halimthemes halimmovies" data-masonry="">
<header id="header">
    <div class="container">
        <div class="row" id="headwrap">
            <div class="col-md-3 col-sm-6 slogan">
                <p class=""><a href="" title="phim hay ">
                        <img width="200" src="{{asset('/uploads/logo/'.$info->logo)}}">
                    </a></p>
            </div>
            <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                <div class="header-nav">
                    <div class="col-xs-12">
                        <div class="form-group form-timkiem">
                            <div class="input-group col-xs-12" >
                                <form action="{{route('tim-kiem')}}" class="d-flex" method="get">
                                        <span class="input-group-btn">
                                            @if(isset($search))
                                                <input  id="timkiem" type="text" value="{{$search}}" name="search" class="form-control" placeholder="Tìm kiếm phim..." autocomplete="off" required><button type="submit" class="btn btn-primary" name="btnsearch">Tìm kiếm</button>

                                            @else
                                                <input  id="timkiem" type="text" name="search" class="form-control" placeholder="Tìm kiếm phim..." autocomplete="off" required><button type="submit" class="btn btn-primary" name="btnsearch">Tìm kiếm</button>
                                            @endif
                                             </span>

                                </form>

                            </div>
                        </div>
                        <ul class="list-group" id ="result">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-xs">
                <div id="get-bookmark" class="box-shadow"><i class="hl-bookmark"></i><span> Bookmarks</span><span class="count">0</span></div>
                <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                    <ul style="margin: 0;"></ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="navbar-container">
    <div class="container">
        <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                    <span class="hl-search" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                    Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                    <span class="count">0</span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                    <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="halim">
                <div class="menu-menu_1-container ">
                    <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepage')}}">Trang Chủ</a></li>
                        @foreach($category as $key => $cate)
                            <li class="mega"><a title="{{$cate->title}}" href="{{route('category',$cate->slug)}}">{{$cate->title}}</a></li>
                        @endforeach
                        {{--                        <li class="mega dropdown">--}}
                        {{--                            <a title="Danh mục" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Danh mục <span class="caret"></span></a>--}}

                        {{--                            <ul role="menu" class=" dropdown-menu">--}}
                        {{--                                @foreach($category as $key => $cate)--}}
                        {{--                                    <li><a title="{{$cate->title}}" href="{{route('category',$cate->slug)}}">{{$cate->title}}</a></li>--}}
                        {{--                                @endforeach--}}
                        {{--                            </ul>--}}

                        {{--                        </li>--}}
                        {{--                        <li class="mega dropdown">--}}
                        {{--                            <a title="Năm" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm <span class="caret"></span></a>--}}
                        {{--                            <ul role="menu" class=" dropdown-menu">--}}
                        {{--                                <li><a title="Phim 2020" href="danhmuc.php">Phim 2020</a></li>--}}
                        {{--                                <li><a title="Năm 2019" href="danhmuc.php">Năm 2019</a></li>--}}
                        {{--                                <li><a title="Năm 2018" href="danhmuc.php">Năm 2018</a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}
                        <li class="mega dropdown">
                            <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>

                            <ul role="menu" class=" dropdown-menu">
                                @foreach($genre as $key=> $gen)
                                    <li><a title="{{$gen->title}}" href="{{route('genre',$gen->slug)}}">{{$gen->title}}</a></li>
                                @endforeach
                            </ul>

                        </li>
                        <li class="mega dropdown">
                            <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach($country as $key=> $coun)
                                    <li><a title="{{$coun->title}}" href="{{route('country',$coun->slug)}}">{{$coun->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="mega dropdown">
                            <a title="Năm" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @for( $x=2023 ; $x>=1970;$x--)
                                    <li><a title="{{$x}}" href="{{url('nam/'.$x)}}">{{$x}}</a></li>
                                @endfor
                            </ul>
                        </li>
                        {{--                        <li><a title="Phim Lẻ" href="danhmuc.php">Phim Lẻ</a></li>--}}
                        {{--                        <li><a title="Phim Bộ" href="danhmuc.php">Phim Bộ</a></li>--}}
                        {{--                        <li><a title="Phim Chiếu Rạp" href="danhmuc.php">Phim Chiếu Rạp</a></li>--}}
                    </ul>
                </div>
                {{--                <ul class="nav navbar-nav navbar-left" style="background:#000;">--}}
                {{--                    <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>--}}
                {{--                </ul>--}}
            </div>
        </nav>
        <div class="collapse navbar-collapse" id="search-form">
            <div id="mobile-search-form" class="halim-search-form"></div>
        </div>
        <div class="collapse navbar-collapse" id="user-info">
            <div id="mobile-user-login"></div>
        </div>
    </div>
</div>

</div>
<div class="container">
    <div class="row fullwith-slider"></div>
</div>
<div class="container">
    @yield('content')
</div>
<div class="clearfix"></div>
<footer id="footer" class="clearfix">
    <div class="container footer-columns">
        <div class="row container">
            <div class="widget about col-xs-12 col-sm-4 col-md-4">
                <div class="footer-logo">
                    <p class=""><a href="" title="phim hay ">
                            <img width="200" src="{{asset('/uploads/logo/'.$info->logo)}}">
                        </a></p>
                </div>
                Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[email&#160;protected]</a>
            </div>
            <div class="widget about col-xs-12 col-sm-4 col-md-6">
                <div class="footer-logo">
                    <p class="">{{$info->description}}</p>
                </div>

            </div>
        </div>
    </div>
</footer>
<div id='easy-top'></div>
<script>
    $(".watch-trailer").click(function (){
        e.preventDefault();
        var ald = $(this).attr("href");
        $('html,body').animate({scrollTop: $(ald).offset().top},'slow');
    });
</script>
<script>
    jQuery(document).ready(function($) {
        var owl = $('#halim_related_movies-2');
        owl.owlCarousel({loop: true,margin:5,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,
            responsive: {0: {items:2},480: {items:3}, 600: {items:5},1000: {items: 6}}})});
    jQuery(document).ready(function($) {
        var owl = $('#halim_related_movies-3');
        owl.owlCarousel({loop: true,margin:5,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,
            responsive: {0: {items:2},480: {items:3}, 600: {items:5},1000: {items: 5}}})});

</script>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=428076886095768&autoLogAppEvents=1" nonce="8dxVF35s"></script>
<script>
    $(document).ready(function() {
        $('#timkiem').keyup(function() {
            $('#result').html('');
            var search = $('#timkiem').val();
            if(search!=''){
                var expression = new RegExp(search,"i");
                $.getJSON('/jsonfile/movie.json',function(data){
                    $.each(data,function(key,value){
                        if(value.title.search(expression)!=-1){
                            $('#result').append('<li style="cursor:pointer; display: flex; max-height: 200px;" class="list-group-item link-class"><img src="'+value.image+'" width="50" class="" /><div style="flex-direction: column; margin-left: 2px;"><h4 width="100%">'+value.title+'</h4><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted"></span></div></li>');
                        }
                    });
                })
            }
        })
        $('#result').on('click','li', function(){
            var click_text = $(this).text();
            $('#timkiem').val($.trim(click_text));
            $('#result').html('');
        });
    });
</script>
<script type="text/javascript">
    $('.filter-sidebar').click(function (){
        var  hrel = $(this).attr('href');
        if(hrel =='#day') {
            var value = 0;
        }else if(hrel=='#week'){
            var value = 1;
        }else{
            var value = 2;
        }
        $.ajax({
            url: "{{url('/filter-topview')}}",
            method: "GET",
            data: {value:value},
            success: function (data) {
                $('#show'+value).html(data);
            }
        });
    })
</script>
<script type='text/javascript' src='{{asset('js/bootstrap.min.js?ver=5.7.2')}}' id='bootstrap-js'></script>
<script type='text/javascript' src='{{asset('js/owl.carousel.min.js?ver=5.7.2')}}' id='carousel-js'></script>
<script type='text/javascript' src='{{asset('js/halimtheme-core.min.js?ver=1626273138')}}' id='halim-init-js'></script>



<style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}</style>
<style>
    #overlay_pc {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 99999;
        cursor: pointer;
    }
    #overlay_pc .overlay_pc_content {
        position: relative;
        height: 100%;
    }
    .overlay_pc_block {
        display: inline-block;
        position: relative;
    }
    #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
        width: 600px;
        height: auto;
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    #overlay_pc .overlay_pc_content .cls_ov {
        color: #fff;
        text-align: center;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 999999;
        font-size: 14px;
        padding: 4px 10px;
        border: 1px solid #aeaeae;
        background-color: rgba(0, 0, 0, 0.7);
    }
    #overlay_pc img {
        position: relative;
        z-index: 999;
    }
    @media only screen and (max-width: 768px) {
        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 400px;
            top: 3%;
            transform: translate(-50%, 3%);
        }
    }
    @media only screen and (max-width: 400px) {
        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 310px;
            top: 3%;
            transform: translate(-50%, 3%);
        }
    }
</style>
<style>
    .float-ck { position: fixed; bottom: 0px; z-index: 9}
    * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0) ;}
    #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
    #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
    span.bannermobi2 img {height: 70px;width: 300px;}
    #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
</style>
</body>
</html>
